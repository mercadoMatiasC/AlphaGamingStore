<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller{

    public function index(){
        $products = Product::where('active', true)->where('stock', '>', 0)->where('product_category_id', '!=', ProductCategory::BUILT_PC)->with(['type', 'category'])->latest()->limit(4)->get();
        $categories = ProductCategory::all();

        $builtPCs = Product::where('active', true)->where('stock', '>', 0)->where('product_category_id', ProductCategory::BUILT_PC)->with(['type', 'category'])->latest()->limit(4)->get();

        return view('main.index', [
            'products' => $products,
            'categories' => $categories,
            'builtPCs' => $builtPCs,
            'builtPCCat' => $categories->firstWhere('id', ProductCategory::BUILT_PC),
        ]);
    }

}