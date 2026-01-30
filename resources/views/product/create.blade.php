<x-layout title="Ingresar producto">
    <div class="flex flex-col w-full p-3 mx-auto lg:px-0 lg:w-1/2">
        <x-section-header>
            Ingresar producto
        </x-section-header>    
    </div>

    <div class="flex flex-col justify-center mx-auto w-full h-full bg-white/10 p-8 space-y-2 lg:w-1/2">
        <form action="/Producto" method="POST" class="grid grid-cols-1 gap-3" enctype="multipart/form-data">
            @csrf
            <x-forms.select :value="old('product_type_id')" label="Tipo de producto" name="product_type_id" :options="$types" required />
            <x-forms.select :value="old('product_category_id')" label="Categoría" name="product_category_id" :options="$categories" required />
            <x-forms.input :value="old('sku')" label="SKU" name="sku" placeholder="GPU-AMD-RX570##-GIG-RGB#" required />
            <x-forms.input :value="old('brand')" label="Marca" name="brand" placeholder="Corsair" required />
            <x-forms.input :value="old('name')" label="Nombre" name="name" placeholder="Procesador i7-7700k Socket LGA-1151 ..." required />
            <x-forms.textarea :value="old('description')" label="Descripción" name="description" placeholder="Tamaño memoria=8GB, Núcleos=6, ..." class="h-32" required />
            <x-forms.file label="Imágenes" name="image" fprompt="PNG, JPG o WEBP."/>
            <x-divider />
            <x-forms.number :value="old('price')" step="0.01" label="Precio ($)" name="price" placeholder="146900" required />
            <x-forms.number :value="old('discount')" max="100" label="Descuento (%)" name="discount" placeholder="50" required />
            <x-forms.number :value="old('stock')" label="Stock (unidades)" name="stock" placeholder="15" required />
            <x-forms.checkbox :value="old('active')" name="active" label="Activo" />
        
            <div class="flex flex-row justify-end">
                <x-forms.button class="w-full xl:w-2/5 mt-5" :anchor="0">
                    Registrar producto
                </x-forms.button>
            </div>
        </form>

        <x-errors-display />
    </div>
</x-layout>