<link type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link type="text/css" href="{{ asset('bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
<link type="text/css" href="{{ asset('css/theme.css')}}" rel="stylesheet">
<link type="text/css" href="{{ asset('css/resp.css')}}" rel="stylesheet">
<link type="text/css" href="{{ asset('images/icons/css/font-awesome.css')}}" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Tangerine">

<style media="screen">
.logreg{
	color:white;
	width:50%;
	margin-left:18%;
}
.logreg:hover{
	box-shadow: 0px 0px 5px 1px #379FB9;
}
.sidebar-nav {
padding: 9px 0;
}
.navbar{
	font-family: Anivers;
}

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
<style>
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: white;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
	<section id="navbar">
	  <div class="navbar">
	    <div class="navbar-inner" style="height:80px;">
	      <div class="container"><br>
	        <!-- <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	          <span class="icon-bar" style="background-color:White;"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	        </a> -->


						 <span class="respp_for_mobile"><a href="/home">
							 <h3 style="margin-top:-4px;">{{ trans('app.home')}}</h3>
						 </a> </span>

	        <div class="nav-collapse">
	          <ul class="nav">
	            <li class=""><a href="/">{{ trans('app.home') }}</a></li>
							<li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('app.menu') }}
									<!-- <b class="caret"></b> -->
								</a>
	              <ul class="dropdown-menu">
									<li><a href="#">Price Range Filter</a></li>
	                <li class="divider"></li>
	                <li class="nav-header">Nav header</li>
	                <li><a href="#">Separated link</a></li>
	                <li><a href="#">One more separated link</a></li>
									<li><a href="/about">{{ trans('app.about') }}</a></li>
									<li></li>
	              </ul>
	            </li>

	            <!-- <li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-transform:capitalize;">{{ trans('app.catalog') }}<b class="caret"></b></a>
	              <ul class="dropdown-menu">
									<li class="nav-header">City</li>
									@php
									$city = App\City::all()
									@endphp
									<li><select class="" name="" style="width:76%;">
										@foreach($city as $ct)
										<option value="">{{$ct->name}}</option>
										@endforeach
									</select> <button type="submit" name="button" class="btn btn-primary" style="margin-top:-4.5%;"> Go!</button></li>
									<li class="nav-header">Country</li>
									@php
									$country = App\Country::all()
									@endphp
									<li><select class="" name="" style="width:76%;">
										@foreach($country as $count)
										<option value="">{{ $count->name}}</option>
										@endforeach
									</select> <button type="submit" name="button" class="btn btn-primary" style="margin-top:-4.5%;"> Go!</button></li>
	              </ul>
	            </li> -->
	          </ul>
	          <ul class="nav pull-right">
	            <li class="divider-vertical"></li>
							@if (Route::has('login'))
							@if (Auth::check())
							<li class="dropdown">
							<ul class="nav pull-right">
									<li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
											{{ Auth::user()->name}}
											<img src="{{ asset('images/main_avatar.png')}}" class="nav-avatar" />
											<b class="caret"></b></a>
											<ul class="dropdown-menu">
												<!-- <li><a href=""><i class="fa fa-user" style="color:blue;"></i> {{ trans('app.profile') }}</a></li> -->
												<li><a href="/adm"><i class="fa fa-columns" style="color:blue;"></i> {{ trans('app.adminpanel') }}</a></li>
														<!-- <li><a href="{{ url('/userprofile/edit/'.Auth::user()->id.'/')}}"><i class="fa fa-cogs" style="color:blue;"></i>
															 {{ trans('app.accountsettings') }}</a></li> -->

												<li><a href="/adm/sellproduct"><i class="fa fa-shopping-cart" style="color:blue;"></i> {{ trans('app.sellproduct') }}</a></li>
												<!-- <li><a href="/helpdesk"><i class="fa fa-h-square" style="color:blue;"></i> {{ trans('app.helpdesk') }}</a></li> -->
												<li class="divider"></li>
												<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
																			document.getElementById('logout-form').submit();">
														<i class="fa fa-sign-out" style="color:blue;"></i> {{ trans('app.logout') }}
												</a>
												<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																{{ csrf_field() }}
												</form>
											</li>
											</ul>
												</li>
									</ul>
								</li>
								@else
									<li class="dropdown">
						          <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-transform:capitalize;">{{ trans('app.join')}}
												<!-- <b class="caret"></b> -->
											</a>
						          <ul class="dropdown-menu">
												<li><a href="/login" style="text-transform:capitalize;">{{ trans('app.login') }}</a></li>
												<li class="divider"></li>
												<li><a  href="/register" style="text-transform:capitalize;">{{ trans('app.register') }}</a></li>
								        <!-- <li class="divider"></li> -->
						          </ul>
						        </li>
								@endif
								@endif
	          </ul>
	        </div><!-- /.nav-collapse -->
	      </div>
	    </div><!-- /navbar-inner -->
	  </div><!-- /navbar -->
	</section>
	<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
