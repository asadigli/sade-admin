
  <footer>
    <div class="footer-newsletter footer_delete_for_app">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-3">
            <div class="footer-logo"><a href="/"><img src="{{ asset('images/logo.png')}}" alt="fotter logo"></a>
              <p>SadeStore-dan al məmnun qal</p>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <!-- <h3 class="">Sign up for newsletter</h3> -->
            <!-- <span>Get the latest deals and special offers</span></div> -->
          <div class="col-md-5 col-sm-6">
            <!-- <form id="newsletter-validate-detail" method="post" action="#">
              <div class="newsletter-inner">
                <input class="newsletter-email" name='Email' placeholder='Enter Your Email'/>
                <button class="button subscribe" type="submit" title="Subscribe">Subscribe</button>
              </div>

            </form> -->
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-3 col-xs-12 col-lg-3 collapsed-block">
          <div class="footer-links">
            <h3 class="links-title">{{ trans('app.information')}}<a class="expander visible-xs" href="#TabBlock-1">+</a></h3>
            <div class="tabBlock" id="TabBlock-1">
              <ul class="list-links list-unstyled">
                <li><a href="/about" style="text-transform:capitalize;">{{ trans('app.aboutus')}}</a></li>
                <li><a href="/discounts" style="text-transform:capitalize;">{{ trans('app.discounts')}}</a></li>
                <!-- <li><a href="#">{{ trans('app.buyingterm')}}</a></li> -->
                <li><a href="/contact" style="text-transform:capitalize;">{{ trans('app.contact')}}</a></li>
                <!-- <li><a href="#">{{ trans('app.information')}}</a></li> -->
                <!-- <li><a href="#">{{ trans('app.information')}}</a></li> -->
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-xs-12 col-lg-3 collapsed-block">
          <div class="footer-links">
            <h3 class="links-title">{{ trans('app.insider')}}<a class="expander visible-xs" href="#TabBlock-3">+</a></h3>
            <div class="tabBlock" id="TabBlock-3">
              <ul class="list-links list-unstyled">
                <li> <a href="/allnews" style="text-transform:capitalize;">{{ trans('app.news')}}</a> </li>
                <!-- <li> <a href="#">{{ trans('app.campaign')}}</a> </li> -->
                <li> <a href="/termsofdelivary" style="text-transform:capitalize;">{{ trans('app.policyofdelivery')}}</a> </li>
                <li> <a href="/faq" style="text-transform:capitalize;">{{ trans('app.fags')}}</a> </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-2 col-xs-12 col-lg-3 collapsed-block">
          <div class="footer-links">
            <!-- <h3 class="links-title">Service<a class="expander visible-xs" href="#TabBlock-4">+</a></h3>
            <div class="tabBlock" id="TabBlock-4">
              <ul class="list-links list-unstyled">
                @if (Route::has('login'))
                @if (Auth::check())
                <li> <a href="/userprofile/{{Auth::user()->id}}" style="text-transform:capitalize;">Account</a> </li>
                <li> <a href="/wishlist" style="text-transform:capitalize;">Wishlist</a> </li>

                @else
                <li><a href="/login" style="text-transform:capitalize;">{{ trans('app.login')}}</a> </li>
                <li><a href="/register" style="text-transform:capitalize;">{{ trans('app.register')}}</a> </li>
                @endif
                @endif
              </ul>
            </div> -->
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-xs-12 col-lg-3">
          <h3 class="links-title">{{ trans('app.contact_us')}}</h3>
          <div class="footer-content">
            <!-- <div class="email">
              <p> <i class="fa fa-envelope"></i> contact@sade.store</p>
            </div> -->
            <div class="phone">
              <p> <i class="fa fa-envelope-o" style="margin-left:10px;"></i> &nbsp;  &nbsp; &nbsp; contact@sade.store</p>
            </div>
            <div class="phone">
              <p> <i class="fa fa-phone"></i> (+994) 70 818 66 01</p>
            </div>
            <!-- <div class="address"> <i class="fa fa-map-marker"></i>
              <p> My Company, 12/34 - West 21st Street, New York, USA</p>
            </div> -->
          </div>
          <div class="social">
            <ul class="inline-mode">
              <li class="social-network fb"><a title="{{ trans('app.connect_us_on_facebook')}}" target="_blank" href="https://www.facebook.com/emallazerbaijan"><i class="fa fa-facebook"></i></a></li>
              <!-- <li class="social-network googleplus"><a title="Connect us on Google+" target="_blank" href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li> -->
              <!-- <li class="social-network tw"><a title="Connect us on Twitter" target="_blank" href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li> -->
              <!-- <li class="social-network linkedin"><a title="Connect us on Linkedin" target="_blank" href="https://www.pinterest.com/"><i class="fa fa-linkedin"></i></a></li> -->
              <!-- <li class="social-network rss"><a title="Connect us on Instagram" target="_blank" href="https://instagram.com/e_mall_"><i class="fa fa-rss"></i></a></li> -->
              <li class="social-network instagram"><a title="{{ trans('app.connect_us_on_instagram')}}" target="_blank" href="https://instagram.com/e_mall_"><i class="fa fa-instagram"></i></a></li>
            </ul>

          </div>
        </div>
      </div>
    </div>
    <div class="footer-coppyright">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-xs-12 coppyright">   {{date('Y')}} © <a href="/"> SadeStore </a> </div>
          <!--<div class="col-sm-6 col-xs-12">-->
          <!--  <div class="payment">-->
          <!--    <ul>-->
          <!--      <li><a href="#"><img title="Visa" alt="Visa" src="images/visa.png"></a></li>-->
          <!--      <li><a href="#"><img title="Paypal" alt="Paypal" src="images/paypal.png"></a></li>-->
          <!--      <li><a href="#"><img title="Discover" alt="Discover" src="images/discover.png"></a></li>-->
          <!--      <li><a href="#"><img title="Master Card" alt="Master Card" src="images/master-card.png"></a></li>-->
          <!--    </ul>-->
          <!--  </div>-->
          <!--</div>  -->
        </div>
      </div>
    </div>
  </footer>
