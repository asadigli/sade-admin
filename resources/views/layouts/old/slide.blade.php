<div class="main-slider">
  <div class="slider">
    <div id="mainSlider" class="nivoSlider slider-image"> <img src="images/slider/slider-img1.jpg" alt="main slider" title="#htmlcaption1"/> <img src="images/slider/slider-img2.jpg" alt="main slider" title="#htmlcaption2"/> </div>
    <!-- Slider Caption One -->
    <div id="htmlcaption1" class="nivo-html-caption slider-caption-1">
      <div class="slider-progress"></div>
      <div class="slide-text">
        <div class="middle-text">
          <div class="cap-dec">
            <h1 class="cap-dec wow rubberBand" data-wow-duration="1.1s" data-wow-delay="0s">{{ trans('app.latest')}}</h1>
            <h2 class="cap-dec wow rubberBand" data-wow-duration="1.3s" data-wow-delay="0s">{{ date('Y')}} {{ trans('app.products')}}</h2>
            <p class="cap-dec wow rubberBand" data-wow-duration="1.5s" data-wow-delay="0s"> {{ trans('app.latest_products_for_special_buyers')}}</p>
          </div>
          <div class="cap-readmore wow rubberBand" data-wow-duration=".9s" data-wow-delay=".5s">
            <!-- <a href="#">Shop Now</a>  -->
          </div>
        </div>
      </div>
    </div>
    <!-- Slider Caption Two -->
    <div id="htmlcaption2" class="nivo-html-caption slider-caption-2">
      <div class="slider-progress"></div>
      <div class="slide-text slide-text-2">
        <div class="middle-text">
          <div class="cap-dec">
            <h1 class="wow swing" data-wow-duration="1.1s" data-wow-delay="0s">Sade Store  </h1>
            <h2 class="wow swing" data-wow-duration="1.1s" data-wow-delay="0s">{{ trans('app.discounts')}}</h2>
            <p class="wow swing" data-wow-duration="1.3s" data-wow-delay="0s"> {{ trans('app.buy_more_earn_more')}}</p>
          </div>
          <div class="cap-readmore wow swing" data-wow-duration="1.3s" data-wow-delay=".3s">
            @if (Route::has('login'))
            @if (Auth::check())
            <!-- <a href="/profile/{{Auth::user()->id}}">{{ trans('app.mybonuses')}}</a> -->
            @else
            <!-- <a href="/">{{ trans('app.create_account')}}</a> -->

            @endif
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
