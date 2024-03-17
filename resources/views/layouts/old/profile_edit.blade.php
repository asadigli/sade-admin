@extends('layouts.master')

@section('body')
<style media="screen">
.verif_sign{
  color:#19bfb1;
  cursor:pointer;
}
.means_verif {
 visibility: hidden;
 width: 120px;
 background-color: gray;
 color: #fff;
 text-align: center;
 border-radius: 6px;
 padding: 5px 0;
 position: absolute;
}
.verif_sign:hover .means_verif {
  visibility: visible;
}
</style>
<div id="page">
  @include('layouts.header')
  <!-- end header -->
  @include('layouts.menuarea')
  <!-- Breadcrumbs -->

  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <ul>
            <li class="home"> <a title="Go to Home Page" href="/">{{ trans('app.home')}}</a><span>&raquo;</span></li>
            <li class="home"> <a title="Go to Home Page" href="/userprofile/{{Auth::user()->id}}">{{Auth::user()->name}} {{Auth::user()->surname}}</a><span>&raquo;</span></li>
            <li><strong>Account Settings</strong></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End -->
  <!-- Main Container -->
  <div class="main-container col2-left-layout">
    <div class="container">
      <div class="row">
        <div class="col-main col-sm-9 col-xs-12 col-sm-push-3">
          <div class="product-overview-tab">
                <div class="product-tab-inner">
                  <div  class="tab-content">
                    @if(Session::has('editedprofile'))
  										<center>
  											<div class="col-md-4" style="width:90%;">
  												<div class="alert alert-success">
  													{{Session::get('editedprofile')}}
  												</div>
  											</div>
  										</center>
  									@endif
                    <div class="">
                      <div class="std">
                        <!-- <p style=""> -->
                          <form class="" action="/editprofile/{{Auth::user()->id}}" method="post">
                            {{csrf_field()}}
                            <div>
                              <label for="name">Name</label>
                              <input class="form-control" type="text" name="name" value="{{Auth::user()->name}}" placeholder="Change name...">
                            </div><br>
                            <div>
                              <label for="surname">Surname</label>
                              <input class="form-control" type="text" name="surname" value="{{Auth::user()->surname}}" placeholder="Change surname...">
                            </div><br>
                            <div>
                              <label for="dob">Date of Birth</label>
                              <input class="form-control" type="date" name="dob" value="{{Auth::user()->dob}}">
                            </div><br>
                            <div>
                              <label for="mobile">Mobile</label>
                              <input class="form-control" type="text" name="mobile" value="{{Auth::user()->mobile}}" placeholder="+(994)70 818 66 01">
                            </div><br>
                            <button type="submit" name="button" class="pull-right btn btn-primary">{{ trans('app.edit')}}</button>
                          </form>
                        <!-- </p> -->
                        </div>
                    </div>
                  </div>
                </div>

        </div>
        </div>
        <aside class="sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          @include('layouts.myaccount')
          @include('layouts.populartags')
        </aside>
      </div>
    </div>
  </div>
@include('layouts.partners')
@include('layouts.footerdiscounts')
@include('layouts.footer')
  <a href="#" class="totop"> </a> </div>
@endsection
