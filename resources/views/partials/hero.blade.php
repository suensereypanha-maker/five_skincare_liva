@php
    $isHome = $isHome ?? false;
    $departmentsList = $departments ?? [
        ['slug' => 'all', 'name' => 'All Botanical Products'],
        ['slug' => 'haircare', 'name' => 'Hair Care & Scalp'],
        ['slug' => 'bodycare', 'name' => 'Body Wash & Lotion'],
        ['slug' => 'facialcare', 'name' => 'Facial Care & Serums'],
        ['slug' => 'sets', 'name' => 'Botanical Rituals & Sets'],
        ['slug' => 'travel', 'name' => 'Travel Essentials'],
    ];
@endphp

<section class="hero {{ $isHome ? '' : 'hero-normal' }}" style="margin-top: 25px; padding-bottom: {{ $isHome ? '50px' : '30px' }};">
    <div class="container">
        {{-- LIVA Botanical Brand Logo & Home Navigation Bar --}}
        <div class="hero__brand-header d-flex align-items-center justify-content-between mb-4 flex-wrap" style="gap: 15px; border-bottom: 1px solid #f0f3eb; padding-bottom: 16px;">
            <div class="hero__brand-logo">
                <a href="{{ route('home') }}" class="d-flex align-items-center" style="gap: 12px; text-decoration: none;" title="LIVA Botanical Skincare - Click to Home">
                    <img src="{{ asset('img/favicon.svg') }}" alt="LIVA" style="height: 44px; width: 44px; border-radius: 8px;">
                    <div>
                        <span style="font-size: 26px; font-weight: 700; letter-spacing: 0.12em; color: #1F2421; font-family: 'Cormorant Garamond', Georgia, serif; line-height: 1; display: block;">LIVA</span>
                        <span style="font-size: 11px; letter-spacing: 0.15em; color: #7fad39; text-transform: uppercase; font-weight: 600;">Botanical Skincare</span>
                    </div>
                </a>
            </div>
            <nav class="hero__brand-nav d-none d-md-flex align-items-center" style="gap: 28px;">
                <a href="{{ route('home') }}" class="d-flex align-items-center" style="font-size: 14px; font-weight: {{ request()->routeIs('home') ? '700' : '600' }}; color: {{ request()->routeIs('home') ? '#7fad39' : '#333' }}; text-decoration: none; letter-spacing: 0.5px;">
                    <i class="fa fa-home mr-1"></i> <span data-i18n="home">HOME</span>
                </a>
                <a href="{{ route('shop.index') }}" style="font-size: 14px; font-weight: {{ request()->routeIs('shop.*') ? '700' : '600' }}; color: {{ request()->routeIs('shop.*') ? '#7fad39' : '#333' }}; text-decoration: none; letter-spacing: 0.5px;" data-i18n="shop">
                    SHOP
                </a>
                <a href="{{ route('cart.index') }}" style="font-size: 14px; font-weight: {{ request()->routeIs('cart.*') ? '700' : '600' }}; color: {{ request()->routeIs('cart.*') ? '#7fad39' : '#333' }}; text-decoration: none; letter-spacing: 0.5px;">
                    <span data-i18n="shopping_bag">BAG</span> (<span class="cart-nav-count">{{ $globalCartCount ?? \App\Services\CartService::getCount() }}</span>)
                </a>
                <a href="{{ route('checkout.index') }}" style="font-size: 14px; font-weight: {{ request()->routeIs('checkout.*') ? '700' : '600' }}; color: {{ request()->routeIs('checkout.*') ? '#7fad39' : '#333' }}; text-decoration: none; letter-spacing: 0.5px;" data-i18n="checkout">
                    CHECKOUT
                </a>
                <a href="{{ route('blog.index') }}" style="font-size: 14px; font-weight: {{ request()->routeIs('blog.*') ? '700' : '600' }}; color: {{ request()->routeIs('blog.*') ? '#7fad39' : '#333' }}; text-decoration: none; letter-spacing: 0.5px;" data-i18n="skincare_journal">
                    JOURNAL
                </a>
                <a href="{{ route('contact.index') }}" style="font-size: 14px; font-weight: {{ request()->routeIs('contact.*') ? '700' : '600' }}; color: {{ request()->routeIs('contact.*') ? '#7fad39' : '#333' }}; text-decoration: none; letter-spacing: 0.5px;" data-i18n="contact">
                    CONTACT
                </a>
            </nav>
        </div>

        <div class="row">
            {{-- <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul style="{{ $isHome ? '' : 'display: none;' }}">
                        @foreach($departmentsList as $dept)
                            <li>
                                <a href="{{ $dept['slug'] === 'all' ? route('shop.index') : route('shop.index', ['category' => $dept['slug']]) }}">
                                    {{ $dept['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div> --}}
            </div>
            <div class="col-lg-12">
                <div class="hero__search d-flex align-items-center justify-content-between flex-wrap" style="margin-bottom: 30px; overflow: visible; gap: 15px;">
                    {{-- Modern Redesigned Search Form --}}
                    <div class="hero__search__form-modern" style="flex: 1 1 320px; max-width: 480px;">
                        <form action="{{ route('shop.index') }}" method="GET" style="display: flex; align-items: center; background: #ffffff; border: 2px solid #7fad39; border-radius: 30px; height: 48px; overflow: hidden; padding-left: 16px; box-shadow: 0 2px 8px rgba(127,173,57,0.12); margin: 0;">
                            <i class="fa fa-search" style="color: #7fad39; font-size: 15px; margin-right: 10px;"></i>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search botanical skincare, hair care, oils..." data-i18n-placeholder="search_placeholder" style="flex: 1; border: none; outline: none; background: transparent; font-size: 14px; color: #1c1c1c; padding: 0 6px; height: 100%;">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <button type="submit" style="background: #7fad39; color: #ffffff; border: none; height: 100%; padding: 0 24px; font-weight: 700; font-size: 13px; letter-spacing: 1px; cursor: pointer; transition: background 0.3s; display: flex; align-items: center; justify-content: center;" data-i18n="search_btn">
                                SEARCH
                            </button>
                        </form>
                    </div>

                    {{-- Phone Support --}}
                    <div class="hero__search__phone d-flex align-items-center" style="float: none; margin: 0;">
                        <div class="hero__search__phone__icon" style="float: none; margin-right: 12px;">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5 style="font-size: 14px; margin-bottom: 2px;">+65 11.188.888</h5>
                            <span style="font-size: 12px;" data-i18n="support_time">support 24/7 time</span>
                        </div>
                    </div>

                    {{-- Login & Register & Cart (Top Right Placement) --}}
                    <div class="hero__search__auth d-flex align-items-center" style="margin-left: auto; gap: 10px;">
                        {{-- Shopping Bag --}}
                        <a href="{{ route('cart.index') }}" class="d-flex align-items-center" style="text-decoration: none; padding: 7px 12px; background: #f5f5f5; border-radius: 25px; transition: all 0.3s;" title="View Shopping Bag">
                            <div style="position: relative; margin-right: 8px; color: #1c1c1c;">
                                <i class="fa fa-shopping-bag" style="font-size: 16px;"></i>
                                <span class="badge badge-success cart-badge-count" style="position: absolute; top: -8px; right: -10px; font-size: 10px; background-color: #7fad39; border-radius: 50%; min-width: 16px; height: 16px; line-height: 14px; padding: 1px 3px;">
                                    {{ $globalCartCount ?? \App\Services\CartService::getCount() }}
                                </span>
                            </div>
                            <span class="cart-badge-total font-weight-bold" style="font-size: 13px; color: #1c1c1c;">
                                ${{ number_format($globalCartSubtotal ?? \App\Services\CartService::getSubtotal(), 2) }}
                            </span>
                        </a>

                        {{-- Login / Register or User Account --}}
                        @auth
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle d-flex align-items-center" data-toggle="dropdown" style="text-decoration: none; padding: 6px 14px; background: #f0f7e9; border: 1px solid #7fad39; border-radius: 25px; color: #1c1c1c; font-weight: 600; font-size: 13px;">
                                    <i class="fa fa-user-circle mr-2" style="font-size: 16px; color: #7fad39;"></i>
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow-sm border-0" style="font-size: 13px; min-width: 150px; border-radius: 8px; margin-top: 6px;">
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger" style="cursor: pointer;">
                                            <i class="fa fa-sign-out mr-2"></i> <span data-i18n="logout">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="d-flex align-items-center" style="gap: 8px;">
                                <a href="{{ route('login') }}" class="btn" style="border: 1px solid #7fad39; color: #7fad39; font-weight: 700; font-size: 13px; padding: 8px 16px; border-radius: 25px; text-decoration: none; line-height: 1.2;">
                                    <i class="fa fa-user mr-1"></i> <span data-i18n="login">Login</span>
                                </a>
                                <a href="{{ route('register') }}" class="btn" style="background: #7fad39; color: #ffffff; font-weight: 700; font-size: 13px; padding: 8px 16px; border-radius: 25px; text-decoration: none; line-height: 1.2; box-shadow: 0 2px 6px rgba(127,173,57,0.3);" data-i18n="register">
                                    Register
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>

                @if($isHome)
                    <div class="hero__item hero__item--video">
                        <video class="hero__video" autoplay muted loop playsinline aria-hidden="true" poster="{{ asset('img/hero.webp') }}">
                            <source src="{{ asset('video/hero.mp4') }}" type="video/mp4">
                        </video>
                        <div class="hero__text">
                            <span data-i18n="organic_badge">BOTANICAL SKINCARE</span>
                            <h2 data-i18n="hero_title">Natural &amp; <br />Organic Beauty</h2>
                            <p data-i18n="hero_subtitle">Free Pickup and Delivery Available</p>
                            <a href="{{ route('shop.index') }}" class="primary-btn" data-i18n="shop_now">SHOP NOW</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
