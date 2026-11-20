@extends('layouts.master')
@section('title', 'LIVA | Botanical Journal & Skincare Insights')

@section('hero')
    @include('partials.hero', ['isHome' => false])
@endsection

@section('breadcrumb')
    @include('partials.breadcrumb', ['title' => 'Botanical Journal', 'subtitle' => 'Skincare Journal'])
@endsection

@section('content')
    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search journal...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Journal Topics</h4>
                            <ul>
                                <li><a href="#">All Articles (18)</a></li>
                                <li><a href="#">Botanical Care (8)</a></li>
                                <li><a href="#">Skin Longevity (4)</a></li>
                                <li><a href="#">Scalp Rituals (3)</a></li>
                                <li><a href="#">Clean Formulations (3)</a></li>
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Recent Articles</h4>
                            <div class="blog__sidebar__recent">
                                <a href="{{ route('blog.details') }}" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="{{ asset('img/daily-edit.webp') }}" alt="" style="width: 70px; height: 70px; object-fit: cover; border-radius: 4px;">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>Why Balancing Scalp Health<br /> Transforms Hair Shine</h6>
                                        <span>MAR 15, 2026</span>
                                    </div>
                                </a>
                                <a href="{{ route('blog.details') }}" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="{{ asset('img/ritual-duo.webp') }}" alt="" style="width: 70px; height: 70px; object-fit: cover; border-radius: 4px;">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>Plant Ceramides vs Lipids:<br /> Barrier Restoration Guide</h6>
                                        <span>MAR 12, 2026</span>
                                    </div>
                                </a>
                                <a href="{{ route('blog.details') }}" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="{{ asset('img/travel-set.webp') }}" alt="" style="width: 70px; height: 70px; object-fit: cover; border-radius: 4px;">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>Travel-Proof Skincare:<br /> Combating Cabin Dryness</h6>
                                        <span>MAR 08, 2026</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Search By Tag</h4>
                            <div class="blog__sidebar__item__tags">
                                <a href="#">Botanical</a>
                                <a href="#">Clean Beauty</a>
                                <a href="#">Scalp Health</a>
                                <a href="#">Hydration</a>
                                <a href="#">Vegan Formula</a>
                                <a href="#">Minimal Routine</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="{{ asset('img/campaign/hair-pair.webp') }}" alt="" style="border-radius: 8px;">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Mar 18, 2026</li>
                                        <li><i class="fa fa-comment-o"></i> 7</li>
                                    </ul>
                                    <h5><a href="{{ route('blog.details') }}">The Botanical Ritual: Why Scalp Health Comes First</a></h5>
                                    <p>Discover how balancing scalp microbiome with cold-pressed rosemary promotes hair longevity and natural shine.</p>
                                    <a href="{{ route('blog.details') }}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="{{ asset('img/result-1.webp') }}" alt="" style="border-radius: 8px;">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Mar 14, 2026</li>
                                        <li><i class="fa fa-comment-o"></i> 12</li>
                                    </ul>
                                    <h5><a href="{{ route('blog.details') }}">Plant Squalane vs Argan: Choosing What Fits Your Skin</a></h5>
                                    <p>An in-depth look into lipid structures and how olive squalane provides instant cellular barrier reinforcement.</p>
                                    <a href="{{ route('blog.details') }}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="{{ asset('img/campaign/your-moment.webp') }}" alt="" style="border-radius: 8px;">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Mar 10, 2026</li>
                                        <li><i class="fa fa-comment-o"></i> 4</li>
                                    </ul>
                                    <h5><a href="{{ route('blog.details') }}">Morning to Evening: Building a Minimalist Routine</a></h5>
                                    <p>Less is more when using concentrated botanicals. Learn our simple three-step ritual for round-the-clock radiance.</p>
                                    <a href="{{ route('blog.details') }}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="{{ asset('img/result-2.jpg') }}" alt="" style="border-radius: 8px;">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Mar 06, 2026</li>
                                        <li><i class="fa fa-comment-o"></i> 9</li>
                                    </ul>
                                    <h5><a href="{{ route('blog.details') }}">Why Amber Glass Bottles Preserve Botanical Actives</a></h5>
                                    <p>Understanding photo-oxidation and how sustainable amber containers shield delicate plant terpenes from degradation.</p>
                                    <a href="{{ route('blog.details') }}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="{{ asset('img/result-3.jpg') }}" alt="" style="border-radius: 8px;">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Feb 28, 2026</li>
                                        <li><i class="fa fa-comment-o"></i> 8</li>
                                    </ul>
                                    <h5><a href="{{ route('blog.details') }}">Holistic Skin Barrier: Repairing Dehydrated Redness</a></h5>
                                    <p>How fermented botanical teas and cold-pressed botanical essences soothe hypersensitive, compromised barriers.</p>
                                    <a href="{{ route('blog.details') }}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="{{ asset('img/campaign/everyday-poster.webp') }}" alt="" style="border-radius: 8px;">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> Feb 22, 2026</li>
                                        <li><i class="fa fa-comment-o"></i> 15</li>
                                    </ul>
                                    <h5><a href="{{ route('blog.details') }}">The Power of Fermented Botanicals in Daily Care</a></h5>
                                    <p>Micro-sized bio-actives created through natural plant fermentation deliver faster, deeper absorption without irritation.</p>
                                    <a href="{{ route('blog.details') }}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                <a href="#" class="active">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
