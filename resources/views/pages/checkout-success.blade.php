@extends('layouts.master')
@section('title', 'LIVA | Order Confirmed')

@section('hero')
    @include('partials.hero', ['isHome' => false])
@endsection

@section('breadcrumb')
    @include('partials.breadcrumb', [
        'title' => 'Order Confirmation',
        'subtitle' => 'Order Confirmed'
    ])
@endsection

@section('content')
    <section class="checkout-success spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 12px; background: #fff;">
                        <div class="text-center mb-4">
                            <div style="width: 72px; height: 72px; background: #f7f3eb; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                <i class="fa fa-check fa-2x" style="color: #b8975a;"></i>
                            </div>
                            <h2 style="font-family: 'Cormorant Garamond', Georgia, serif; font-weight: 700; color: #1F2421;">Thank You For Your Order!</h2>
                            <p class="text-muted">Your botanical order has been received and is being prepared with organic care.</p>
                            <span class="badge badge-light px-3 py-2" style="font-size: 15px; background: #f7f3eb; color: #8f713b; border: 1px dashed #b8975a;">
                                Order Reference: <strong>#{{ $order['order_id'] ?? 'LIVA-ORDER' }}</strong>
                            </span>
                        </div>

                        <hr class="my-4">

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <h6 class="text-uppercase text-muted" style="font-size: 12px; letter-spacing: 1px;">Customer Information</h6>
                                <p class="mb-1 font-weight-bold">{{ $order['customer']['first_name'] ?? '' }} {{ $order['customer']['last_name'] ?? '' }}</p>
                                <p class="mb-1 text-muted" style="font-size: 14px;"><i class="fa fa-envelope mr-1"></i> {{ $order['customer']['email'] ?? '' }}</p>
                                <p class="mb-0 text-muted" style="font-size: 14px;"><i class="fa fa-phone mr-1"></i> {{ $order['customer']['phone'] ?? '' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-uppercase text-muted" style="font-size: 12px; letter-spacing: 1px;">Delivery Address</h6>
                                <p class="mb-1 text-muted" style="font-size: 14px;">{{ $order['customer']['address'] ?? '' }}</p>
                                <p class="mb-0 text-muted" style="font-size: 14px;">{{ $order['customer']['city'] ?? '' }}, {{ $order['customer']['country'] ?? 'Cambodia' }}</p>
                            </div>
                        </div>

                        @if(in_array(($order['payment_method'] ?? ''), ['aba', 'canadia', 'acleda', 'wing'], true))
                            <div class="p-3 mb-4 text-center" style="background: #faf8f4; border: 1px solid #dfd3bc; border-radius: 8px;">
                                <h6 style="color: #8f713b; font-weight: 700; margin-bottom: 8px;">
                                    @if(($order['payment_method'] ?? '') === 'canadia')
                                        <img src="{{ asset('img/payments/canadia-logo.png') }}" alt="Canadia Bank" style="height: 20px; margin-right: 8px;">
                                        Scan with Canadia Mobile or any Bakong App
                                    @elseif(($order['payment_method'] ?? '') === 'acleda')
                                        <img src="{{ asset('img/payments/acleda.png') }}" alt="ACLEDA" style="height: 20px; margin-right: 8px;">
                                        Scan with ACLEDA Mobile or any Bakong App
                                    @elseif(($order['payment_method'] ?? '') === 'wing')
                                        <img src="{{ asset('img/payments/wing.jpg') }}" alt="Wing" style="height: 20px; margin-right: 8px;">
                                        Scan with Wing Bank App or any Bakong App
                                    @else
                                        <img src="{{ asset('img/payments/aba.png') }}" alt="ABA" style="height: 20px; margin-right: 8px;">
                                        Scan with ABA Mobile or any Bakong App
                                    @endif
                                </h6>
                                <p class="text-muted mb-3" style="font-size: 13px;">Scan this KHQR to complete your instant payment of <strong>${{ number_format($order['total'] ?? 0, 2) }}</strong>.</p>
                                @if(($order['payment_method'] ?? '') === 'aba')
                                    <img src="{{ asset('img/payments/aba-khqr.png') }}" alt="ABA KHQR" style="max-width: 200px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                                @else
                                    <img src="{{ asset('img/payments/canadia-khqr.png') }}" alt="KHQR payment code" style="max-width: 200px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                                @endif
                            </div>
                        @endif

                        <h6 class="text-uppercase text-muted mb-3" style="font-size: 12px; letter-spacing: 1px;">Ordered Items</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    @foreach(($order['items'] ?? []) as $item)
                                        <tr style="border-bottom: 1px solid #f2f2f2;">
                                            <td style="padding: 10px 0; width: 60px;">
                                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                            </td>
                                            <td style="padding: 10px 15px; vertical-align: middle;">
                                                <div class="font-weight-bold" style="font-size: 14px;">{{ $item['name'] }}</div>
                                                <div class="text-muted" style="font-size: 12px;">Qty: {{ $item['quantity'] }} &times; ${{ number_format($item['price'], 2) }}</div>
                                            </td>
                                            <td class="text-right font-weight-bold" style="padding: 10px 0; vertical-align: middle;">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mb-2" style="font-size: 14px;">
                            <span class="text-muted">Subtotal</span>
                            <span class="font-weight-bold">${{ number_format($order['subtotal'] ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size: 14px;">
                            <span class="text-muted">Botanical Shipping</span>
                            <span class="font-weight-bold">{{ ($order['shipping'] ?? 0) > 0 ? '$'.number_format($order['shipping'], 2) : 'FREE' }}</span>
                        </div>
                        <div class="d-flex justify-content-between pt-2 border-top mb-4" style="font-size: 18px;">
                            <span class="font-weight-bold">Grand Total</span>
                            <span class="font-weight-bold" style="color: #8f713b;">${{ number_format($order['total'] ?? 0, 2) }}</span>
                        </div>

                        <div class="text-center pt-2">
                            <a href="{{ route('shop.index') }}" class="primary-btn" style="padding: 14px 36px; letter-spacing: 1px;">
                                CONTINUE SHOPPING
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
