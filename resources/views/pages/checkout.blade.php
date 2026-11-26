@extends('layouts.master')
@section('title', 'LIVA | Checkout')

@section('hero')
    @include('partials.hero', ['isHome' => false])
@endsection

@section('breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Checkout',
        'subtitle' => 'Checkout'
    ])
@endsection

@section('content')
    @push('styles')
        <style>
            .payment-qr-panel {
                max-height: 0;
                opacity: 0;
                overflow: hidden;
                transition: max-height 350ms ease, opacity 250ms ease;
            }

            .payment-qr-panel.is-open {
                max-height: 360px;
                opacity: 1;
            }

            @media (prefers-reduced-motion: reduce) {
                .payment-qr-panel {
                    transition: none;
                }
            }
        </style>
    @endpush

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row" id="checkout-empty-state" style="{{ (empty($cart) || count($cart) === 0) ? '' : 'display: none;' }}">
                <div class="col-lg-12 text-center py-5" style="background: #fafafa; border-radius: 8px;">
                    <div style="font-size: 54px; color: #b8975a; margin-bottom: 20px;">
                        <i class="fa fa-shopping-bag"></i>
                    </div>
                    <h3>Your Botanical Bag is Empty</h3>
                    <p class="text-muted mt-2 mb-4">Please add your favorite botanical skincare items before proceeding to checkout.</p>
                    <a href="{{ route('shop.index') }}" class="primary-btn">EXPLORE BOTANICAL COLLECTION</a>
                </div>
            </div>

            <div class="checkout__form" id="checkout-form-state" style="{{ (empty($cart) || count($cart) === 0) ? 'display: none;' : '' }}">
                <h4>Botanical Order &amp; Delivery Details</h4>
                <form action="{{ route('checkout.process') }}" method="POST" id="checkout-submit-form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Name</p>
                                        <input type="text" name="first_name" value="{{ old('first_name', auth()->user() ? explode(' ', auth()->user()->name)[0] : '') }}" autocomplete="given-name" >
                                    </div>
                                </div>
                                 <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone Number<span>*</span></p>
                                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+855 12 345 678" inputmode="tel" autocomplete="tel" maxlength="30" required>
                                    </div>
                                </div>
                             
                            </div>
                            
                            <div class="checkout__input">
                                <p>Delivery Address<span>*</span></p>
                                <input type="text" name="address" value="{{ old('address') }}" placeholder="Street address, building, apartment" class="checkout__input__add" autocomplete="street-address" maxlength="255" required>
                            </div>
                           
                           <div class="checkout__input w-100 mb-3">
                                    <label for="notes" class="form-label">
                                        Delivery Notes &amp; Special Instructions
                                    </label>

                                    <textarea
                                        id="notes"
                                        name="notes"
                                        class="form-control w-100"
                                        rows="3"
                                        maxlength="500"
                                        placeholder="e.g. Ring doorbell, leave at front desk, special packaging"
                                    >{{ old('notes') }}</textarea>
                                </div>
                        </div>

                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order" style="background: #fdfdfc; border: 1px solid #eae4d9; border-radius: 8px;">
                                <h4>Your Botanical Order</h4>
                                <div class="checkout__order__products">Botanical Item <span>Total</span></div>
                                <ul id="checkout-order-items" style="border-bottom: 1px solid #ebebeb; padding-bottom: 15px; margin-bottom: 15px;">
                                    @foreach($cart as $item)
                                        <li class="d-flex justify-content-between align-items-center mb-2" style="font-size: 14px;">
                                            <span>
                                                {{ $item['name'] }}
                                                <strong style="color: #b8975a;">&times; {{ $item['quantity'] }}</strong>
                                            </span>
                                            <span style="font-weight: 600;">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">
                                    Subtotal <span id="checkout-subtotal">${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="checkout__order__subtotal" style="font-size: 14px; font-weight: normal; color: #666; border-top: none;">
                                    Shipping <span id="checkout-shipping">{{ $shipping > 0 ? '$'.number_format($shipping, 2) : 'FREE' }}</span>
                                </div>
                                <div class="checkout__order__total">
                                    Total <span id="checkout-total">${{ number_format($total, 2) }}</span>
                                </div>

                                <div class="mt-4 mb-3">
                                    <h5 style="font-size: 16px; font-weight: 700; color: #1c1c1c; margin-bottom: 12px;">Payment Method</h5>

                                    @php
                                        $selectedPaymentMethod = old('payment_method', 'aba');
                                    @endphp

                                    <div class="payment-option p-3 mb-2" style="background: #fff; border: 1px solid #ddd; border-radius: 6px;">
                                        <label class="d-flex align-items-center mb-0" style="cursor: pointer; width: 100%;">
                                            <input type="radio" name="payment_method" value="aba" aria-controls="aba-qr-panel" @checked($selectedPaymentMethod === 'aba') style="margin-right: 12px;">
                                            <img src="{{ asset('img/payments/aba.png') }}" alt="ABA Pay" style="height: 24px; margin-right: 10px;">
                                            <div>
                                                <strong>ABA Pay / KHQR</strong>
                                                <div style="font-size: 11px; color: #888;">Instant QR payment via ABA Mobile</div>
                                            </div>
                                        </label>
                                    </div>
                                    <div id="aba-qr-panel" class="payment-qr-panel{{ $selectedPaymentMethod === 'aba' ? ' is-open' : '' }}" aria-hidden="{{ $selectedPaymentMethod === 'aba' ? 'false' : 'true' }}">
                                        <div class="p-3 mb-3 text-center" style="background: #faf8f4; border: 1px solid #dfd3bc; border-radius: 8px;">
                                            <p class="text-muted mb-3" style="font-size: 13px;">Scan this KHQR with ABA Mobile or any Bakong app to pay <strong>${{ number_format($total, 2) }}</strong>.</p>
                                            <img src="{{ asset('img/payments/aba-khqr.png') }}" alt="ABA KHQR" style="max-width: 200px; width: 100%; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                                        </div>
                                    </div>

                                    <div class="payment-option p-3 mb-2" style="background: #fff; border: 1px solid #ddd; border-radius: 6px;">
                                        <label class="d-flex align-items-center mb-0" style="cursor: pointer; width: 100%;">
                                            <input type="radio" name="payment_method" value="canadia" aria-controls="canadia-qr-panel" @checked($selectedPaymentMethod === 'canadia') style="margin-right: 12px;">
                                            <img src="{{ asset('img/payments/canadia-logo.png') }}" alt="Canadia Bank" style="height: 24px; margin-right: 10px;">
                                            <div>
                                                <strong>Canadia Bank KHQR</strong>
                                                <div style="font-size: 11px; color: #888;">Scan with Canadia Mobile or any Bakong app</div>
                                            </div>
                                        </label>
                                    </div>
                                    <div id="canadia-qr-panel" class="payment-qr-panel{{ $selectedPaymentMethod === 'canadia' ? ' is-open' : '' }}" aria-hidden="{{ $selectedPaymentMethod === 'canadia' ? 'false' : 'true' }}">
                                        <div class="p-3 mb-3 text-center" style="background: #faf8f4; border: 1px solid #dfd3bc; border-radius: 8px;">
                                            <p class="text-muted mb-3" style="font-size: 13px;">Scan this KHQR with Canadia Mobile or any Bakong app to pay <strong>${{ number_format($total, 2) }}</strong>.</p>
                                            <img src="{{ asset('img/payments/canadia-khqr.png') }}" alt="Canadia KHQR" style="max-width: 200px; width: 100%; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                                        </div>
                                    </div>

                                    <div class="payment-option p-3 mb-2" style="background: #fff; border: 1px solid #ddd; border-radius: 6px;">
                                        <label class="d-flex align-items-center mb-0" style="cursor: pointer; width: 100%;">
                                            <input type="radio" name="payment_method" value="acleda" aria-controls="acleda-qr-panel" @checked($selectedPaymentMethod === 'acleda') style="margin-right: 12px;">
                                            <img src="{{ asset('img/payments/acleda.png') }}" alt="ACLEDA" style="height: 24px; margin-right: 10px;">
                                            <div>
                                                <strong>ACLEDA Mobile</strong>
                                                <div style="font-size: 11px; color: #888;">Scan with ACLEDA Mobile or any Bakong app</div>
                                            </div>
                                        </label>
                                    </div>
                                    <div id="acleda-qr-panel" class="payment-qr-panel{{ $selectedPaymentMethod === 'acleda' ? ' is-open' : '' }}" aria-hidden="{{ $selectedPaymentMethod === 'acleda' ? 'false' : 'true' }}">
                                        <div class="p-3 mb-3 text-center" style="background: #faf8f4; border: 1px solid #dfd3bc; border-radius: 8px;">
                                            <p class="text-muted mb-3" style="font-size: 13px;">Scan this KHQR with ACLEDA Mobile or any Bakong app to pay <strong>${{ number_format($total, 2) }}</strong>.</p>
                                            <img src="{{ asset('img/payments/canadia-khqr.png') }}" alt="KHQR for ACLEDA payments" style="max-width: 200px; width: 100%; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                                        </div>
                                    </div>

                                    <div class="payment-option p-3 mb-2" style="background: #fff; border: 1px solid #ddd; border-radius: 6px;">
                                        <label class="d-flex align-items-center mb-0" style="cursor: pointer; width: 100%;">
                                            <input type="radio" name="payment_method" value="wing" aria-controls="wing-qr-panel" @checked($selectedPaymentMethod === 'wing') style="margin-right: 12px;">
                                            <img src="{{ asset('img/payments/wing.jpg') }}" alt="Wing" style="height: 24px; margin-right: 10px;">
                                            <div>
                                                <strong>Wing Bank</strong>
                                                <div style="font-size: 11px; color: #888;">Scan with Wing Bank App or any Bakong app</div>
                                            </div>
                                        </label>
                                    </div>
                                    <div id="wing-qr-panel" class="payment-qr-panel{{ $selectedPaymentMethod === 'wing' ? ' is-open' : '' }}" aria-hidden="{{ $selectedPaymentMethod === 'wing' ? 'false' : 'true' }}">
                                        <div class="p-3 mb-3 text-center" style="background: #faf8f4; border: 1px solid #dfd3bc; border-radius: 8px;">
                                            <p class="text-muted mb-3" style="font-size: 13px;">Scan this KHQR with Wing Bank App or any Bakong app to pay <strong>${{ number_format($total, 2) }}</strong>.</p>
                                            <img src="{{ asset('img/payments/canadia-khqr.png') }}" alt="KHQR for Wing payments" style="max-width: 200px; width: 100%; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                                        </div>
                                    </div>

                                    <div class="payment-option p-3 mb-3" style="background: #fff; border: 1px solid #ddd; border-radius: 6px;">
                                        <label class="d-flex align-items-center mb-0" style="cursor: pointer; width: 100%;">
                                            <input type="radio" name="payment_method" value="cod" @checked($selectedPaymentMethod === 'cod') style="margin-right: 12px;">
                                            <i class="fa fa-money fa-lg mr-2" style="font-size: 22px;"></i>
                                            <div>
                                                <strong>Cash on Delivery (COD)</strong>
                                                <div style="font-size: 11px; color: #888;">Pay cash when receiving your parcel</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <p style="font-size: 12px; color: #777; line-height: 1.5;">
                                    By placing this order, you agree to LIVA's botanical organic freshness and satisfaction pledge.
                                </p>
                                <button type="submit" class="site-btn w-100 py-3" style="letter-spacing: 1.5px; font-weight: 700;">
                                    PLACE BOTANICAL ORDER
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    @push('scripts')
        <script>
            document.querySelectorAll('input[name="payment_method"]').forEach(function (paymentMethod) {
                paymentMethod.addEventListener('change', function () {
                    document.querySelectorAll('.payment-qr-panel').forEach(function (qrPanel) {
                        var isSelected = paymentMethod.checked && paymentMethod.getAttribute('aria-controls') === qrPanel.id;

                        qrPanel.classList.toggle('is-open', isSelected);
                        qrPanel.setAttribute('aria-hidden', isSelected ? 'false' : 'true');
                    });
                });
            });

            // Populate checkout items and order totals from client-side cart (for static hosts like GitHub Pages)
            if (window.LivaCart) {
                var emptyState = document.getElementById('checkout-empty-state');
                var formState = document.getElementById('checkout-form-state');
                var itemsList = document.getElementById('checkout-order-items');
                var subtotalEl = document.getElementById('checkout-subtotal');
                var shippingEl = document.getElementById('checkout-shipping');
                var totalEl = document.getElementById('checkout-total');
                var clientCount = window.LivaCart.getCount();

                if (clientCount > 0) {
                    if (emptyState) emptyState.style.display = 'none';
                    if (formState) formState.style.display = 'block';

                    if (itemsList) {
                        itemsList.innerHTML = '';
                        var items = window.LivaCart.getItems();
                        for (var k in items) {
                            var item = items[k];
                            var li = document.createElement('li');
                            li.className = 'd-flex justify-content-between align-items-center mb-2';
                            li.style.fontSize = '14px';
                            li.innerHTML =
                                '<span>' + item.name + ' <strong style="color: #b8975a;">&times; ' + item.quantity + '</strong></span>' +
                                '<span style="font-weight: 600;">$' + (item.price * item.quantity).toFixed(2) + '</span>';
                            itemsList.appendChild(li);
                        }
                    }

                    var subtotal = window.LivaCart.getSubtotal();
                    var shipping = (subtotal >= 50 || subtotal === 0) ? 0 : 5.00;
                    var total = subtotal + shipping;

                    if (subtotalEl) subtotalEl.textContent = '$' + subtotal.toFixed(2);
                    if (shippingEl) shippingEl.textContent = shipping > 0 ? '$' + shipping.toFixed(2) : 'FREE';
                    if (totalEl) totalEl.textContent = '$' + total.toFixed(2);
                }
            }

            var checkoutForm = document.getElementById('checkout-submit-form');
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function (e) {
                    // Check if running on GitHub Pages (static environment)
                    if (window.location.hostname.indexOf('github.io') !== -1) {
                        e.preventDefault();
                        alert('Order simulated successfully!\n\nNote: This is a static GitHub Pages preview demo. In a live production environment with PHP and database, your order is recorded and QR payment is verified in real-time.');
                        if (window.LivaCart) {
                            window.LivaCart.clear();
                        }
                        window.location.href = '{{ route("shop.index") }}';
                    }
                });
            }
        </script>
    @endpush
@endsection
