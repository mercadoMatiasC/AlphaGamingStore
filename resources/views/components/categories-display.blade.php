@props(['categories'])

<section class="w-4/5 lg:w-3/4 mx-auto flex flex-col space-y-6">
    <x-section-header>¡Buscá productos por categoría!</x-section-header>

    <div class="mt-6 grid grid-cols-1 gap-2 lg:grid-cols-4">
        @foreach ($categories as $category)
            <x-category-card :category="$category" />                    
        @endforeach
    </div>
</section>