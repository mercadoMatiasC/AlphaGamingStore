@props(['items'])

<div class="bg-pink-600/20 mb-2 rounded-md py-2 px-4 font-semibold text-white/75">
    <ol class="flex flex-wrap gap-1">
        @foreach ($items as $item)
            <li class="flex items-center gap-1">
                @if ($item['url'])
                    <a href="{{ $item['url'] }}" class="hover:underline">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="text-white/90">
                        {{ $item['label'] }}
                    </span>
                @endif

                @if (! $loop->last)
                    <span class="mx-1">›</span>
                @endif
            </li>
        @endforeach
    </ol>
</div>