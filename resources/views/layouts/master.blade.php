<!DOCTYPE html>
<html lang="az">
<head>
	<meta charset="utf-8">
	<meta name="description" content="No Permission">
	<meta name="author" content="Sade Store">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="robots" content="noindex,nofollow">
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
	<link rel="shortcut icon" href="{{ asset('images/logo-dark.png')}}">
	<link rel="stylesheet" type="text/css" href="/adm/css/bootstrap.min.css?v={{md5(uniqid())}}">
	<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.6.3/css/all.css?v={{md5(uniqid())}}" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  @section('css')
  @show
  <link rel="stylesheet" type="text/css" href="/adm/css/style.css?v={{md5(uniqid())}}" rel="stylesheet">
  </head>
 <body id="mimin" class="dashboard">
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="/admin" class="navbar-brand"><b>Panel</b></a>
						@if(2==5)<ul class="nav navbar-nav search-nav"> <li> <div class="search"> <span class="fa fa-search icon-search" style="font-size:23px;"></span> <div class="form-group form-animate-text"> <input type="text" class="form-text" required> <span class="bar"></span> <label class="label-search" style="color:white;">Type anywhere to <b>Search</b> </label> </div></div></li></ul> @endif

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name capi"><span>{{Auth::user()->name}} {{Auth::user()->surname}}</span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="{{ asset('uploads/avatars/'. Auth::user()->avatar)}}" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                     <li><a href="/profile"><span class="fa fa-user"></span> My Profile</a></li>
										 <li role="separator" class="divider"></li>
										 <li><a class="capi" href="/sellproduct"> <span class="fa-plus fa"></span> {{trans('app.sellproduct')}}</a> </li>
										 <li role="separator" class="divider"></li>
										 @if(Auth::user()->role_id == 4 | Auth::user()->role_id == 3)
 											<li><a href="/pages" class="capi"><span class="fa fa-cog"></span> {{ trans('app.page_control')}}</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="/metatags"><span class="fa fa-tag"></span> SEO Control</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="/delete-unused-images" target="_blank"><span class="fa fa-trash"></span> Clean unused files</a></li>
										 @endif
                     <li role="separator" class="divider"></li>
                     <li class="more">
                      <ul>
                        <li><a href=""><span class="fa fa-cogs-"></span></a></li>
                        <li><a href=""><span class="fa fa-lock-"></span></a></li>
                        <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span class="fa fa-power-off "></span> </li></a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li></li>
              </ul>
            </div>
          </div>
        </nav>
      <div class="container-fluid mimin-wrapper">
            <div id="left-menu">
              <div class="sub-left-menu scroll">
                <ul class="nav nav-list">
                    <li><div class="left-bg"></div></li> <li class="time"> <h1 class="animated fadeInLeft">21:00</h1> <p class="animated fadeInRight">Sat,October 1st 2029</p></li>
										<li class="ripple capi"><a href="/"><span class="fa fa-home"></span>{{ trans('app.admin_home')}}</a></li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header capi">
                        <span class="fa fa-list"></span> {{ trans('app.lists')}}
												@if($newscomment = App\Newscomment::where('verify','=',0)->count() != 0)<b class="label btn-danger">{{$newscomment = App\Newscomment::where('verify','=',0)->count()}}</b>@endif
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree capi">
                        <li><a href="/productlist">{{ trans('app.product_list')}}
                          <b class="label btn-success pull-right">
                          {{$productdetails_unconfirmed = App\ProductDetails::where('confirmed','0')->count()}}</b></a></li>
                          <li><a href="/catlists">{{ trans('app.category_list')}}
                            <b class="label btn-success pull-right">{{$cat = App\Category::all()->count()}}</b>
                          </a></li>
                          <li><a href="/news-list">{{ trans('app.news_list')}}
                            <b class="label btn-success pull-right">{{$news_list = App\News::all()->count()}}</b>
                          </a></li>
			                    <li><a href="/unverified">{{ trans('app.comments')}}
			                      <b class="label btn-danger pull-right">{{$newscomment = App\Newscomment::where('verify','=',0)->count()}}</b></a></li>
                          <li><a href="/vipcomments">{{ trans('app.vip_comment_list')}}<b class="label btn-warning pull-right">{{$vp = App\VipComments::all()->count()}}</b></a></li>
                          @if(Auth::user()->role_id == 4)
                          	<li><a href="/userlist">{{ trans('app.user_list')}}</a></li>
                          @endif
                      </ul>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header capi"> <span class="fa fa-list"></span>{{trans('app.create')}}<span class="fa-angle-right fa right-arrow text-right"></span> </a>
                      <ul class="nav nav-list tree capi">
                        <li><a href="/sellproduct"><i class="menu-icon icon-inbox"></i>{{ trans('app.addproduct')}} </a></li>
                        @if(Auth::user()->role_id == 4 | Auth::user()->role_id == 3)
                        <li><a href="/catcreation"><i class="menu-icon icon-inbox"></i>{{ trans('app.addcategory')}}  </a></li>
                        @endif
                        <li><a href="/addnews"><i class="menu-icon icon-inbox"></i>{{ trans('app.addnews')}} </a></li>
												<li><a href="/boostedlist"><i class="menu-icon icon-inbox"></i>{{ trans('app.addposter')}} </a> </li>
                        @if(Auth::user()->role_id == 4)
                        <li><a href="/usercreation"><i class="menu-icon icon-inbox"></i>{{ trans('app.createuser')}} </a> </li>
                        @endif
                      </ul>
                    </li>
                    <li><a href="https://sade.store" class="capi" target="_blank">
                      <img src="//img.sade.store/logo.png" alt="Sade Store" width="20" height="17"> Sade Store </a></li>
                    <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span class="fa fa-lock"></span>{{trans('app.logout')}}</a></li>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
										</ul>
                </div>
            </div>
      @section('body')
      @show
      </div>
      <div id="mimin-mobile" class="reverse">
        <div class="mimin-mobile-menu-list">
            <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
                <ul class="nav nav-list">
                  <li class="ripple capi"><a href="/admin"><span class="fa fa-home"></span>{{ trans('app.admin_home')}}</a></li>
                  <li class="ripple capi"><a href="/helpdeskcontrol"><span class="fa fa-list"></span> {{trans('app.contacts')}}
                    <b class="label btn-danger pull-right">{{$ct = App\Contact::all()->count()}}</b>
                  </a></li>
                  <li class="ripple capi"><a href="/unverified"><span class="fa fa-list"></span>  {{ trans('app.comments')}}
                    <b class="label btn-danger pull-right">{{$newscomment = App\Newscomment::where('verify','=',0)->count()}}</b>
                  </a></li>
                  <li class="ripple">
                    <a class="tree-toggle nav-header capi">
                      <span class="fa-diamond fa"></span> {{ trans('app.lists')}}
                      <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree capi">
                      <li><a href="/productlist">{{ trans('app.product_list')}}
                        <b class="label btn-success pull-right">
                        {{$productdetails_unconfirmed = App\ProductDetails::where('confirmed','0')->count()}}
                        </b></a></li>
                        <li><a href="/catlists">{{ trans('app.category_list')}}
                          <b class="label btn-success pull-right">{{$cat = App\Category::all()->count()}}</b>
                        </a></li>
                        <li><a href="/vipcomments">
                          {{ trans('app.vip_comment_list')}}<b class="label btn-warning pull-right">
                                {{$vp = App\VipComments::all()->count()}}</b>
                            </a></li>
                        @if(Auth::user()->role_id == 4)
                        	<li><a href="/userlist">{{ trans('app.user_list')}}</a></li>
                        @endif
                    </ul>
                  </li>
                  <li class="ripple">
                    <a class="tree-toggle nav-header capi">
                      <span class="fa-diamond fa"></span> {{ trans('app.create')}}
                      <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree capi">
                      <li><a href="/sellproduct"><i class="menu-icon icon-inbox"></i>{{ trans('app.addproduct')}} </a></li>
                      @if(Auth::user()->role_id == 4 | Auth::user()->role_id == 3)
                      	<li><a href="/catcreation"><i class="menu-icon icon-inbox"></i>{{ trans('app.addcategory')}}  </a></li>
                      @endif
                      	<li><a href="/addnews"><i class="menu-icon icon-inbox"></i>{{ trans('app.addnews')}} </a></li>
                      	<li><a href="/boostedlist"><i class="menu-icon icon-inbox"></i>{{ trans('app.addposter')}} </a> </li>
                      @if(Auth::user()->role_id == 4)
                      	<li><a href="/usercreation"><i class="menu-icon icon-inbox"></i>{{ trans('app.createuser')}} </a> </li>
                      @endif
                    </ul>
                  </li>
                  <li><a href="https://sade.store" class="capi">
                    <span class="fa fa-backward"></span>{{ trans('app.go_to_store')}} </a></li>
                  <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span class="fa fa-lock"></span>{{trans('app.logout')}}</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                  </ul>
            </div>
        </div>
      </div>
      <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger"><span class="fa fa-bars"></span></button>
    @section('js')
    @show
  </body>
</html>
