    <!-- Footer -->
    <footer class="footer">
      <div style="background: linear-gradient(rgba(255, 244, 248, 0.5), rgba(255, 244, 248, 0.5)), url('{{ asset('images/images/img_0e336be1b021b9ad01fcd3c5382a05e7_1.png') }}'); background-size: cover; background-position: center; position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1;"></div>
      
      <div class="footer-bg-text">Glaura App</div>
      
      <div class="container" style="position: relative; z-index: 2;">
        <div class="footer-content">
          <div class="footer-brand">
            <img src="{{ asset('images/images/LOGO-glaura-horizontal-couleur.png') }}" alt="GoGlow Logo" class="footer-logo">
            <p class="footer-description">
              {{ __('app.footer.footer_description') }}
            </p>
          </div>

          <div class="footer-links">
            <div class="footer-section">
              <h3>{{ __('app.footer.menus') }}</h3>
              <ul>
                {{-- <li><a href="#">{{ __('app.footer.how_it_works') }}</a></li>
                <li><a href="#">{{ __('app.footer.help_support') }}</a></li>
                <li><a href="{{ url('/contact-us') }}">{{ __('app.footer.contact') }}</a></li> --}}
                <li><a href="{{ url('/privacy_policy') }}">{{ __('app.footer.privacy_policy') }}</a></li>
                <li><a href="{{ url('/terms_condition') }}">{{ __('app.footer.terms_conditions') }}</a></li>
              </ul>
            </div>

            <div class="footer-section">
              <h3>{{ __('app.footer.follow_us') }}</h3>
              <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">instagram</a></li>
                {{-- <li><a href="#">twitter</a></li>
                <li><a href="#">linkedIn</a></li> --}}
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="footer-copyright">
        <p class="copyright-text">
          {{ __('app.footer.copyright') }} <span class="copyright-go"></span><span class="copyright-glow">glaura</span><span class="copyright-com">.ai</span>
        </p>
      </div>
    </footer>