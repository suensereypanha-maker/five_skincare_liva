<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="LIVA Botanical Skincare">
    <meta name="keywords" content="LIVA, skincare, botanical, beauty, organic">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/favicon.svg') }}">
    <title>@yield('title', 'LIVA | Botanical Skincare')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&amp;family=Kantumruy+Pro:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ @filemtime(public_path('css/style.css')) ?: '2.2' }}" type="text/css">

    @stack('styles')
</head>

<body>
    <!-- Humberger Begin -->
    @include('partials.humberger')
    <!-- Humberger End -->



    <!-- Hero Section Begin -->
    @yield('hero')
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    @yield('breadcrumb')
    <!-- Breadcrumb Section End -->

    <!-- Flash Messages -->
    @if(session('success') || session('error') || session('info') || $errors->any())
        <div class="container pt-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #f7f3eb; color: #8f713b; border-color: #dfd3bc; border-radius: 6px;">
                    <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 6px;">
                    <i class="fa fa-exclamation-circle mr-2"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert" style="border-radius: 6px;">
                    <i class="fa fa-info-circle mr-2"></i> {{ session('info') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 6px;">
                    <ul class="mb-0 pl-3">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content Begin -->
    @yield('content')
    <!-- Main Content End -->

    <!-- Footer Section Begin -->
    @include('partials.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}?v={{ @filemtime(public_path('js/main.js')) ?: '2.2' }}"></script>
    <script src="{{ asset('js/liva-i18n.js') }}?v={{ @filemtime(public_path('js/liva-i18n.js')) ?: '2.2' }}"></script>
    <script src="{{ asset('js/liva-social-auth.js') }}?v={{ @filemtime(public_path('js/liva-social-auth.js')) ?: '2.2' }}"></script>

    @php
        $clientCatalog = [];
        foreach (\App\Services\ProductService::getAllProducts() as $prod) {
            $clientCatalog[$prod['id']] = [
                'id' => $prod['id'],
                'name' => $prod['name'],
                'price' => (float) $prod['price'],
                'image' => asset($prod['image']),
                'category_name' => $prod['category_name'] ?? 'Botanical Care',
                'url' => route('shop.show', $prod['id']),
            ];
        }
    @endphp
    <script id="liva-products-data" type="application/json">
        {!! json_encode($clientCatalog) !!}
    </script>

    <div id="cart-toast" role="status" aria-live="polite"
        style="display:none; position:fixed; top:25px; right:25px; z-index:99999; min-width:280px; max-width:420px; background:#1F2421; color:#fff; border-left:5px solid #b8975a; border-radius:8px; padding:14px 20px; box-shadow:0 8px 24px rgba(0,0,0,.25); font-size:14px;">
    </div>

    <script>
        // Global client-side cart manager for static deployments (e.g. GitHub Pages)
        window.LivaCart = (function () {
            var STORAGE_KEY = 'liva_botanical_cart';

            function getCatalog() {
                var el = document.getElementById('liva-products-data');
                if (!el) return {};
                try {
                    return JSON.parse(el.textContent) || {};
                } catch (e) {
                    return {};
                }
            }

            function getItems() {
                try {
                    return JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
                } catch (e) {
                    return {};
                }
            }

            function saveItems(items) {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
                syncUI();
            }

            function addItem(productId, quantity) {
                var catalog = getCatalog();
                var product = catalog[productId];
                if (!product) {
                    for (var k in catalog) {
                        if (String(catalog[k].id) === String(productId)) {
                            product = catalog[k];
                            break;
                        }
                    }
                }
                if (!product) return null;

                var items = getItems();
                var q = parseInt(quantity, 10) || 1;
                var key = String(product.id);

                if (items[key]) {
                    items[key].quantity += q;
                } else {
                    items[key] = {
                        id: product.id,
                        name: product.name,
                        price: Number(product.price),
                        image: product.image,
                        category_name: product.category_name,
                        url: product.url,
                        quantity: q
                    };
                }
                saveItems(items);
                return items[key];
            }

            function updateItem(productId, quantity) {
                var items = getItems();
                var key = String(productId);
                var q = parseInt(quantity, 10);
                if (q <= 0) {
                    delete items[key];
                } else if (items[key]) {
                    items[key].quantity = q;
                }
                saveItems(items);
            }

            function removeItem(productId) {
                var items = getItems();
                var key = String(productId);
                delete items[key];
                saveItems(items);
            }

            function clear() {
                localStorage.removeItem(STORAGE_KEY);
                syncUI();
            }

            function getCount() {
                var items = getItems();
                var count = 0;
                for (var k in items) {
                    count += (parseInt(items[k].quantity, 10) || 0);
                }
                return count;
            }

            function getSubtotal() {
                var items = getItems();
                var total = 0;
                for (var k in items) {
                    total += (items[k].price * (parseInt(items[k].quantity, 10) || 0));
                }
                return total;
            }

            function syncUI() {
                var count = getCount();
                var subtotal = getSubtotal();
                document.querySelectorAll('.cart-badge-count, .cart-nav-count').forEach(function (el) {
                    el.textContent = count;
                });
                document.querySelectorAll('.cart-badge-total').forEach(function (el) {
                    el.textContent = '$' + Number(subtotal).toFixed(2);
                });
            }

            return {
                getItems: getItems,
                addItem: addItem,
                updateItem: updateItem,
                removeItem: removeItem,
                clear: clear,
                getCount: getCount,
                getSubtotal: getSubtotal,
                syncUI: syncUI
            };
        })();

        (function () {
            function showCartToast(htmlContent, isError) {
                var toast = document.getElementById('cart-toast');
                if (!toast) return;
                toast.innerHTML = htmlContent;
                toast.style.borderLeftColor = isError ? '#dc3545' : '#b8975a';
                toast.style.display = 'block';
                window.clearTimeout(toast._hideTimer);
                toast._hideTimer = window.setTimeout(function () {
                    toast.style.display = 'none';
                }, 4500);
            }

            function updateCartIndicators(cartCount, cartSubtotal) {
                document.querySelectorAll('.cart-badge-count, .cart-nav-count').forEach(function (badge) {
                    badge.textContent = cartCount;
                });
                document.querySelectorAll('.cart-badge-total').forEach(function (badge) {
                    badge.textContent = '$' + Number(cartSubtotal).toFixed(2);
                });
            }

            function syncIndicators() {
                if (window.LivaCart && window.LivaCart.getCount() > 0) {
                    window.LivaCart.syncUI();
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', syncIndicators);
            } else {
                syncIndicators();
            }
            window.addEventListener('pageshow', syncIndicators);

            document.addEventListener('submit', function (event) {
                var form = event.target;
                if (!form.classList.contains('js-cart-form')) {
                    return;
                }

                event.preventDefault();

                var submitButton = form.querySelector('[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                }

                var formData = new FormData(form);
                var productId = formData.get('product_id');
                var quantity = parseInt(formData.get('quantity'), 10) || 1;
                var csrfMeta = document.querySelector('meta[name="csrf-token"]');
                var isStatic = window.location.hostname.indexOf('github.io') !== -1 || window.location.protocol === 'file:';
                var cartUrl = '{{ route("cart.index") }}';

                if (isStatic) {
                    var added = window.LivaCart ? window.LivaCart.addItem(productId, quantity) : null;
                    var name = added ? added.name : 'Botanical Skincare item';
                    showCartToast(
                        '<div><strong>✓ Added to your bag!</strong>' +
                        '<div style="font-size:12px; opacity:0.85; margin:4px 0 10px;">' + name + ' (Qty: ' + quantity + ')</div>' +
                        '<a href="' + cartUrl + '" style="display:inline-block; background:#b8975a; color:#fff; padding:6px 14px; border-radius:20px; font-weight:700; font-size:12px; text-decoration:none;">View Bag &amp; Checkout &rarr;</a>' +
                        '</div>',
                        false
                    );
                    if (submitButton) {
                        submitButton.disabled = false;
                    }
                    return;
                }

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfMeta ? csrfMeta.content : '',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('Non-server or static environment: ' + response.status);
                    }
                    return response.json();
                })
                .then(function (data) {
                    if (!data.success) {
                        throw new Error(data.message || 'Unable to add this item to your bag.');
                    }
                    updateCartIndicators(data.cart_count, data.cart_subtotal);
                    showCartToast(
                        '<div><strong>✓ ' + data.message + '</strong>' +
                        '<div style="margin-top:8px;">' +
                        '<a href="' + cartUrl + '" style="display:inline-block; background:#b8975a; color:#fff; padding:6px 14px; border-radius:20px; font-weight:700; font-size:12px; text-decoration:none;">View Bag &amp; Checkout &rarr;</a>' +
                        '</div></div>',
                        false
                    );
                })
                .catch(function () {
                    var added = window.LivaCart ? window.LivaCart.addItem(productId, quantity) : null;
                    var name = added ? added.name : 'Botanical Skincare item';
                    showCartToast(
                        '<div><strong>✓ Added to your bag!</strong>' +
                        '<div style="font-size:12px; opacity:0.85; margin:4px 0 10px;">' + name + ' (Qty: ' + quantity + ')</div>' +
                        '<a href="' + cartUrl + '" style="display:inline-block; background:#b8975a; color:#fff; padding:6px 14px; border-radius:20px; font-weight:700; font-size:12px; text-decoration:none;">View Bag &amp; Checkout &rarr;</a>' +
                        '</div>',
                        false
                    );
                })
                .finally(function () {
                    if (submitButton) {
                        submitButton.disabled = false;
                    }
                });
            });
        }());

        // Scroll to Top functionality
        (function () {
            var scrollBtn = document.getElementById('scrollToTopBtn');
            if (!scrollBtn) return;

            window.addEventListener('scroll', function () {
                if (window.pageYOffset > 250) {
                    scrollBtn.style.display = 'flex';
                } else {
                    scrollBtn.style.display = 'none';
                }
            });

            scrollBtn.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            scrollBtn.addEventListener('mouseenter', function () {
                scrollBtn.style.backgroundColor = '#1F2421';
                scrollBtn.style.transform = 'translateY(-3px)';
            });
            scrollBtn.addEventListener('mouseleave', function () {
                scrollBtn.style.backgroundColor = '#b8975a';
                scrollBtn.style.transform = 'translateY(0)';
            });
        }());
    </script>

    <!-- Scroll to Top Button -->
    <button type="button" id="scrollToTopBtn" aria-label="Scroll to top" title="Scroll to top"
        style="display: none; position: fixed; bottom: 30px; right: 30px; z-index: 9999; width: 44px; height: 44px; border-radius: 50%; background: #b8975a; color: #fff; border: none; outline: none; cursor: pointer; box-shadow: 0 4px 14px rgba(184, 151, 90, 0.45); transition: all 0.25s ease; align-items: center; justify-content: center; font-size: 20px;">
        <i class="fa fa-angle-up"></i>
    </button>

    @stack('scripts')
</body>

</html>
