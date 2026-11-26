<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ route('home') }}" class="d-flex align-items-center" style="text-decoration: none;">
                            <img src="{{ asset('img/liva-logo.webp') }}" alt="LIVA Botanical Skincare" style="max-height: 52px; width: auto; object-fit: contain;">
                        </a>
                    </div>
                    <ul>
                        <li>Battambang</li>
                        <li>Phone: +65 11.188.888</li>
                        <li>Email: wintech@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6 data-i18n="useful_links">Useful Links</h6>
                    <ul>
                        <li><a href="{{ route('contact.index') }}" data-i18n="about_us">About Us</a></li>
                        <li><a href="{{ route('shop.index') }}" data-i18n="about_shop">About Our Shop</a></li>
                        <li><a href="#" data-i18n="secure_shopping">Secure Shopping</a></li>
                        <li><a href="#" data-i18n="delivery_info">Delivery infomation</a></li>
                        <li><a href="#" data-i18n="privacy_policy">Privacy Policy</a></li>
                        <li><a href="#" data-i18n="our_sitemap">Our Sitemap</a></li>
                    </ul>
                    <ul>
                        <li><a href="#" data-i18n="who_we_are">Who We Are</a></li>
                        <li><a href="#" data-i18n="our_services">Our Services</a></li>
                        <li><a href="{{ route('contact.index') }}" data-i18n="contact">Contact</a></li>
                        <li><a href="#" data-i18n="testimonials">Testimonials</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6 data-i18n="newsletter_title">Join Our Newsletter Now</h6>
                    <p data-i18n="newsletter_desc">Get E-mail updates about our latest shop and special offers.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your mail" data-i18n-placeholder="enter_email">
                        <button type="submit" class="site-btn" data-i18n="subscribe">Subscribe</button>
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
