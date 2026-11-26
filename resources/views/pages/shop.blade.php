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
        {{-- Mobile Filter Drawer Overlay --}}
        <div class="liva-filter-overlay" id="livaFilterOverlay"></div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5 liva-sidebar-wrapper" id="livaSidebarDrawer">
                    <div class="sidebar">
                        {{-- Mobile Drawer Header (Only visible on mobile screens < 992px) --}}
                        <div class="liva-filter-drawer-header d-flex d-lg-none align-items-center justify-content-between mb-3 pb-3" style="border-bottom: 1px solid #eae4d9;">
                            <div class="d-flex align-items-center" style="gap: 8px;">
                                <i class="fa fa-sliders" style="color: #b8975a; font-size: 18px;"></i>
                                <h5 class="mb-0 font-weight-bold" style="color: #1F2421;" data-i18n="filter_products">Filter Products</h5>
                            </div>
                            <button type="button" id="livaFilterDrawerClose" class="btn btn-light rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 34px; height: 34px; border: 1px solid #ddd; cursor: pointer;" aria-label="Close filters">
                                <i class="fa fa-times" style="font-size: 16px; color: #333;"></i>
                            </button>
                        </div>

                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                <li>
                                    <a href="{{ route('shop.index') }}" style="{{ empty(request('category')) ? 'font-weight: 700; color: #b8975a;' : '' }}">
                                        All Botanical Products ({{ $totalProductsCount ?? 10 }})
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.index', ['category' => 'haircare']) }}" style="{{ request('category') === 'haircare' ? 'font-weight: 700; color: #b8975a;' : '' }}">
                                        Hair Care &amp; Scalp (3)
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.index', ['category' => 'bodycare']) }}" style="{{ request('category') === 'bodycare' ? 'font-weight: 700; color: #b8975a;' : '' }}">
                                        Body Wash &amp; Lotion (2)
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.index', ['category' => 'facialcare']) }}" style="{{ request('category') === 'facialcare' ? 'font-weight: 700; color: #b8975a;' : '' }}">
                                        Facial Care &amp; Serums (2)
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.index', ['category' => 'sets']) }}" style="{{ request('category') === 'sets' ? 'font-weight: 700; color: #b8975a;' : '' }}">
                                        Botanical Rituals &amp; Sets (2)
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shop.index', ['category' => 'travel']) }}" style="{{ request('category') === 'travel' ? 'font-weight: 700; color: #b8975a;' : '' }}">
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

                        {{-- Mobile Apply Filters Button --}}
                        <div class="d-block d-lg-none mt-4 pt-3" style="border-top: 1px solid #eae4d9;">
                            <button type="button" id="livaFilterApplyBtn" class="site-btn w-100 py-2" style="font-weight: 700; border-radius: 25px;" data-i18n="apply_filters">
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-12">
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
                                                                <button type="submit" title="Add to bag">
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
                                                    <div class="d-block d-md-none mt-2">
                                                        <form action="{{ route('cart.add') }}" method="POST" class="js-cart-form m-0">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $sale['id'] }}">
                                                            <input type="hidden" name="quantity" value="1">
                                                            <button type="submit" class="site-btn py-1 px-3 w-100 d-inline-flex align-items-center justify-content-center" style="font-size: 12px; height: 34px; border-radius: 20px; font-weight: 700; letter-spacing: 0.5px;">
                                                                <i class="fa fa-shopping-bag mr-1"></i> <span data-i18n="add_to_cart">Add to Bag</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    {{-- <div class="mt-2">
                                                        <a href="{{ route('shop.show', $sale['id']) }}" class="btn btn-sm" style="border: 1px solid #b8975a; color: #b8975a; font-weight: 700; font-size: 12px; padding: 4px 14px; border-radius: 20px; text-decoration: none;">
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
                            <div class="col-lg-4 col-md-5 col-12 d-flex align-items-center justify-content-between mb-3 mb-md-0">
                                {{-- Small Mobile Filter Button (Slides out the filter drawer) --}}
                                <button type="button" class="btn d-inline-flex d-lg-none align-items-center" id="livaFilterDrawerOpen" style="border: 1.5px solid #b8975a; color: #b8975a; font-weight: 700; font-size: 13px; border-radius: 20px; padding: 6px 14px; background: #fff; box-shadow: 0 2px 6px rgba(184, 151, 90,0.12); cursor: pointer;">
                                    <i class="fa fa-sliders mr-2"></i> <span data-i18n="filter_btn">Filter</span>
                                    @if(request('category'))
                                        <span class="badge ml-2" style="background:#b8975a; font-size:10px; border-radius: 50%; padding: 2px 5px;">1</span>
                                    @endif
                                </button>

                                <div class="filter__sort">
                                    <span>Sort By:</span>
                                    <select onchange="window.location.href=this.value;">
                                        <option value="{{ route('shop.index', array_merge(request()->query(), ['sort' => 'default'])) }}">Featured Botanicals</option>
                                        <option value="{{ route('shop.index', array_merge(request()->query(), ['sort' => 'price_low'])) }}" @selected(request('sort') === 'price_low')>Price: Low to High</option>
                                        <option value="{{ route('shop.index', array_merge(request()->query(), ['sort' => 'price_high'])) }}" @selected(request('sort') === 'price_high')>Price: High to Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 text-left text-md-center">
                                <div class="filter__found">
                                    <h6><span>{{ count($products) }}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3 col-6 text-right">
                                @if(request('category') || request('search') || request('sort'))
                                    <a href="{{ route('shop.index') }}" class="btn btn-sm btn-outline-secondary" style="font-size: 12px; border-radius: 20px; padding: 4px 12px;">
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
                                <div class="col-lg-4 col-md-6 col-sm-6 col-6 mb-4">
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
                                                        <button type="submit" title="Add to bag">
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
                                            <h5 style="margin-bottom: 6px;">${{ number_format($product['price'], 2) }}</h5>
                                            <div class="d-block d-md-none mt-2">
                                                <form action="{{ route('cart.add') }}" method="POST" class="js-cart-form m-0">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="site-btn py-1 px-2 w-100" style="font-size: 11px; height: 32px; border-radius: 20px; font-weight: 700; letter-spacing: 0.5px;">
                                                        <i class="fa fa-shopping-bag mr-1"></i> <span data-i18n="add_to_cart">Add to Bag</span>
                                                    </button>
                                                </form>
                                            </div>
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

@push('scripts')
    <script>
        (function () {
            var openBtn = document.getElementById('livaFilterDrawerOpen');
            var closeBtn = document.getElementById('livaFilterDrawerClose');
            var applyBtn = document.getElementById('livaFilterApplyBtn');
            var overlay = document.getElementById('livaFilterOverlay');
            var drawer = document.getElementById('livaSidebarDrawer');

            function openDrawer() {
                if (!drawer || !overlay) return;
                drawer.classList.add('is-open');
                overlay.classList.add('is-active');
                document.body.classList.add('liva-filter-open');
            }

            function closeDrawer() {
                if (!drawer || !overlay) return;
                drawer.classList.remove('is-open');
                overlay.classList.remove('is-active');
                document.body.classList.remove('liva-filter-open');
            }

            if (openBtn) openBtn.addEventListener('click', openDrawer);
            if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
            if (applyBtn) applyBtn.addEventListener('click', closeDrawer);
            if (overlay) overlay.addEventListener('click', closeDrawer);

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && drawer && drawer.classList.contains('is-open')) {
                    closeDrawer();
                }
            });
        }());
    </script>
@endpush
