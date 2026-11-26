@extends('layouts.master')
@section('title', 'LIVA | Shopping Bag')

@section('hero')
    @include('partials.hero', ['isHome' => false])
@endsection

@section('breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Shopping Bag',
        'subtitle' => 'Shopping Bag'
    ])
@endsection

@section('content')
    <!-- Shopping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container" id="liva-cart-main-container">
            @if(empty($cart) || count($cart) === 0)
                <div class="row" id="liva-cart-empty-view">
                    <div class="col-lg-12 text-center py-5" style="background: #fafafa; border-radius: 8px;">
                        <div style="font-size: 54px; color: #b8975a; margin-bottom: 20px;">
                            <i class="fa fa-shopping-bag"></i>
                        </div>
                        <h3>Your Botanical Bag is Empty</h3>
                        <p class="text-muted mt-2 mb-4">You haven't added any botanical skincare items to your bag yet.</p>
                        <a href="{{ route('shop.index') }}" class="primary-btn">EXPLORE BOTANICAL COLLECTION</a>
                    </div>
                </div>

                {{-- Client-Side Dynamic View for Static Deployments (e.g. GitHub Pages) --}}
                <div id="liva-cart-dynamic-view" style="display: none;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="shoping__product">Botanical Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="liva-cart-dynamic-tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__btns d-flex justify-content-between align-items-center flex-wrap" style="gap: 10px;">
                                <a href="{{ route('shop.index') }}" class="primary-btn cart-btn">
                                    <i class="fa fa-arrow-left mr-2"></i> CONTINUE SHOPPING
                                </a>
                                <div>
                                    <button type="button" id="liva-client-clear-cart" class="primary-btn cart-btn" style="background:#fff; border:1px solid #dc3545; color:#dc3545; cursor:pointer;">
                                        <i class="fa fa-trash mr-2"></i> CLEAR BAG
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <div class="shoping__continue">
                                <div class="shoping__discount">
                                    <h5>Botanical Promotion Code</h5>
                                    <form action="#" onsubmit="event.preventDefault(); alert('Coupon applied! 10% botanical welcome discount active.');">
                                        <input type="text" placeholder="Enter coupon code (e.g. BOTANICAL10)">
                                        <button type="submit" class="site-btn">APPLY</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="shoping__checkout">
                                <h5>Order Summary</h5>
                                <ul>
                                    <li>Subtotal <span id="liva-client-subtotal">$0.00</span></li>
                                    <li>Shipping <span id="liva-client-shipping">FREE</span></li>
                                    <li>Total <span id="liva-client-total">$0.00</span></li>
                                </ul>
                                <a href="{{ route('checkout.index') }}" class="primary-btn text-center d-block">
                                    PROCEED TO CHECKOUT <i class="fa fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <form action="{{ route('cart.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="shoping__product">Botanical Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart as $id => $item)
                                            <tr>
                                                <td class="shoping__cart__item">
                                                    <a href="{{ route('shop.show', $item['id']) }}" class="d-flex align-items-center" style="text-decoration: none; color: inherit;">
                                                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px; margin-right: 20px;">
                                                        <div>
                                                            <span style="font-size: 12px; color: #888; display: block;">{{ $item['category_name'] ?? 'Skincare' }}</span>
                                                            <h5 class="mb-0">{{ $item['name'] }}</h5>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    ${{ number_format($item['price'], 2) }}
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input type="text" name="quantities[{{ $item['id'] }}]" value="{{ $item['quantity'] }}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                                </td>
                                                <td class="shoping__cart__item__close">
                                                    <a href="javascript:void(0)" onclick="document.getElementById('remove-item-{{ $item['id'] }}').submit();" title="Remove item">
                                                        <span class="icon_close"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__btns d-flex justify-content-between align-items-center flex-wrap" style="gap: 10px;">
                                <a href="{{ route('shop.index') }}" class="primary-btn cart-btn">
                                    <i class="fa fa-arrow-left mr-2"></i> CONTINUE SHOPPING
                                </a>
                                <div>
                                    <button type="submit" class="primary-btn cart-btn">
                                        <i class="fa fa-refresh mr-2"></i> UPDATE BAG
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Hidden Delete Forms --}}
                @foreach($cart as $id => $item)
                    <form id="remove-item-{{ $item['id'] }}" action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach

                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="shoping__continue">
                            <div class="shoping__discount">
                                <h5>Botanical Promotion Code</h5>
                                <form action="#" onsubmit="event.preventDefault(); alert('Coupon applied! 10% botanical welcome discount active.');">
                                    <input type="text" placeholder="Enter coupon code (e.g. BOTANICAL10)">
                                    <button type="submit" class="site-btn">APPLY</button>
                                </form>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <h5>Order Summary</h5>
                            <ul>
                                <li>Subtotal <span>${{ number_format($subtotal, 2) }}</span></li>
                                <li>Shipping <span>{{ $shipping > 0 ? '$'.number_format($shipping, 2) : 'FREE' }}</span></li>
                                <li>Total <span>${{ number_format($total, 2) }}</span></li>
                            </ul>
                            <a href="{{ route('checkout.index') }}" class="primary-btn text-center d-block">
                                PROCEED TO CHECKOUT <i class="fa fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection

@push('scripts')
<script>
    function initClientBag() {
        var emptyView = document.getElementById('liva-cart-empty-view');
        var dynamicView = document.getElementById('liva-cart-dynamic-view');
        var tbody = document.getElementById('liva-cart-dynamic-tbody');
        var subtotalEl = document.getElementById('liva-client-subtotal');
        var shippingEl = document.getElementById('liva-client-shipping');
        var totalEl = document.getElementById('liva-client-total');
        var clearBtn = document.getElementById('liva-client-clear-cart');

        if (!emptyView || !dynamicView || !tbody || typeof window.LivaCart === 'undefined') {
            return;
        }

        function renderClientBag() {
            var items = window.LivaCart.getItems();
            var keys = Object.keys(items);

            if (keys.length === 0) {
                emptyView.style.display = 'block';
                dynamicView.style.display = 'none';
                return;
            }

            emptyView.style.display = 'none';
            dynamicView.style.display = 'block';
            tbody.innerHTML = '';

            var subtotal = 0;

            keys.forEach(function (key) {
                var item = items[key];
                var lineTotal = item.price * item.quantity;
                subtotal += lineTotal;

                var tr = document.createElement('tr');
                tr.innerHTML =
                    '<td class="shoping__cart__item">' +
                        '<a href="' + (item.url || '#') + '" class="d-flex align-items-center" style="text-decoration:none; color:inherit;">' +
                            '<img src="' + item.image + '" alt="' + item.name + '" style="width:80px; height:80px; object-fit:cover; border-radius:6px; margin-right:20px;">' +
                            '<div>' +
                                '<span style="font-size:12px; color:#888; display:block;">' + (item.category_name || 'Botanical Care') + '</span>' +
                                '<h5 class="mb-0">' + item.name + '</h5>' +
                            '</div>' +
                        '</a>' +
                    '</td>' +
                    '<td class="shoping__cart__price">$' + Number(item.price).toFixed(2) + '</td>' +
                    '<td class="shoping__cart__quantity">' +
                        '<div class="quantity d-flex align-items-center justify-content-center" style="gap:6px;">' +
                            '<button type="button" class="btn btn-sm btn-outline-secondary js-cart-dec" data-id="' + item.id + '" style="width:30px; height:30px; line-height:1; padding:0; font-weight:700;">-</button>' +
                            '<input type="text" value="' + item.quantity + '" readonly style="width:42px; height:30px; text-align:center; border:1px solid #ddd; border-radius:4px; font-weight:600;">' +
                            '<button type="button" class="btn btn-sm btn-outline-secondary js-cart-inc" data-id="' + item.id + '" style="width:30px; height:30px; line-height:1; padding:0; font-weight:700;">+</button>' +
                        '</div>' +
                    '</td>' +
                    '<td class="shoping__cart__total">$' + Number(lineTotal).toFixed(2) + '</td>' +
                    '<td class="shoping__cart__item__close">' +
                        '<a href="javascript:void(0)" class="js-cart-remove" data-id="' + item.id + '" title="Remove item" style="color:#dc3545; font-size:18px;">' +
                            '<span class="icon_close"></span>' +
                        '</a>' +
                    '</td>';
                tbody.appendChild(tr);
            });

            var shipping = (subtotal >= 50 || subtotal === 0) ? 0 : 5.00;
            var grandTotal = subtotal + shipping;

            if (subtotalEl) subtotalEl.textContent = '$' + subtotal.toFixed(2);
            if (shippingEl) shippingEl.textContent = shipping > 0 ? '$' + shipping.toFixed(2) : 'FREE';
            if (totalEl) totalEl.textContent = '$' + grandTotal.toFixed(2);
        }

        tbody.addEventListener('click', function (e) {
            var decBtn = e.target.closest('.js-cart-dec');
            var incBtn = e.target.closest('.js-cart-inc');
            var remBtn = e.target.closest('.js-cart-remove');

            if (decBtn) {
                var id = decBtn.getAttribute('data-id');
                var items = window.LivaCart.getItems();
                if (items[id]) {
                    window.LivaCart.updateItem(id, items[id].quantity - 1);
                    renderClientBag();
                }
            } else if (incBtn) {
                var id = incBtn.getAttribute('data-id');
                var items = window.LivaCart.getItems();
                if (items[id]) {
                    window.LivaCart.updateItem(id, items[id].quantity + 1);
                    renderClientBag();
                }
            } else if (remBtn) {
                var id = remBtn.getAttribute('data-id');
                window.LivaCart.removeItem(id);
                renderClientBag();
            }
        });

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                if (confirm('Clear your shopping bag?')) {
                    window.LivaCart.clear();
                    renderClientBag();
                }
            });
        }

        renderClientBag();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initClientBag);
    } else {
        initClientBag();
    }
    window.addEventListener('pageshow', initClientBag);
</script>
@endpush
