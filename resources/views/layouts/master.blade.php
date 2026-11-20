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
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&amp;display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

    @stack('styles')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

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
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #eaf5ea; color: #2e6930; border-color: #c3e6cb; border-radius: 6px;">
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
    <script src="{{ asset('js/main.js') }}"></script>

    <div id="cart-toast" role="status" aria-live="polite"
        style="display:none; position:fixed; right:20px; bottom:20px; z-index:9999; max-width:320px; background:#1c1c1c; color:#fff; border-left:4px solid #7fad39; border-radius:6px; padding:12px 16px; box-shadow:0 4px 16px rgba(0,0,0,.18);">
    </div>

    <script>
        (function () {
            function showCartToast(message, isError) {
                var toast = document.getElementById('cart-toast');
                toast.textContent = message;
                toast.style.borderLeftColor = isError ? '#dc3545' : '#7fad39';
                toast.style.display = 'block';
                window.clearTimeout(toast._hideTimer);
                toast._hideTimer = window.setTimeout(function () {
                    toast.style.display = 'none';
                }, 3000);
            }

            function updateCartIndicators(cartCount, cartSubtotal) {
                document.querySelectorAll('.cart-badge-count').forEach(function (badge) {
                    badge.textContent = cartCount;
                });
                document.querySelectorAll('.cart-nav-count').forEach(function (badge) {
                    badge.textContent = cartCount;
                });
                document.querySelectorAll('.cart-badge-total').forEach(function (badge) {
                    badge.textContent = '$' + Number(cartSubtotal).toFixed(2);
                });
            }

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

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new FormData(form)
                })
                .then(function (response) {
                    return response.json().then(function (data) {
                        if (!response.ok) {
                            throw new Error(data.message || 'Unable to add this item to your bag.');
                        }
                        return data;
                    });
                })
                .then(function (data) {
                    if (!data.success) {
                        throw new Error(data.message || 'Unable to add this item to your bag.');
                    }

                    updateCartIndicators(data.cart_count, data.cart_subtotal);
                    showCartToast(data.message, false);
                })
                .catch(function (error) {
                    showCartToast(error.message, true);
                })
                .finally(function () {
                    if (submitButton) {
                        submitButton.disabled = false;
                    }
                });
            });
        }());
    </script>

    @stack('scripts')
</body>

</html>
