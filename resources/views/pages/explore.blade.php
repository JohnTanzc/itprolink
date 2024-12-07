<section class="cat-area pt-80px pb-80px bg-radial-gradient-gray">
    <div class="container">
      <div class="cta-content-wrap text-center">
        <div class="section-heading">
          <h2 class="section__title fs-45 lh-55 theme-font-2 pb-4">
            Make the most of your online <br>
            learning experience
          </h2>
          <p class="section__desc">
            Our Online Learning Resource Center has tips, tricks and inspiring
            stories <br>
            to help you learn while staying home.
          </p>
        </div>
        <!-- end section-heading -->
        <div class="cat-btn-box mt-28px">
            @if (!auth()->check())  <!-- Check if the user is not logged in -->
                <a href="{{ route('course') }}" class="btn theme-btn">Enroll Now <i class="la la-arrow-right icon ms-1"></i></a>
            @endif
        </div>
        <!-- end cat-btn-box -->
      </div>
      <!-- end cta-content-wrap -->
    </div>
    <!-- end container -->
  </section>
