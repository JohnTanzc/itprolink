    <!-- ================ start footer Area ================= -->
    <section class="footer-area pt-100px bg-gray">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 responsive-column-half">
              <div class="footer-item">
                <a href="index.html">
                  <img src="{{ asset('template/images/logo.png') }}" alt="footer logo" class="footer__logo">
                </a>
                <ul class="generic-list-item py-4">
                  <li><a href="tel:+1631237884">(+63) 9690940143</a></li>
                  <li>
                    <a href="{{route('contacts')}}">Message Us</a>
                  </li>
                  <li><a href="https://mail.google.com/mail/u/5/#inbox" target="_blank">itprolinked@gmail.com</a></li>
                  <li>Philippines</li>
                </ul>
              </div>
              <!-- end footer-item -->
            </div>
            <!-- end col-lg-3 -->
            <div class="col-lg-4 responsive-column-half">
              <div class="footer-item">
                <h3 class="fs-20 font-weight-semi-bold">Quick Links</h3>
                <ul class="generic-list-item pt-4">
                  <li><a href="{{route('about')}}">About us</a></li>
                  <li><a href="{{route('contacts')}}">Contact us</a></li>
                  <li><a href="{{route('user.register')}}">Become a Teacher</a></li>
                  <li><a href="{{route('course')}}">Courses</a></li>
                </ul>
              </div>
              <!-- end footer-item -->
            </div>
            <!-- end col-lg-3 -->
            {{-- <div class="col-lg-3 responsive-column-half">
              <div class="footer-item">
                <h3 class="fs-20 font-weight-semi-bold">Links</h3>
                <ul class="generic-list-item pt-4">
                  <li><a href="#">News &amp; Blog</a></li>
                  <li><a href="#">Library</a></li>
                  <li><a href="#">Gallery</a></li>
                  <li><a href="#">Partners</a></li>
                  <li><a href="#">Affiliate</a></li>
                </ul>
              </div>
              <!-- end footer-item -->
            </div> --}}
            <!-- end col-lg-3 -->
            <div class="col-lg-4 responsive-column-half">
              <div class="footer-item">
                <h3 class="fs-20 font-weight-semi-bold">Support</h3>
                <ul class="generic-list-item pt-4">
                  <li><a href="{{route('terms')}}">Terms &amp; Conditions</a></li>
                  <li><a href="{{route('privacy')}}">Privacy policy</a></li>
                  <li><a href="{{route('faqs')}}">FAQs</a></li>
                </ul>
              </div>
              <!-- end footer-item -->
            </div>
            <!-- end col-lg-3 -->
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
        <div class="section-block"></div>
        <div class="copyright-content py-4">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-6">
                <p class="copy-desc">
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | Explore with us! <i class="la la-heart-o"
                        aria-hidden="true"></i> <a href="http://127.0.0.1:8000" target="_blank">ITProLink</a>
                </p>
              </div>
              <!-- end col-lg-6 -->
              <div class="col-lg-6">
                <ul class="social-icons social-icons-styled social--icons-styled text-end">
                  <li class="me-1">
                    <a href="#"><i class="la la-facebook"></i></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><i class="la la-twitter"></i></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><i class="la la-instagram"></i></a>
                  </li>
                  <li class="me-1">
                    <a href="#"><i class="la la-linkedin"></i></a>
                  </li>
                </ul>
              </div>
              <!-- end col-lg-6 -->
            </div>
            <!-- end row -->
          </div>
          <!-- end container -->
        </div>
        <!-- end copyright-content -->
      </section>
    <!-- ================ End footer Area ================= -->

