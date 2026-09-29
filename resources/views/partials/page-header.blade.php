<section class="page-header">
    <div class="page-header__container">
        {{-- Breadcrumb: "Home / <nama halaman>" --}}
        <div class="page-header__breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <span class="page-header__breadcrumb-current">{{ $breadcrumb }}</span>
        </div>

        <h1 class="page-header__title">{{ $title }}</h1>

        @if (isset($subtitle))
            <p class="page-header__subtitle">{{ $subtitle }}</p>
        @endif
    </div>
</section>