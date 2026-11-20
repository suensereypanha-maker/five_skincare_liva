<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> care@livaskincare.com</li>
                            <li>Free Botanical Shipping for all Orders over $50</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">English</a></li>
                                <li><a href="#">Khmer</a></li>
                            </ul>
                        </div>
                        <div class="header__top__right__auth d-flex align-items-center">
                            @auth
                                <div class="dropdown" style="display: inline-block;">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #1c1c1c; font-weight: 600; display: inline-block;">
                                        <i class="fa fa-user-circle mr-1"></i> {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" style="font-size: 14px; min-width: 140px; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="dropdown-item" style="cursor: pointer; color: #dc3545; padding: 8px 16px;">
                                                <i class="fa fa-sign-out mr-1"></i> Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('login') }}" style="display: inline-block; font-size: 14px; font-weight: 600; color: #1c1c1c; text-decoration: none;">
                                    <i class="fa fa-user mr-1"></i> Login
                                </a>
                                <span style="margin: 0 8px; color: #bbb; font-weight: 400;">/</span>
                                <a href="{{ route('register') }}" style="display: inline-block; font-size: 14px; font-weight: 600; color: #7fad39; text-decoration: none;">
                                    Register
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('home') }}" class="d-flex align-items-center" style="gap: 10px; text-decoration: none;">
                        <img src="{{ asset('img/favicon.svg') }}" alt="LIVA" style="max-height: 44px; width: 44px; border-radius: 8px;">
                        <span style="font-size: 26px; font-weight: 700; letter-spacing: 0.12em; color: #1F2421; font-family: 'Cormorant Garamond', Georgia, serif;">LIVA</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                        <li class="{{ request()->routeIs('shop.index', 'shop.show', 'shop.details') ? 'active' : '' }}"><a href="{{ route('shop.index') }}">Shop</a></li>
                        <li class="{{ request()->routeIs('cart.index', 'checkout.index', 'checkout.success') ? 'active' : '' }}"><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="{{ route('shop.index') }}">Botanical Shop</a></li>
                                <li><a href="{{ route('cart.index') }}">Shopping Bag</a></li>
                                <li><a href="{{ route('checkout.index') }}">Check Out</a></li>
                                <li><a href="{{ route('blog.index') }}">Skincare Journal</a></li>
                            </ul>
                        </li>
                        <li class="{{ request()->routeIs('blog.index', 'blog.details', 'blog.show') ? 'active' : '' }}"><a href="{{ route('blog.index') }}">Blog</a></li>
                        <li class="{{ request()->routeIs('contact.index') ? 'active' : '' }}"><a href="{{ route('contact.index') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="{{ route('shop.index') }}" title="Botanical Favorites"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li>
                            <a href="{{ route('cart.index') }}" title="View Shopping Bag">
                                <i class="fa fa-shopping-bag"></i>
                                <span class="cart-badge-count">{{ $globalCartCount ?? \App\Services\CartService::getCount() }}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="header__cart__price">
                        bag: <span class="cart-badge-total">${{ number_format($globalCartSubtotal ?? \App\Services\CartService::getSubtotal(), 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
