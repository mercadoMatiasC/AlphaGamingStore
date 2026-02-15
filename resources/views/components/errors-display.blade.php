@if($errors->any())
  <ul class="rounded bg-red-800/90 px-3 py-2 text-sm font-semibold text-white mt-5">
      @foreach($errors->all() as $error)
          <li>Error: {{ $error }}</li>
      @endforeach
  <ul>
@endif