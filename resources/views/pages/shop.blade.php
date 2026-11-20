@extends('layouts.master')
@section('title', 'LIVA | Botanical Skincare Shop')

@section('hero')
    @include('partials.hero', ['isHome' => false])
@endsection

@section('breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Botanical Shop',
        'subtitle' => request('category') ? ucwords(str_replace('-', ' ', request('category'))) : 'All Products'
    ])
@endsection

@section('content')
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                <li>
                                    <a href="{{ route('shop.index') }}" style="{{ empty(request('category')) ? 'font-weight: 700; color: #7fad39;' : '' }}">
                                        All Botanical Products ({{ $totalProductsCount ?? 10 }})
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.index', ['category' => 'haircare']) }}" style="{{ request('category') === 'haircare' ? 'font-weight: 700; color: #7fad39;' : '' }}">
                                        Hair Care &amp; Scalp (3)
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.index', ['category' => 'bodycare']) }}" style="{{ request('category') === 'bodycare' ? 'font-weight: 700; color: #7fad39;' : '' }}">
                                        Body Wash &amp; Lotion (2)
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.index', ['category' => 'facialcare']) }}" style="{{ request('category') === 'facialcare' ? 'font-weight: 700; color: #7fad39;' : '' }}">
                                        Facial Care &amp; Serums (2)
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.index', ['category' => 'sets']) }}" style="{{ request('category') === 'sets' ? 'font-weight: 700; color: #7fad39;' : '' }}">
                                        Botanical Rituals &amp; Sets (2)
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.index', ['category' => 'travel']) }}" style="{{ request('category') === 'travel' ? 'font-weight: 700; color: #7fad39;' : '' }}">
                                        Travel Essentials (1)
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price Range</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="20" data-max="100">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Skin Type</h4>
                            <div class="sidebar__item__size">
                                <label for="all-skin">
                                    All Skin Types
                                    <input type="checkbox" id="all-skin" checked>
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="sensitive">
                                    Sensitive &amp; Dry
                                    <input type="checkbox" id="sensitive">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="oily">
                                    Oily &amp; Combination
                                    <input type="checkbox" id="oily">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="mature">
                                    Hydration &amp; Anti-Aging
                                    <input type="checkbox" id="mature">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Volume &amp; Size</h4>
                            <div class="sidebar__item__size">
                                <label for="size-500">
                                    500ml (Full Size)
                                    <input type="radio" name="size" id="size-500">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="size-250">
                                    250ml (Standard)
                                    <input type="radio" name="size" id="size-250" checked>
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="size-100">
                                    100ml (Travel)
                                    <input type="radio" name="size" id="size-100">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="size-50">
                                    50ml (Trial)
                                    <input type="radio" name="size" id="size-50">
                                </label>
                            </div>
                        </div>
                      
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    @if(!empty($saleProducts) && count($saleProducts) > 0 && empty(request('search')))
                        <div class="product__discount">
                            <div class="section-title product__discount__title">
                                <h2>Botanical Specials</h2>
                            </div>
                            <div class="row">
                                <div class="product__discount__slider owl-carousel">
                                    @foreach($saleProducts as $sale)
                                        <div class="col-lg-4">
                                            <div class="product__discount__item">
                                                <div class="product__discount__item__pic set-bg"
                                                    data-setbg="{{ asset($sale['image']) }}" style="position: relative; cursor: pointer;">
                                                    <a href="{{ route('shop.show', $sale['id']) }}" class="position-absolute w-100 h-100" style="top: 0; left: 0; z-index: 1;" title="{{ $sale['name'] }}"></a>
                                                    <ul class="product__item__pic__hover" style="z-index: 3;">
                                                        <li><a href="{{ route('shop.show', $sale['id']) }}" title="See Details"><i class="fa fa-eye"></i></a></li>
                                                        <li>
                                                            <form action="{{ route('cart.add') }}" method="POST" class="js-cart-form" style="display:inline;">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $sale['id'] }}">
                                                                <input type="hidden" name="quantity" value="1">
                                                                <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;" title="Add to bag">
                                                                    <i class="fa fa-shopping-cart"></i>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product__discount__item__text">
                                                    <span>{{ $sale['category_name'] }}</span>
                                                    <h5><a href="{{ route('shop.show', $sale['id']) }}">{{ $sale['name'] }}</a></h5>
                                                    <div class="product__item__price">
                                                        ${{ number_format($sale['price'], 2) }}
                                                        @if(!empty($sale['original_price']))
                                                            <span>${{ number_format($sale['original_price'], 2) }}</span>
                                                        @endif
                                                    </div>
                                                    {{-- <div class="mt-2">
                                                        <a href="{{ route('shop.show', $sale['id']) }}" class="btn btn-sm" style="border: 1px solid #7fad39; color: #7fad39; font-weight: 700; font-size: 12px; padding: 4px 14px; border-radius: 20px; text-decoration: none;">
                                                            See Details <i class="fa fa-arrow-right ml-1"></i>
                                                        </a>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="filter__item">
                        <div class="row align-items-center">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By:</span>
                                    <select onchange="window.location.href=this.value;">
                                        <option value="{{ route('shop.index', array_merge(request()->query(), ['sort' => 'default'])) }}">Featured Botanicals</option>
                                        <option value="{{ route('shop.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}">Price: Low to High</option>
                                        <option value="{{ route('shop.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}">Price: High to Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 text-center">
                                <div class="filter__found">
                                    <h6><span>{{ count($products) }}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3 text-right">
                                @if(request('category') || request('search'))
                                    <a href="{{ route('shop.index') }}" class="btn btn-sm btn-outline-secondary" style="font-size: 12px; border-radius: 4px;">
                                        <i class="fa fa-times mr-1"></i> Clear Filter
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if(count($products) === 0)
                        <div class="text-center py-5 my-4" style="background: #fafafa; border-radius: 8px;">
                            <i class="fa fa-search fa-3x mb-3 text-muted"></i>
                            <h4>No botanical products found</h4>
                            <p class="text-muted">Try searching with a different term or select another category.</p>
                            <a href="{{ route('shop.index') }}" class="primary-btn mt-2">VIEW ALL PRODUCTS</a>
                        </div>
                    @else
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset($product['image']) }}" style="position: relative; cursor: pointer;">
                                            <a href="{{ route('shop.show', $product['id']) }}" class="position-absolute w-100 h-100" style="top: 0; left: 0; z-index: 1;" title="{{ $product['name'] }}"></a>
                                            @if(!empty($product['is_sale']))
                                                <div class="product__discount__percent" style="position: absolute; top: 10px; left: 10px; background: #e53637; color: #fff; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 4px; z-index: 2;">
                                                    {{ $product['discount_percent'] ?? 'SALE' }}
                                                </div>
                                            @endif
                                            <ul class="product__item__pic__hover" style="z-index: 3;">
                                                <li><a href="{{ route('shop.show', $product['id']) }}" title="See Details"><i class="fa fa-eye"></i></a></li>
                                                <li>
                                                    <form action="{{ route('cart.add') }}" method="POST" class="js-cart-form" style="display:inline;">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;" title="Add to bag">
                                                                <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <span style="font-size: 12px; color: #888;">{{ $product['category_name'] }}</span>
                                            <h6 style="margin-top: 4px; margin-bottom: 6px;">
                                                <a href="{{ route('shop.show', $product['id']) }}" style="color: #1c1c1c; font-weight: 700;">{{ $product['name'] }}</a>
                                            </h6>
                                            <h5 style="margin-bottom: 10px;">${{ number_format($product['price'], 2) }}</h5>
                                            {{-- <div class="d-flex align-items-center justify-content-center" style="gap: 8px;">
                                                <a href="{{ route('shop.show', $product['id']) }}" class="btn btn-sm" style="border: 1px solid #7fad39; color: #7fad39; font-weight: 700; font-size: 12px; padding: 4px 14px; border-radius: 20px; text-decoration: none;">
                                                    See Details <i class="fa fa-arrow-right ml-1"></i>
                                                </a>
                                                <form action="{{ route('cart.add') }}" method="POST" class="js-cart-form" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
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
                    @endif

                    <div class="product__pagination text-center mt-4">
                        <a href="{{ route('shop.index') }}" class="active">1</a>
                        <a href="{{ route('shop.index') }}">2</a>
                        <a href="{{ route('shop.index') }}"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
