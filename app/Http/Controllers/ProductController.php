<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductType;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

use App\Services\ImageService;

class ProductController extends Controller
{
    public function index(Request $request){
        $category = null;

        if ($request->filled('categoria')) 
            $category = ProductCategory::where('slug', $request->categoria)->first();
        
        $categories = ProductCategory::all();

        $query = Product::query()
            ->where('active', true)
            ->with(['type', 'category']);

        //PRODUCTS WITH DISCOUNT?
        if ($request->boolean('ofertas')) 
            $query->where('discount', '>', 0);

        //LOGIC GROUPS
        if ($request->grupo === 'componentes') 
            $query->whereNotIn('product_category_id', [
                ProductCategory::BUILT_PC,
                ProductCategory::PERIPHERALS,
                ProductCategory::CASES,
            ]);
        
        if ($request->grupo === 'pcs') 
            $query->where('product_category_id', [
                ProductCategory::BUILT_PC,
                ProductCategory::NOTEBOOKS,
            ]);

        //CATEGORY
        if ($category) 
            $query->where('product_category_id', $category->id);
    
        //PRICE?
        if ($request->filled('min')) 
            $query->where('price', '>=', $request->min);

        if ($request->filled('max'))
            $query->where('price', '<=', $request->max);

        //Q SEARCH?
        if ($request->filled('q'))
            $query->where(function ($sub) use ($request) {
                $sub->where('name', 'LIKE', '%'.$request->q.'%')
                    ->orWhere('description', 'LIKE', '%'.$request->q.'%')
                    ->orWhere('brand', 'LIKE', '%'.$request->q.'%');
            });
        
        //QUERY BUILD
        $products = $query->where('active', true)->with(['type', 'category'])->latest()->paginate(8)->withQueryString();

        return view('product.index', ['products' => $products, 'categories' => $categories, 'category' => $category]);
    }

    public function create(){
        $types = ProductType::all();
        $categories = ProductCategory::all();

        return view('product.create', ['types' => $types, 'categories' => $categories]);
    }

    public function store(){
        $request = request();

        //VALIDATE
        $validatedProduct = $request->validate([
            'product_type_id' => 'required|exists:product_types,id',
            'product_category_id' => 'required|exists:product_categories,id',
            'sku' => 'required|unique:products,sku',
            'brand' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'active' => 'required|boolean',
            'image' => ['required', File::types(['png', 'jpg', 'webp'])],
        ]);

        $validatedProduct['discount'] /= 100;
        $validatedProduct['description'] = preg_replace(
            "/\s*\r?\n\s*/",
            '',
            $validatedProduct['description']
        );

        //CREATE PRODUCT
        $product = Product::create(Arr::except($validatedProduct, ['image']));
        
        //PROCESS IMAGE
        if ($request->hasFile('image')) {
            $path = ImageService::squareAndResize($request->file('image'), "products/{$product->id}", '1.webp', 1024);
            $product->update(['imagesRoute' => $path]);
        }

        //REDIRECT
        return redirect('/Producto/'.$product->id);
    }

    public function show($id){
        $product = Product::with(['type', 'category', 'questions' => function ($query) {
                                                                        $query->with('answers')->where('active', true)->latest();
                                                                    }])->findOrFail($id);

        $breadcrumbs = [
            [
                'label' => 'Inicio',
                'url' => route('Home'),
            ],
            [
                'label' => 'Productos',
                'url' => route('products.index'),
            ],
            [
                'label' => $product->category->name,
                'url' => route('products.index', [
                    'categoria' => $product->category->slug
                ]),
            ],
        ];

        return view('product.show', ['product' => $product, 'breadcrumbs' => $breadcrumbs]);
    }

    public function edit($id){
        $product = Product::with(['type', 'category'])->find($id);
        $categories = ProductCategory::all();
        $types = ProductType::all();

        $product['description'] =  str_replace(",", ",\n", $product['description']);
        $product['fFinal'] = number_format($product->finalPrice(), 0, '.', ',');
        $product['fPrice'] =  number_format($product->price, 0, '.', ',');
        $product['fDiscounted'] = number_format($product->price-$product->finalPrice(), 0, '.', ',');

        return view('product.edit', ['product' => $product, 'types' => $types, 'categories' => $categories]);
    }

    public function update(Product $product){
        $request = request();

        //VALIDATE
        $validatedProduct = $request->validate([
            'product_type_id' => 'required|exists:product_types,id',
            'product_category_id' => 'required|exists:product_categories,id',
            'sku' => 'required|unique:products,sku,'.$product->id,
            'brand' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'active' => 'required|boolean',
            'image' => ['nullable', File::types(['png', 'jpg', 'webp'])],
        ]);

        $validatedProduct['discount'] /= 100;
        $validatedProduct['description'] = preg_replace(
            "/\r\n|\r|\n/",
            '',
            $validatedProduct['description']
        );

        $product->update(Arr::except($validatedProduct, ['image']));

        if ($request->hasFile('image')) {
            $path = ImageService::squareAndResize($request->file('image'), "products/{$product->id}", '1.webp', 1024, $product->imagesRoute);
            $product->update(['imagesRoute' => $path]);
        }
        
        //REDIRECT
        return back();
    }

    //-- NON CRUD METHODS --
    public function toggleEnable(Product $product){  
        $product->update([
            'active' => !$product->active
        ]);
        return back();
    }
}
