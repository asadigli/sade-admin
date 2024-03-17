@extends('layouts.master')
@section('css')
<title>{{ ucwords(trans('app.home'))}}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/simple-line-icons.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/fullcalendar.min.css')}}"/>
@endsection
@section('body')
<div id="content">
  <div class="panel">
    <div class="panel-body">
      <div class="col-md-6 col-sm-12">
        <ul class="nav navbar-nav">
          <li><a href="/productlist" class="capi">{{ trans('app.product_list')}} </a></li>
          <li><a href="/sellproduct" class="capi">{{ trans('app.addproduct')}} </a></li>
          <li class="capi"><a href="/helpdeskcontrol">{{trans('app.contacts')}}
              @php
              $ct = App\Contact::where('deleted_status','=',0)->where('read','=',0)->get()
              @endphp
              @if(count($ct) != 0)
              &nbsp;<b class="label btn-danger pull-right">
                {{count($ct)}}
              </b>
              @endif
          </a></li>
        </ul>
      </div>
		</div>
  </div>
  <div class="col-md-12" style="padding:20px;">
    <div class="col-md-12 padding-0">
      <div class="col-md-8 padding-0">
        <div class="col-md-12 padding-0">
          <div class="col-md-6">
            <div class="panel box-v1">
              <div class="panel-heading bg-white border-none">
                <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                    <h4 class="text-left capi">{{ trans('app.users')}}</h4>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                    <h4><span class="icon-user icons icon text-right"></span> </h4>
                </div>
              </div>
              <div class="panel-body text-center">
                    <h1>{{count($users)}}</h1><p class="capi">{{ trans('app.users')}}</p><hr/>
              </div>
            </div>
          </div>
          <div class="col-md-6">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left capi">{{ trans('app.products')}}</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-basket-loaded icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                        <h1>{{count($productdetails)}}</h1>
                                        <p class="capi"><a href="/list-of-most-viewed-products">{{ trans('app.products')}}</a> </p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
																<div class="col-md-6">
																		<div class="panel box-v1">
																			<div class="panel-heading bg-white border-none">
																				<div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
																					<h4 class="text-left capi">{{ trans('app.total_product_views')}}</h4>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-6 text-right">
																					 <h4>
																					 <span class="icon-basket-loaded icons icon text-right"></span>
																					 </h4>
																				</div>
																			</div>
																			<div class="panel-body text-center">
																				<h1 title="{{$view_pro}}">{{$view_pro_today}}</h1>
																				<p class="capi">{{ trans('app.total_product_views')}}</p>
																				<hr/>
																			</div>
																		</div>
																</div>
																<div class="col-md-6">
																		<div class="panel box-v1">
																			<div class="panel-heading bg-white border-none">
																				<div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
																					<h4 class="text-left capi">{{ trans('app.posts')}}</h4>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-6 text-right">
																					 <h4>
																					 <span class="icon-basket-loaded icons icon text-right"></span>
																					 </h4>
																				</div>
																			</div>
																			<div class="panel-body text-center">
																				<h1>{{count($posts)}}</h1>
																				<p class="capi">{{ trans('app.posts')}}</p>
																				<hr/>
																			</div>
																		</div>
																</div>
																<div class="col-md-6">
																		<div class="panel box-v1">
																			<div class="panel-heading bg-white border-none">
																				<div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
																					<h4 class="text-left capi">{{ trans('app.comments')}}</h4>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-6 text-right">
																					 <h4>
																					 <span class="icon-basket-loaded icons icon text-right"></span>
																					 </h4>
																				</div>
																			</div>
																			<div class="panel-body text-center">
																				<h1>{{count($comments)}}</h1>
																				<p class="capi">{{ trans('app.comments')}}</p>
																				<hr/>
																			</div>
																		</div>
																</div>
																<div class="col-md-6">
																		<div class="panel box-v1">
																			<div class="panel-heading bg-white border-none">
																				<div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
																					<h4 class="text-left capi">{{ trans('app.total_searches')}}</h4>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-6 text-right">
																					 <h4>
																					 <span class="icon-basket-loaded icons icon text-right"></span>
																					 </h4>
																				</div>
																			</div>
																			<div class="panel-body text-center">
																				<h1  style="cursor:pointer;"  title="{{count($tag)}}">{{$tag_tot}}</h1>
																				<p class="capi">{{ trans('app.total_searches')}}</p>
																				<hr/>
																			</div>
																		</div>
																</div>
																<div class="col-md-6">
																		<div class="panel box-v1">
																			<div class="panel-heading bg-white border-none">
																				<div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
																					<h4 class="text-left capi">{{ trans('app.categories')}}</h4>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-6 text-right">
																					 <h4>
																					 <span class="icon-basket-loaded icons icon text-right"></span>
																					 </h4>
																				</div>
																			</div>
																			<div class="panel-body text-center">
																				<h1  style="cursor:pointer;"  title="{{trans('app.subcategory')}}: {{count($subcat)}} ">{{count($cats)}}</h1>
																				<p class="capi">{{ trans('app.categories')}}</p>
																				<hr/>
																			</div>
																		</div>
																</div>
																<div class="col-md-6">
																		<div class="panel box-v1">
																			<div class="panel-heading bg-white border-none">
																				<div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
																					<h4 class="text-left capi">{{ trans('app.category_view')}}</h4>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-6 text-right">
																					 <h4>
																					 <span class="icon-basket-loaded icons icon text-right"></span>
																					 </h4>
																				</div>
																			</div>
																			<div class="panel-body text-center">
																				<h1  style="cursor:pointer;">{{$v_cat}}</h1>
																				<p class="capi">{{ trans('app.category_view')}}</p>
																				<hr/>
																			</div>
																		</div>
																</div>
																<div class="col-md-6">
																		<div class="panel box-v1">
																			<div class="panel-heading bg-white border-none">
																				<div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
																					<h4 class="text-left capi">{{ trans('app.subcat_view')}}</h4>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-6 text-right">
																					 <h4>
																					 <span class="icon-basket-loaded icons icon text-right"></span>
																					 </h4>
																				</div>
																			</div>
																			<div class="panel-body text-center">
																				<h1  style="cursor:pointer;">{{$v_subcat}}</h1>
																				<p class="capi">{{ trans('app.subcat_view')}}</p>
																				<hr/>
																			</div>
																		</div>
																</div>
																<div class="col-md-6"><div class="panel box-v1"><div class="panel-heading bg-white border-none">
                                      <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0"><h4 class="text-left capi">{{ trans('app.news_view')}}</h4></div><div class="col-md-6 col-sm-6 col-xs-6 text-right"><h4><span class="icon-basket-loaded icons icon text-right"></span></h4></div></div>
                                      <div class="panel-body text-center"><h1 style="cursor:pointer;">{{$v_news}}</h1><p class="capi">{{ trans('app.news_view')}}</p><hr/></div></div>
                                    </div>
																<div class="col-md-6">
																		<div class="panel box-v1">
																			<div class="panel-heading bg-white border-none">
																				<div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
																					<h4 class="text-left capi">{{ trans('app.page_view')}}</h4>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-6 text-right">
																					 <h4>
																					 <span class="icon-basket-loaded icons icon text-right"></span>
																					 </h4>
																				</div>
																			</div>
																			<div class="panel-body text-center">
																				<h1 style="cursor:pointer;">{{$v_page}}</h1>
																				<p class="capi">{{ trans('app.page_view')}}</p>
																				<hr/>
																			</div>
																		</div>
																</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12 padding-0">
                              <div class="panel box-v2">
                                  <div class="panel-heading padding-0"><img src="{{ asset('adm/img/bg2.jpg')}}" class="box-v2-cover img-responsive"/><div class="box-v2-detail"></div></div>
                                  <div class="panel-body"><div class="col-md-12 padding-0 text-center"><div class="col-md-4 col-sm-4 col-xs-6 padding-0"><h3>0</h3><p>Post</p></div><div class="col-md-4 col-sm-4 col-xs-6 padding-0"><h3>0</h3><p>share</p></div><div class="col-md-4 col-sm-4 col-xs-12 padding-0"><h3>0</h3><p>photos</p></div></div></div>
                              </div>
                            </div>
                            <div class="col-md-12 padding-0">
                              <div class="panel box-v3">
                                <div class="panel-heading bg-white border-none"><h4>Statistika</h4></div>
                                <div class="panel-body">
																	<span class="capi">Users' Gender</span>
																	@php
																	$user_male = App\User::where('gender',1)->get()
																	@endphp
																	@php
																	$user_female = App\User::where('gender', 2)->get()
																	@endphp
                                  <div class="media">
                                    <div class="media-left"><span class="icon-user icons" style="font-size:2em;"></span></div>
                                    <div class="media-body">
																			@if(!(count($user_male)+count($user_female))==0)
                                      <h5 class="media-heading capi">{{ trans('app.male_users')}}</h5>
                                        <div class="progress progress-mini">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10{{(count($user_male)/(count($user_male)+count($user_female)))*100}}%;">
                                            <span class="sr-only">{{(count($user_male)/(count($user_male)+count($user_female)))*100}}% </span>
                                          </div>
                                        </div>
																				@endif
                                    </div>
                                  </div>
                                  <div class="media">
                                    <div class="media-left">
																			<span class="icon-user icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
																			@if(!(count($user_male)+count($user_female))==0)
                                      <h5 class="media-heading capi">{{ trans('app.female_users')}}</h5>
                                        <div class="progress progress-mini">
                                          <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="19" aria-valuemin="0" aria-valuemax="100" style="width: {{100-substr(((count($user_male)/(count($user_male)+count($user_female)))*100),0,4)}}%;">
                                            <span class="sr-only">{{100-substr(((count($user_male)/(count($user_male)+count($user_female)))*100),0,4)}}% Complete</span>
                                          </div>
                                        </div>
																			@endif
                                    </div>
                                  </div>
																	<hr>
																	<span class="capi">Product Categories</span>

																		@php
															        $products = App\ProductDetails::all()
															      @endphp
																		@php
																		$cat = App\Category::all()
																		@endphp
															      @foreach($cat as $ct)
															      <!-- if($ct->id % 2 == 0) -->
															      @php
															        $prods = App\ProductDetails::where('category_id','=',[$ct->id])->get()
															      @endphp
																		<div class="media">
	                                    <div class="media-left">
																				<span class="icon-pie-chart icons" style="font-size:2em;"></span>
	                                    </div>
	                                    <div class="media-body">
	                                      <h5 class="media-heading"><a href="https://sade.store/category/{{$ct->slug}}" title="{{$ct->name}}" target="_blank">{{$ct->name}}</a></h5>
	                                        <div class="progress progress-mini">
	                                          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: {{substr((count($prods)/count($products))*100,0,4)}}%;">
	                                            <span class="sr-only">{{substr((count($prods)/count($products))*100,0,4)}}%</span>
	                                          </div>
	                                        </div>
	                                    </div>
																		</div>
															      @endforeach
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
  							</div>
      		  </div>
@endsection
@section('js')
<script src="{{ asset('adm/js/jquery.min.js')}}"></script>
<script src="{{ asset('adm/js/jquery.ui.min.js')}}"></script>
<script src="{{ asset('adm/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/moment.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/fullcalendar.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/jquery.nicescroll.js')}}"></script>
<script src="{{ asset('adm/js/plugins/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/maps/jquery.vmap.world.js')}}"></script>
<script src="{{ asset('adm/js/plugins/jquery.vmap.sampledata.js')}}"></script>
<script src="{{ asset('adm/js/plugins/chart.min.js')}}"></script>
<script src="{{ asset('adm/js/main.js')}}"></script>
@endsection
