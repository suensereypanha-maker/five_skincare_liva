<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ route('home') }}" class="d-flex align-items-center" style="gap: 10px; text-decoration: none;">
                            <img src="{{ asset('img/favicon.svg') }}" alt="LIVA" style="max-height: 44px; width: 44px; border-radius: 8px;">
                            <span style="font-size: 26px; font-weight: 700; letter-spacing: 0.12em; color: #1F2421; font-family: 'Cormorant Garamond', Georgia, serif;">LIVA</span>
                        </a>
                    </div>
                    <ul>
                        <li>Battambang</li>
                        <li>Phone: +65 11.188.888</li>
                        <li>Email: hello@colorlib.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Useful Links</h6>
                    <ul>
                        <li><a href="{{ route('contact.index') }}">About Us</a></li>
                        <li><a href="{{ route('shop.index') }}">About Our Shop</a></li>
                        <li><a href="#">Secure Shopping</a></li>
                        <li><a href="#">Delivery infomation</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Our Sitemap</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Who We Are</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Projects</a></li>
                        <li><a href="{{ route('contact.index') }}">Contact</a></li>
                        <li><a href="#">Innovation</a></li>
                        <li><a href="#">Testimonials</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Join Our Newsletter Now</h6>
                    <p>Get E-mail updates about our latest shop and special offers.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your mail">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form>
                    <div class="footer__widget__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>
                            Copyright &copy; {{ date('Y') }} All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </p>
                    </div>
                    <div class="footer__copyright__payment d-flex align-items-center justify-content-end" style="gap: 8px;">
                        <img src="{{ asset('img/payments/aba.png') }}" alt="ABA" style="height: 22px;">
                        <img src="{{ asset('img/payments/acleda.png') }}" alt="ACLEDA" style="height: 22px;">
                        <img src="{{ asset('img/payments/wing.jpg') }}" alt="Wing" style="height: 22px; border-radius: 3px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
