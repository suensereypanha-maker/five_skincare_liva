@extends('layouts.master')
@section('title', 'LIVA | ' . ($product['name'] ?? 'Botanical Product'))

@section('hero')
    @include('partials.hero', ['isHome' => false])
@endsection

@section('breadcrumb')
    @include('partials.breadcrumb', [
        'title' => $product['name'] ?? 'Product Details',
        'parent' => 'Botanical Shop',
        'parentUrl' => route('shop.index'),
        'subtitle' => $product['name'] ?? 'Details'
    ])
@endsection

@section('content')
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                        </div>
                        @if(!empty($product['gallery']))
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach($product['gallery'] as $img)
                                    <img data-imgbigurl="{{ asset($img) }}"
                                        src="{{ asset($img) }}" alt="{{ $product['name'] }}">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <span class="badge badge-light" style="font-size: 13px; color: #7fad39; background: #f0f7e9; padding: 6px 12px; margin-bottom: 10px; border-radius: 4px;">
                            {{ $product['category_name'] }}
                        </span>
                        <h3>{{ $product['name'] }}</h3>
                        <div class="product__details__rating">
                            @php
                                $rating = (float) ($product['rating'] ?? 5.0);
                                $fullStars = floor($rating);
                                $hasHalf = ($rating - $fullStars) >= 0.5;
                            @endphp
                            @for($i = 0; $i < $fullStars; $i++)
                                <i class="fa fa-star" style="color: #edbb0e;"></i>
                            @endfor
                            @if($hasHalf)
                                <i class="fa fa-star-half-o" style="color: #edbb0e;"></i>
                            @endif
                            <span>({{ $product['reviews_count'] ?? 24 }} botanical reviews)</span>
                        </div>
                        <div class="product__details__price">
                            ${{ number_format($product['price'], 2) }}
                            @if(!empty($product['is_sale']) && !empty($product['original_price']))
                                <span style="font-size: 18px; color: #b2b2b2; text-decoration: line-through; margin-left: 10px;">
                                    ${{ number_format($product['original_price'], 2) }}
                                </span>
                                <span class="badge badge-danger ml-2" style="font-size: 12px; vertical-align: middle;">
                                    {{ $product['discount_percent'] ?? 'SALE' }}
                                </span>
                            @endif
                        </div>
                        <p>{{ $product['short_description'] ?? $product['description'] }}</p>

                        <form action="{{ route('cart.add') }}" method="POST" class="js-cart-form d-flex align-items-center flex-wrap mb-4" style="gap: 15px;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <div class="product__details__quantity mb-0">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="quantity" value="1">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="primary-btn border-0" style="cursor: pointer; padding: 14px 30px; letter-spacing: 1px;">
                                <i class="fa fa-shopping-bag mr-2"></i> ADD TO BAG
                            </button>
                            <a href="#" class="heart-icon" title="Save to Favorites"><span class="icon_heart_alt"></span></a>
                        </form>

                        <ul>
                            <li><b>Availability</b> <span style="color: #28a745;"><i class="fa fa-check-circle"></i> {{ $product['stock'] ?? 'In Stock' }}</span></li>
                            <li><b>Skin Type</b> <span>{{ $product['skin_type'] ?? 'All Skin Types' }}</span></li>
                            <li><b>Net Volume / Size</b> <span>{{ $product['size'] ?? 'Standard' }}</span></li>
                            <li><b>Shipping</b> <span>Same-day dispatch. <samp>Free shipping over $50</samp></span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description &amp; Benefits</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">How to Use</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Customer Reviews <span>({{ $product['reviews_count'] ?? 18 }})</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Botanical Product Overview</h6>
                                    <p>{{ $product['description'] }}</p>
                                    @if(!empty($product['features']))
                                        <h6 class="mt-4">Key Benefits &amp; Highlights</h6>
                                        <ul style="list-style-type: none; padding-left: 0;">
                                            @foreach($product['features'] as $feature)
                                                <li style="margin-bottom: 8px;">
                                                    <i class="fa fa-check text-success mr-2"></i> {{ $feature }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>How to Use &amp; Application Ritual</h6>
                                    <p>For maximum botanical bio-availability, integrate <strong>{{ $product['name'] }}</strong> into your daily self-care ritual following our dermatologist-developed 3-step application method:</p>
                                    
                                    <div class="row mt-4 mb-4">
                                        <div class="col-md-4 mb-3">
                                            <div class="p-3 h-100" style="background: #f7faf4; border-radius: 8px; border-left: 3px solid #7fad39;">
                                                <span class="badge badge-success mb-2" style="background-color: #7fad39; font-size: 11px;">STEP 01</span>
                                                <h6 style="font-size: 14px; font-weight: 700; margin-bottom: 6px;">Dispense &amp; Warm</h6>
                                                <p class="mb-0 text-muted" style="font-size: 13px;">Dispense an appropriate amount into the palm of clean hands. Gently warm between palms for 3 seconds to activate delicate botanical plant essences.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="p-3 h-100" style="background: #f7faf4; border-radius: 8px; border-left: 3px solid #7fad39;">
                                                <span class="badge badge-success mb-2" style="background-color: #7fad39; font-size: 11px;">STEP 02</span>
                                                <h6 style="font-size: 14px; font-weight: 700; margin-bottom: 6px;">Mindful Application</h6>
                                                <p class="mb-0 text-muted" style="font-size: 13px;">Gently massage onto damp skin or hair using smooth, upward circular motions. Breathe in the natural aromatherapeutic notes of bergamot, rosemary, and sage.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="p-3 h-100" style="background: #f7faf4; border-radius: 8px; border-left: 3px solid #7fad39;">
                                                <span class="badge badge-success mb-2" style="background-color: #7fad39; font-size: 11px;">STEP 03</span>
                                                <h6 style="font-size: 14px; font-weight: 700; margin-bottom: 6px;">Absorb &amp; Lock In</h6>
                                                <p class="mb-0 text-muted" style="font-size: 13px;">Allow active plant ceramides to absorb for 2–3 minutes before rinsing thoroughly with lukewarm water, or leave on as a silky botanical protective barrier.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-3" style="background: #fafafa; border-radius: 6px; font-size: 13px; color: #555;">
                                        <i class="fa fa-info-circle text-success mr-2"></i>
                                        <strong>Botanical Care Note:</strong> Safe for daily morning and evening use. Formulated for all skin and hair types including sensitive skin. Store in a cool, dry area away from direct sunlight.
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Verified Customer Experience</h6>
                                    <div class="media mb-4 p-3" style="background: #fafafa; border-radius: 8px;">
                                        <div class="media-body">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mt-0 mb-0">Sophia M. <span class="badge badge-success ml-2" style="font-size: 11px;">Verified Buyer</span></h6>
                                                <small class="text-muted">2 days ago</small>
                                            </div>
                                            <div class="mb-2">
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                            </div>
                                            <p class="mb-0">"The texture is heavenly and the natural aroma is so calming. My skin has never felt softer or more balanced. Truly an elevated botanical experience!"</p>
                                        </div>
                                    </div>
                                    <div class="media p-3" style="background: #fafafa; border-radius: 8px;">
                                        <div class="media-body">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mt-0 mb-0">David L. <span class="badge badge-success ml-2" style="font-size: 11px;">Verified Buyer</span></h6>
                                                <small class="text-muted">1 week ago</small>
                                            </div>
                                            <div class="mb-2">
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                            </div>
                                            <p class="mb-0">"Gentle on sensitive skin with zero irritation. Fast delivery and eco-friendly packaging. Highly recommend to anyone seeking pure skincare."</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    @if(!empty($relatedProducts) && count($relatedProducts) > 0)
        <section class="related-product pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title related__product__title">
                            <h2>Related Botanical Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($relatedProducts as $rel)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset($rel['image']) }}" style="position: relative; cursor: pointer;">
                                    <a href="{{ route('shop.show', $rel['id']) }}" class="position-absolute w-100 h-100" style="top: 0; left: 0; z-index: 1;" title="{{ $rel['name'] }}"></a>
                                    <ul class="product__item__pic__hover" style="z-index: 3;">
                                        <li><a href="{{ route('shop.show', $rel['id']) }}" title="View details"><i class="fa fa-eye"></i></a></li>
                                        <li>
                                            <form action="{{ route('cart.add') }}" method="POST" class="js-cart-form" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $rel['id'] }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" title="Add to bag">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <span style="font-size: 12px; color: #888;">{{ $rel['category_name'] }}</span>
                                    <h6><a href="{{ route('shop.show', $rel['id']) }}">{{ $rel['name'] }}</a></h6>
                                    <h5>${{ number_format($rel['price'], 2) }}</h5>
                                    <div class="d-block d-md-none mt-2">
                                        <form action="{{ route('cart.add') }}" method="POST" class="js-cart-form m-0">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $rel['id'] }}">
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
            </div>
        </section>
    @endif
    <!-- Related Product Section End -->
@endsection
