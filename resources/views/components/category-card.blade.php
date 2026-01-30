@props(['category'])

<a href="/Productos?categoria={{ $category->slug }}">
    <div class="flex flex-col space-y-3 bg-cover bg-center transition duration-300 transform hover:-translate-y-1" style="background-image: url('{{ asset('images/categories/'.$category->id.'.png') }}');">
        <p class="ml-2 p-5">{{ $category->name }}</p>
    </div>
</a>