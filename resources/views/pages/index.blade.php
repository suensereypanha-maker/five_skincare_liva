@extends('layouts.master')
@section('title', 'LIVA | Botanical Skincare & Beauty')

@section('hero')
    @include('partials.hero', ['isHome' => true])
@endsection

@section('content')
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/shampoo.webp') }}">
                            <h5><a href="{{ route('shop.index', ['category' => 'haircare']) }}">Hair Care</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/conditioner.webp') }}">
                            <h5><a href="{{ route('shop.index', ['category' => 'haircare']) }}">Conditioner</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/hair-mask.png') }}">
                            <h5><a href="{{ route('shop.index', ['category' => 'haircare']) }}">Hair Mask</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/shower-gel.png') }}">
                            <h5><a href="{{ route('shop.index', ['category' => 'bodycare']) }}">Body Wash</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/body-lotion.webp') }}">
                            <h5><a href="{{ route('shop.index', ['category' => 'bodycare']) }}">Body Lotion</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/botanical.png') }}">
                            <h5><a href="{{ route('shop.index', ['category' => 'facialcare']) }}">Facial Care</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('img/daily-edit.webp') }}">
                            <h5><a href="{{ route('shop.index', ['category' => 'sets']) }}">Rituals &amp; Sets</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Botanicals</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".haircare">Hair Care</li>
                            <li data-filter=".bodycare">Body Care</li>
                            <li data-filter=".facialcare">Facial Care</li>
                            <li data-filter=".sets">Sets &amp; Bundles</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @php
                    $feat = $featuredProducts ?? \App\Services\ProductService::getFeatured(8);
                @endphp
                @foreach($feat as $prod)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $prod['category_id'] }} mb-4">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{ asset($prod['image']) }}" style="position: relative; cursor: pointer;">
                                <a href="{{ route('shop.show', $prod['id']) }}" class="position-absolute w-100 h-100" style="top: 0; left: 0; z-index: 1;" title="{{ $prod['name'] }}"></a>
                                @if(!empty($prod['is_sale']))
                                    <div style="position: absolute; top: 10px; left: 10px; background: #e53637; color: #fff; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 4px; z-index: 2;">
                                        {{ $prod['discount_percent'] ?? 'SALE' }}
                                    </div>
                                @endif
                                <ul class="featured__item__pic__hover" style="z-index: 3;">
                                    <li><a href="{{ route('shop.show', $prod['id']) }}" title="See Details"><i class="fa fa-eye"></i></a></li>
                                    <li>
                                        <form action="{{ route('cart.add') }}" method="POST" class="js-cart-form" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $prod['id'] }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;" title="Add to bag">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <span style="font-size: 12px; color: #888;">{{ $prod['category_name'] }}</span>
                                <h6 style="margin-top: 4px; margin-bottom: 6px;">
                                    <a href="{{ route('shop.show', $prod['id']) }}" style="color: #1c1c1c; font-weight: 700;">{{ $prod['name'] }}</a>
                                </h6>
                                <h5 style="margin-bottom: 10px;">${{ number_format($prod['price'], 2) }}</h5>
                                {{-- <div class="d-flex align-items-center justify-content-center" style="gap: 8px;">
                                    <a href="{{ route('shop.show', $prod['id']) }}" class="btn btn-sm" style="border: 1px solid #7fad39; color: #7fad39; font-weight: 700; font-size: 12px; padding: 4px 14px; border-radius: 20px; text-decoration: none;">
                                        See Details <i class="fa fa-arrow-right ml-1"></i>
                                    </a>
                                    <form action="{{ route('cart.add') }}" method="POST" class="js-cart-form" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $prod['id'] }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-sm" style="background: #7fad39; color: #fff; font-weight: 700; font-size: 12px; padding: 4px 12px; border-radius: 20px; border: none; cursor: pointer;" title="Add to bag">
                                            <i class="fa fa-shopping-bag"></i>
                                        </button>
                                    </form>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <a href="{{ route('shop.index', ['category' => 'sets']) }}">
                            <img src="{{ asset('img/campaign/everyday-poster.webp') }}" alt="LIVA Everyday Ritual" style="border-radius: 8px;">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <a href="{{ route('shop.index') }}">
                            <img src="{{ asset('img/banners/banner-2.webp') }}" alt="LIVA Botanical Collection" style="border-radius: 8px;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

 
    <!-- Latest Product Section End -->

    <!-- Skincare Journal Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Skincare Journal</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('img/campaign/your-moment.webp') }}" alt="Botanical Scalp Care">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> Botanical Ritual</li>
                                <li><i class="fa fa-leaf"></i> Organic Care</li>
                            </ul>
                            <h5><a href="{{ route('blog.index') }}">The Botanical Ritual: Why Scalp Health Comes First</a></h5>
                            <p>Discover how balancing scalp microbiome with cold-pressed rosemary promotes hair longevity and natural shine.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('img/campaign/hair-pair.webp') }}" alt="Plant Bio-actives">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> Clean Beauty</li>
                                <li><i class="fa fa-leaf"></i> Ingredients</li>
                            </ul>
                            <h5><a href="{{ route('blog.index') }}">Plant Squalane vs Argan: Choosing What Your Skin Needs</a></h5>
                            <p>An in-depth look into lipid structures and how olive squalane provides instant cellular barrier reinforcement.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('img/result-1.webp') }}" alt="Daily Skincare Routine">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> Daily Edit</li>
                                <li><i class="fa fa-leaf"></i> Wellness</li>
                            </ul>
                            <h5><a href="{{ route('blog.index') }}">Morning to Evening: Building a Minimalist Botanical Routine</a></h5>
                            <p>Less is more when using concentrated botanicals. Learn our simple three-step ritual for round-the-clock radiance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Skincare Journal Section End -->
@endsection
