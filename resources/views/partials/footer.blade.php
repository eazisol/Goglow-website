<footer class="main-footer bg-section dark-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-footer">
                        {{-- <div class="footer-logo">
                            <img src="images/goglowlogo.png" alt="Logo" style="width: 60px;">
                            <h1 class="text-anime-style-2" data-cursor="-opaque" style="color: white;">Go<span>Glow</span></h1>
                        </div> --}}
                        <div class="about-footer-content">
                            <p>{{ __('app.footer.about_description') }}</p>
                        </div>
   
                        <div class="footer-contact-details">
                            <div class="footer-contact-item">
                                <div class="icon-box">
                                    <img src="images/icon-phone.svg" alt="">
                                </div>
                                <div class="footer-contact-item-content">
                                    <h3>{{ __('app.footer.urgent_support') }}</h3>
                                    <p><a href="tel:+33607426151">+33 (607) 426-151</a></p>
                                </div>
                            </div>
                            <div class="footer-contact-item">
                                <div class="icon-box">
                                    <img src="images/icon-mail.svg" alt="">
                                </div>
                                <div class="footer-contact-item-content">
                                    <h3>{{ __('app.footer.email_us') }}</h3>
                                    <p><a href="mailto:info@goglow.fr">info@goglow.fr</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-newsletter-box">
                        {{-- <h3>Subscribe Our Newsletter</h3>
                        <p>Stay updated with the latest wellness tips, spa offers, and exclusive deals by subscribing to our relaxing monthly newsletter today.</p> --}}
                        <div class="footer-newsletter-form">
                            <form id="newslettersForm" action="#" method="POST">
                                <div class="form-group">
                                    <input type="email" name="mail" class="form-control"  id="mail" placeholder="{{ __('app.footer.enter_email') }}" required>
                                    <button type="submit" class="btn-default btn-highlighted">{{ __('app.footer.subscribe') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="footer-social-links">
                            <h3>{{ __('app.footer.connect_with_us') }}</h3>
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        
                    </div>                        
                </div>
                <div class="col-lg-12">
                    <div class="footer-copyright">
                        <div class="footer-links">
                            <ul>
                                <li><a href="{{ url('/') }}">{{ __('app.footer.home') }}</a></li>
                                <li><a href="{{ url('/about') }}">{{ __('app.footer.about_us') }}</a></li>
                                <li><a href="{{ url('/services') }}">{{ __('app.footer.services') }}</a></li>
                                {{-- <li><a href="{{ url('/blogs') }}">blogs</a></li> --}}
                                <li><a href="{{ url('/contact-us') }}">{{ __('app.footer.contact_us') }}</a></li>
                                <li><a href="{{ url('/terms_condition') }}">{{ __('app.footer.terms_conditions') }}</a></li>
                                <li><a href="{{ url('/privacy_policy') }}">{{ __('app.footer.privacy_policy') }}</a></li>
                            </ul>
                        </div>
                        <div class="footer-copyright-text">
                            <p>{{ __('app.footer.copyright') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>