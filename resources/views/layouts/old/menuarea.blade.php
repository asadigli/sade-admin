<div class="menu-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12 hidden-xs">
        <div class="main-menu">
          <nav>
            <ul>
              <li class="custom-menu"><a href="/">{{ trans('app.home')}}</a>

              </li>
              @php
              $cat = App\Category::all()
              @endphp

              <li class="megamenu">
                <a style="cursor:pointer;">{{ trans('app.categories')}}</a>
                <div class="mega-menu">
                  @foreach($cat as $cat)
                  @php
                  $subcat = App\Subcat::where('parent_id',[$cat->id])->get()
                  @endphp
                  <span>
                    <a class="mega-title" href="#">{{$cat->name}} </a>
                    @foreach($subcat as $sc1)
                    <a href="/products/{{$sc1->id}}">{{$sc1->name}}</a>
                    @endforeach
                  </span>
                  @endforeach

                  <!-- <span>
                  <a class="mega-title" href="#">Jewellery </a>
                  <a href="shop_grid.html">Gold</a>
                  <a href="shop_grid.html">Platinum</a>
                  <a href="shop_grid.html">Rings </a>
                  <a href="shop_grid.html">Neckwear </a>
                </span> -->

                  <span class="mega-menu-img hidden-sm">
                      <a href=""><img src="{{ asset('images/menu-img1.jpg')}}" alt="Bannar 1"></a>
                  </span>
                </div>
              </li>
              <li class="custom-menu"><a href="/">{{ trans('app.more')}}</a>
                <ul class="dropdown">
                  <!-- <li> <a href=""> Blog &ndash; Right Sidebar </a></li> -->
                  <li> <a href="/discounts"> {{ trans('app.earn_online')}}</a></li>
                  <li><a href="/termsofdelivary"> {{ trans('app.shipping_service')}} </a> </li>
                  <li><a href="/about"> {{ trans('app.aboutus')}} </a></li>
                </ul>
              </li>
              <li><a href="/contact">{{ trans('app.contact')}}</a></li>
            </ul>
          </nav>
          <!-- Signup -->
          @if (Route::has('login'))
          @if (Auth::check())
          @if(((Auth::user()->role_id)==2) | ((Auth::user()->role_id)==4) | ((Auth::user()->role_id)==3))
            <p class="top-Signup"><a href="/adm" class="" role="button" style="text-transform:capitalize;"> {{ trans('app.admin_panel')}}</a></p>
          @endif
          @else
          <!-- <p class="top-Signup"><a href="#" class="" role="button" data-toggle="modal" data-target="#login-modal">{{trans('app.login')}}</a></p> -->
          <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header"> <img id="img_logo" src="{{ asset('images/logo.png')}}" alt="logo">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button>
                </div>
                <div id="div-forms">
                  <form id="login-form" method="POST" action="{{ route('login') }}">
                    {{csrf_field()}}
                    <div class="modal-body">
                      <div id="div-login-msg"> <span id="text-login-msg">Email address </span> </div>
                      <input name="email" type="text" class="form-control" placeholder="E-mail..." required >
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                      <!-- <input id="login_password" class="form-control" type="password" placeholder="Password" required> -->
                      <input name="password" id="passworddd" type="password" class="form-control" required placeholder="Password...">
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                      <div class="checkbox">
                        <label>
                          <input name="remember" type="checkbox" value="forever" id="rememberme" >
                          {{trans('app.remember_me')}} </label>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <div>
                        <button type="submit" class="btn-login">{{ trans('app.login')}}</button>
                      </div>
                      <div>
                        <a href="/register" class="btn btn-link">{{ trans('app.register')}}</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endif
          @endif
          <!-- END # MODAL LOGIN -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- mobile menu -->
<div class="mobile-menu hidden-sm hidden-md hidden-lg menuarea_delete_for_app">
  <nav><span class="mobile-menu-title" style="text-tranform:capitalize;">{{ trans('app.categories')}}</span>
    <ul>
      <li class="">
        <a href="/">{{ trans('app.home')}}</a>
          <!-- </ul> -->
      </li>
      <li><a href="">{{ trans('app.categories')}}</a>
        <ul>
          @php
          $cat = App\Category::all()
          @endphp
          @foreach($cat as $cat)
          <li><a class="">{{$cat->name}} </a>
            <ul>
              @php
              $subcat = App\Subcat::where('parent_id',[$cat->id])->get()
              @endphp
              @foreach($subcat as $sc)
              <li> <a href="/products/{{$sc->id}}"> {{$sc->name}} </a> </li>
              @endforeach
            </ul>
          </li>
          @endforeach
        </ul>
      </li>
      <li>
        <a href="/contact">{{ trans('app.aboutus')}}</a>
      </li>
    </ul>
  </nav>
</div>
