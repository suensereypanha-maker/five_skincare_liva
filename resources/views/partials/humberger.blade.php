<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="{{ route('home') }}" class="d-flex align-items-center" style="gap: 10px; text-decoration: none;">
            <img src="{{ asset('img/favicon.svg') }}" alt="LIVA" style="max-height: 40px; width: 40px; border-radius: 8px;">
            <span style="font-size: 24px; font-weight: 700; letter-spacing: 0.12em; color: #1F2421; font-family: 'Cormorant Garamond', Georgia, serif;">LIVA</span>
        </a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="{{ route('shop.index') }}"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li>
                <a href="{{ route('cart.index') }}">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="cart-badge-count">{{ $globalCartCount ?? \App\Services\CartService::getCount() }}</span>
                </a>
            </li>
        </ul>
        <div class="header__cart__price">
            <span data-i18n="bag_label">bag:</span> <span class="cart-badge-total">${{ number_format($globalCartSubtotal ?? \App\Services\CartService::getSubtotal(), 2) }}</span>
        </div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <div class="js-current-lang-label">🇬🇧 English</div>
            <span class="arrow_carrot-down"></span>
            <ul style="width: 140px; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999;">
                <li><a href="javascript:void(0)" onclick="setAppLanguage('en')">🇬🇧 English</a></li>
                <li><a href="javascript:void(0)" onclick="setAppLanguage('km')">🇰🇭 ភាសាខ្មែរ</a></li>
            </ul>
        </div>
        <div class="header__top__right__auth">
            @auth
                <div style="font-size: 14px;">
                    <span style="display: block; margin-bottom: 5px;"><i class="fa fa-user"></i> {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #dc3545; font-size: 13px; font-weight: 600; padding: 0;">
                            <i class="fa fa-sign-out"></i> <span data-i18n="logout">Logout</span>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" style="display: inline-block; font-weight: 600; color: #1c1c1c;"><i class="fa fa-user mr-1"></i> <span data-i18n="login">Login</span></a>
                <span style="margin: 0 6px; color: #bbb;">/</span>
                <a href="{{ route('register') }}" style="display: inline-block; font-weight: 600; color: #7fad39;" data-i18n="register">Register</a>
            @endauth
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}" data-i18n="home">Home</a></li>
            <li class="{{ request()->routeIs('shop.index', 'shop.show', 'shop.details') ? 'active' : '' }}"><a href="{{ route('shop.index') }}" data-i18n="shop">Shop</a></li>
            <li class="{{ request()->routeIs('cart.index', 'checkout.index', 'checkout.success') ? 'active' : '' }}"><a href="#" data-i18n="pages">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="{{ route('shop.index') }}" data-i18n="botanical_shop">Botanical Shop</a></li>
                    <li><a href="{{ route('cart.index') }}" data-i18n="shopping_bag">Shopping Bag</a></li>
                    <li><a href="{{ route('checkout.index') }}" data-i18n="checkout">Check Out</a></li>
                    <li><a href="{{ route('blog.index') }}" data-i18n="skincare_journal">Skincare Journal</a></li>
                </ul>
            </li>
            <li class="{{ request()->routeIs('blog.index', 'blog.details', 'blog.show') ? 'active' : '' }}"><a href="{{ route('blog.index') }}" data-i18n="blog">Blog</a></li>
            <li class="{{ request()->routeIs('contact.index') ? 'active' : '' }}"><a href="{{ route('contact.index') }}" data-i18n="contact">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> care@livaskincare.com</li>
            <li data-i18n="free_shipping">Free Botanical Shipping for all Orders over $50</li>
        </ul>
    </div>
</div>
