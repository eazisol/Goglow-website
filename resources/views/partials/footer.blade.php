<footer class="main-footer bg-section dark-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-footer">
                        <div class="footer-logo">
                            {{-- <img src="images/footer-logo.svg" alt=""> --}}
                            <h1 class="text-anime-style-2" data-cursor="-opaque" style="color: white;">Go<span>Glow</span></h1>
                        </div>
                        <div class="about-footer-content">
                            <p>Discover and book trusted salon services with ease. From hair to skin, we connect you with professionals who help you look and feel your best.</p>
                        </div>
   
                        <div class="footer-contact-details">
                            <div class="footer-contact-item">
                                <div class="icon-box">
                                    <img src="images/icon-phone.svg" alt="">
                                </div>
                                <div class="footer-contact-item-content">
                                    <h3>Urgent Support?</h3>
                                    <p><a href="tel:+246333085">+1 (246) 333-085</a></p>
                                </div>
                            </div>
                            <div class="footer-contact-item">
                                <div class="icon-box">
                                    <img src="images/icon-mail.svg" alt="">
                                </div>
                                <div class="footer-contact-item-content">
                                    <h3>E-mail Us</h3>
                                    <p><a href="mailto:info@domain.com">info@domain.com</a></p>
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
                                    <input type="email" name="mail" class="form-control"  id="mail" placeholder="Enter your email" required>
                                    <button type="submit" class="btn-default btn-highlighted">subscribe</button>
                                </div>
                            </form>
                        </div>
                        <div class="footer-social-links">
                            <h3>Connect with Us Online</h3>
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
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('/about') }}">About us</a></li>
                                <li><a href="{{ url('/services') }}">services</a></li>
                                {{-- <li><a href="{{ url('/blogs') }}">blogs</a></li> --}}
                                <li><a href="{{ url('/contact-us') }}">contact us</a></li>
                                <li><a href="{{ url('/terms-conditions') }}">Terms & Conditions</a></li>
                                <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <div class="footer-copyright-text">
                            <p>Copyright © 2025 All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>