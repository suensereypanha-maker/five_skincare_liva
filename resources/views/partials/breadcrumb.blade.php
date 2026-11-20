@php
    $title = $title ?? 'LIVA Botanical Skincare';
    $subtitle = $subtitle ?? $title;
@endphp

<section class="breadcrumb-section set-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>{{ $title }}</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('home') }}" title="Return to Home Page"><i class="fa fa-home mr-1"></i> Home</a>
                        @if(!empty($parent) && !empty($parentUrl))
                            <a href="{{ $parentUrl }}">{{ $parent }}</a>
                        @endif
                        <span>{{ $subtitle }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
