@extends('layouts.master')
@section('title', 'LIVA | The Botanical Ritual: Why Scalp Health Comes First')

@section('hero')
    @include('partials.hero', ['isHome' => false])
@endsection

@section('content')
    <!-- Blog Details Hero Begin -->
    <section class="blog-details-hero set-bg" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2>The Botanical Ritual: Why Scalp Health Comes First</h2>
                        <ul>
                            <li>By Dr. Elena Vance</li>
                            <li>March 18, 2026</li>
                            <li>8 Botanical Comments</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
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
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <img src="{{ asset('img/campaign/everyday-poster.webp') }}" alt="" style="border-radius: 8px;">
                        <p>Healthy, vibrant hair does not begin at the ends—it starts beneath the surface. The scalp is a living ecosystem of skin cells, sebaceous glands, and a delicate microbiome that thrives only when properly balanced and shielded from harsh chemical detergents.</p>
                        <h3>The Living Ecosystem: Why Traditional Sulfates Deplete Your Roots</h3>
                        <p>When conventional shampoos strip away the protective lipid mantel with harsh foaming agents, the sebaceous glands overcompensate by pumping out excessive sebum. This vicious cycle results in roots that become greasy within hours while hair strands remain parched and brittle.</p>
                        <p>LIVA botanical formulas solve this fundamental imbalance by utilizing cold-pressed plant surfactants derived from sustainable coconut and chamomile. They dislodge impurities without disrupting the pH equilibrium, creating the ideal biological environment for strong, resilient hair growth.</p>
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="{{ asset('img/result-1.webp') }}" alt="" style="border-radius: 50%;">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>Dr. Elena Vance</h6>
                                        <span>Botanical Dermatologist</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Categories:</span> Botanical Care, Scalp Rituals</li>
                                        <li><span>Tags:</span> Clean Beauty, Organic, Scalp Care</li>
                                    </ul>
                                    <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
    <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>Articles You May Like</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
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
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('img/campaign/hair-pair.webp') }}" alt="" style="border-radius: 8px;">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> Mar 14, 2026</li>
                                <li><i class="fa fa-comment-o"></i> 12</li>
                            </ul>
                            <h5><a href="{{ route('blog.details') }}">Plant Squalane vs Argan: Choosing What Fits Your Skin</a></h5>
                            <p>An in-depth look into lipid structures and how olive squalane provides instant cellular barrier reinforcement.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
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
                            <p>Understanding photo-oxidation and how sustainable amber containers shield delicate plant terpenes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related Blog Section End -->
@endsection
