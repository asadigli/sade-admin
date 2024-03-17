<style media="screen">

@media only screen and (max-width: 320px) {
  .respp{
    display: none;
  }

}
@media only screen and (min-width: 321px) and (max-width: 600px) {
  .respp{
    display: none;
  }
}
@media only screen and (min-width: 601px) and (max-width: 767px) {
  .respp{
    display: none;
  }
}
@media only screen and (min-width: 768px) and (max-width: 899px) {
  .respp_for_mobile{
    display: none;
  }
}
@media only screen and (min-width: 900px) and (max-width: 1200px) {
  .respp_for_mobile{
    display: none;
  }
}
@media only screen and (min-width: 1201px){
  .respp_for_mobile{
    display: none;
  }

}
</style>
<header>
  <div class="header-container">
    <div class="header-top">
      <div class="container">
        <div class="respp row">
          <div class="col-md-6 col-sm-5 col-xs-6">
            <!-- Default Welcome Message -->
            <span class="phone hidden-xs hidden-sm"><i class="fa fa-phone fa-lg"></i> +(994)70 818 66 01</span>
            <div class="welcome-msg hidden-xs">{{ trans('app.welcome_to_sadestore')}}! </div>
            <div class="language-currency-wrapper">
              <div class="inner-cl">
                <!-- <div class="block block-language form-language"> -->
                  <!-- <div class="lg-cur"> <span> <img src="images/flag-default.jpg" alt="French"> <span class="lg-fr">French</span> <i class="fa fa-angle-down"></i> </span> </div> -->
                  <!-- <ul> -->
                    <!-- <li> <a class="selected" href="#"> <img src="images/flag-english.jpg" alt="flag"> <span>Azerbaycan dili</span> </a> </li> -->
                    <!-- <li> <a href="#"> <img src="images/flag-default.jpg" alt="flag"> <span>French</span> </a> </li> -->
                    <!-- <li> <a href="#"> <img src="images/flag-german.jpg" alt="flag"> <span>German</span> </a> </li> -->
                    <!-- <li> <a href="#"> <img src="images/flag-brazil.jpg" alt="flag"> <span>Brazil</span> </a> </li> -->
                    <!-- <li> <a href="#"> <img src="images/flag-chile.jpg" alt="flag"> <span>Chile</span> </a> </li> -->
                    <!-- <li> <a href="#"> <img src="images/flag-spain.jpg" alt="flag"> <span>Spain</span> </a> </li> -->
                  <!-- </ul> -->
                <!-- </div> -->
                <!-- <div class="block block-currency"> -->
                  <!-- <div class="item-cur"> <span>USD </span> <i class="fa fa-angle-down"></i></div> -->
                  <!-- <ul> -->
                    <!-- <li> <a href="#"><span class="cur_icon">€</span> EUR</a> </li> -->
                    <!-- <li> <a href="#"><span class="cur_icon">¥</span> JPY</a> </li> -->
                    <!-- <li> <a class="selected" href="#"><span class="cur_icon">#1784</span> AZN</a> </li> -->
                  <!-- </ul> -->
                <!-- </div> -->
              </div>
            </div>
          </div>

          <!-- top links -->
          <div class="headerlinkmenu col-lg-6 col-md-6 col-sm-7 col-xs-6 text-right">
            <div class="links">
              <div class="jtv-user-info">
                <div class="dropdown">
                  <!-- <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span style="text-transform:capitalize;">
                  {{ trans('app.my_account')}} </span> <i class="fa fa-angle-down"></i></a> -->
                  <ul class="dropdown-menu" role="menu">
                    <!-- <li><a href="wishlist.html">Wishlist</a></li>
                    <li><a href="checkout.html">Checkout</a></li>
                    <li class="divider"></li>
                    <li><a href="account_page.html">Log In</a></li>
                    <li><a href="account_page.html">Sign Up</a></li> -->
                    @if (Route::has('login'))
                    @if (Auth::check())
                    @if(((Auth::user()->role_id)==2) | ((Auth::user()->role_id)==4) | ((Auth::user()->role_id)==3))
                    <li><a href="/adm"><i class="fa fa-user" ></i> Admin Panel</a></li>
                    @endif
                            @if(((Auth::user()->role_id)==2) | ((Auth::user()->role_id)==4) | ((Auth::user()->role_id)==3))
                              <li><a href="/adm"><i class="fa fa-columns" ></i> {{ trans('app.adminpanel') }}</a></li>
                            @endif
                            <li><a href="/profilesettings"><i class="fa fa-cogs" ></i>
                               {{ trans('app.accountsettings') }}</a></li>
                            <li><a href="/wishlist">
                              <i class="fa fa-shopping-cart" ></i> {{ trans('app.wishlist') }}
                            @php
                              $wishlist = App\Wishlist::where('user_id',[Auth::user()->id])->get()
                            @endphp
                            @if(!count($wishlist)==0)
                                <span class="badge badge-warning pull-right" style="background-color:red;">
                                    {{count($wishlist)}}
                                </span>
                            @endif
                                </a>
                              </li>
                        @if(((Auth::user()->role_id)==2) | ((Auth::user()->role_id)==4) | ((Auth::user()->role_id)==3))
                        <li><a href="/adm/sellproduct"><i class="fa fa-shopping-cart" ></i> {{ trans('app.sellproduct') }}</a></li>
                        @endif
                        <li><a href="/helpdesk"><i class="fa fa-h-square" ></i> {{ trans('app.helpdesk') }}</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" ></i> {{ trans('app.logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                        </form>
                      </li>
                      @else

    												<!-- <li><a href="/login" style="text-transform:capitalize;">{{ trans('app.login') }}</a></li>
    												<li class="divider"></li>
    												<li><a  href="/register" style="text-transform:capitalize;">{{ trans('app.register') }}</a></li> -->

                      @endif
                      @endif
                  </ul>
                </div>
              </div>
              <!-- <div class="services hidden-xs"><a title="servicesg" href="#">Services</a></div> -->
              <!-- <div class="myaccount hidden-xs"><a title="My Account" href="#">My Support</a></div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-3 col-xs-12">
          <!-- Header Logo -->
          <div class="logo logo_delete_for_app"><a title="e-commerce" href="/home"><img alt="e-commerce" src="{{ asset('images/logo.png')}}"></a> </div>
          <!-- End Header Logo -->
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-6">
          <!-- Search -->

          <div class="top-search">
            <div id="search">
              <!-- <form class="navbar-search pull-left input-append" >
  							<button class="btn" type="submit">
  									<i class="icon-search" style="height:90%;"></i>
  							</button>
						  </form> -->
              <form action="/searchedproducts/{request}" method="get" class="search_delete_for_app">
                {{csrf_field()}}
                <div class="input-group">
                  <select class="cate-dropdown hidden-xs hidden-sm" name="cate_id">
                    <option name="cate_id" value="0">{{ trans('app.all') }}</option>
    									@php
    									$category = App\Category::all()
    									@endphp
    									@foreach($category as $cat)
    									<option value="{{$cat->id}}" name="cate_id">{{$cat->name}}</option>
    									@endforeach
                  </select>
                  <input type="text" oninvalid="this.setCustomValidity('Məlumat daxil edin')" oninput="setCustomValidity('')" name="search" class="form-control" placeholder="{{ trans('app.search')}}..." value="{{ isset($s) ?  $s : ''}}" required>
                  <button class="btn-search" type="submit"><i class="fa fa-search"></i></button>
                </div>
              </form>
            </div>
          </div>

          <!-- End Search -->
        </div>
        <div class="col-lg-3 col-sm-4 col-xs-12 top-cart">
          <!-- <div class="link-wishlist"> <a href="#"> <span class="wishlist-count">3</span> <i class="fa fa-heart fa-lg"></i> </a> </div> -->
          @if (Route::has('login'))
          @if (Auth::check())

          <div class="top-cart-contain">
            <div class="mini-cart">
              <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="#">
                @php
                $wish = App\Wishlist::where('user_id',[Auth::user()->id])->get()
                @endphp
                @php($total = 0)
                @php($total1=0)
                @foreach($wish as $wis)
                @php($total += $wis->product_price)
                @php($total1 += $wis->product_discount)
                @endforeach
                <div class="cart-icon"><i class="fa fa-shopping-cart"></i></div>
                <div class="shoppingcart-inner"><span class="cart-title">{{ trans('app.wishlist')}}</span>
                  <span class="cart-total">{{count($wish)}} Item(s): {{($total) - ($total1)}}AZN</span></div>
                </a></div>
              <div>
                <div class="top-cart-content">
                  <div class="block-subtitle hidden-xs" style="text-transform:capitalize;">{{ trans('app.recently_added_item')}}</div>
                  <ul id="cart-sidebar" class="mini-products-list">
                    @php
                    $wis = App\Wishlist::where('user_id',[Auth::user()->id])->get()
                    @endphp
                    @foreach($wis as $wish)
                    <li class="item odd"> <a href="/product_details/{{$wish->product_id}}" title="" class="product-image">
                      @php
                      $prodd = App\ProductDetails::all()
                      @endphp
                      @foreach($prodd as $prodd)
                      @if($prodd->id == $wish->product_id)
                      <img src="/uploads/productphotos/{{$prodd->photos}}" alt="" width="65">
                      @endif
                      @endforeach
                    </a>
                      <div class="product-details"> <a href="/wishlistproddel/{{ $wish->id }}" title="Remove This Item" class="remove-cart"><i class="icon-close"></i></a>
                        <p class="product-name"><a href="#">{{$wish->product_name}}</a> </p>
                        <span class="price">{{$wish->product_price}}</span> </div>
                    </li>

                    @endforeach
                  </ul>
                  <div class="top-subtotal" style="text-transform:capitalize;">{{ trans('app.total')}}: <span class="price">{{($total) - ($total1)}}AZN</span></div>
                  <div class="actions">
                    <a href="/wishlist"  class="view-cart" type="button"><i class="fa fa-shopping-cart"></i> <span>{{ trans('app.more')}}</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
          @endif
        </div>
      </div>
    </div>
  </div>
</header>
