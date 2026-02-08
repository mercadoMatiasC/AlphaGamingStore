 @props(['product'])

 <form {{ $attributes(['class' => 'w-full']) }} action="/Producto/{{ $product->id }}/Estado" method="POST" data-idempotent>
    @csrf
    @method('PATCH')
    <x-forms.button colour="{{ ($product->active) ? 'red' : 'green' }}" :anchor="0">
       {{ ($product->active) ? 'Deshabilitar':'Habilitar'}}
    </x-forms.button>
</form>