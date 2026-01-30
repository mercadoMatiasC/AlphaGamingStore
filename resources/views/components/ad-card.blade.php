@props(['adTitle'])

<section class="w-full mx-auto flex justify-center items-center lg:w-3/4">
    <a {{ $attributes->merge(['href' => '#']) }}>
        <picture>
            <source media="(min-width: 1280px)" srcset="{{ asset("images/banners/$adTitle/banner.jpg") }}">
            <img src="{{ asset("images/banners/$adTitle/banner-m.jpg") }}" alt="{{ $adTitle }} - Advertisement" class="w-full mx-auto" loading="lazy">
        </picture>
    </a>
</section>