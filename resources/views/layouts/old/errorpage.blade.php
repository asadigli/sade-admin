@extends('layouts.master')

@section('body')
<div id="page">
<!-- Header -->
@include('layouts.header')
@include('layouts.menuarea')
  <!-- Breadcrumbs -->

  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="{{ trans('app.go_back_to_home')}}" href="/">{{ trans('app.home')}}</a><span>&raquo;</span></li>
            <li><strong>404 Error </strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End -->

  <!--Container -->
  <div class="error-page">
    <div class="container">
      <div class="error_pagenotfound"> <strong>4<span id="animate-arrow">0</span>4 </strong> <br />
        <b style="text-transform:capitalize;">{{ trans('app.not_found')}}</b>
        <p>{{ trans('app.go_back_to_home')}}</p>
        <br />
        <a href="/" class="button-back"><i class="fa fa-arrow-circle-left fa-lg"></i>&nbsp; {{ trans('app.goback')}}</a> </div>
      <!-- end error page notfound -->

    </div>
  </div>
  <!-- Container End -->
   <!-- our clients Slider -->
@include('layouts.partners')
@include('layouts.footerdiscounts')
@include('layouts.footer')
  <a href="#" class="totop"> </a> </div>
@endsection
