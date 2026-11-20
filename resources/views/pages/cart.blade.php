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
        <div class="container">
            @if(empty($cart) || count($cart) === 0)
                <div class="row">
                    <div class="col-lg-12 text-center py-5" style="background: #fafafa; border-radius: 8px;">
                        <div style="font-size: 54px; color: #7fad39; margin-bottom: 20px;">
                            <i class="fa fa-shopping-bag"></i>
                        </div>
                        <h3>Your Botanical Bag is Empty</h3>
                        <p class="text-muted mt-2 mb-4">You haven't added any botanical skincare items to your bag yet.</p>
                        <a href="{{ route('shop.index') }}" class="primary-btn">EXPLORE BOTANICAL COLLECTION</a>
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
