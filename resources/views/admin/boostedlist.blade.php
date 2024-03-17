@extends('admin.adminmaster')

@section('navbar')
<title>{{ trans('app.boostedlist')}}</title>

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="span9">
					<div class="content">
						<div class="module">
							<div class="module-head">
								<h3 style="text-transform:capitalize;">{{ trans('app.addposter')}}</h3>
							</div>
							<div class="module-body">
								<form enctype="multipart/form-data" action="/adm/addposter" method="post">
									{{ csrf_field()}}
									{{ trans('app.product')}}:
									<select class="" name="product_id">
										<option value="0" selected>{{ trans('app.empty')}}</option>
										@php
										$productdetails = App\ProductDetails::all();
										@endphp
										@foreach($productdetails as $prodet)
										<option value="{{$prodet->id}}" name="product_id">{{substr($prodet->productname,0,15)}}... <i>ID: {{$prodet->id}}</i></option>
										@endforeach
									</select>
									<br>
									{{ trans('app.news')}}:
									<select class="" name="item_id">
										<option value="0" selected disabled>{{ trans('app.select_news')}}</option>
										@php
										$news = App\News::all()
										@endphp
										@foreach($news as $news)
										<option value="{{$news->id}}" >{{substr($news->news_title,0,15)}}...</option>
										@endforeach
									</select>
										<input type="hidden" value="{{Auth::user()->id}}" name="user_id">
										<br>
									{{ trans('app.time')}}: <input type="number" name="time" required>
									<br>
									Şəkil seç:
									<input type="file" name="poster" required>
									<!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
									<br>
									<button type="submit" class="btn btn-primary" style="float:right;text-transform:capitalize;" name="submit">{{ trans('app.create_poster')}}</button><br>
								</form>
							</div><!--/.module-body-->
						</div><!--/.module-->
						<div class="module">
							<div class="module-head">
								<h3 style="text-transform:capitalize;">{{ trans('app.boostedlist')}}</h3>
							</div>
							@if(Session::has('deletedposter'))
							<br>
								<center>
									<div class="col-md-4" style="width:90%;">
										<div class="alert alert-success">
											{{Session::get('deletedposter')}}
										</div>
									</div>
								</center>
							@endif
							<div class="module-body">

								<table class="table table-bordered" style="width:95%;margin-left:2.5%;">
														<thead>
															<tr>
																<th  style="text-transform:capitalize;">{{ trans('app.empty')}}</th>
																<th  style="text-transform:capitalize;">{{ trans('app.productname')}}</th>
																<th  style="text-transform:capitalize;">{{ trans('app.news_title')}}</th>
																<th  style="text-transform:capitalize;">{{ trans('app.period')}}</th>
																<th  style="text-transform:capitalize;">{{ trans('app.boostdate')}}</th>
																<th>X</th>
															</tr>
														</thead>
														<tbody>
															@php
															$poster = App\Poster::all()
															@endphp
															@php($total = 0)
															@php($total1=0)
															@foreach($poster as $prod)
															<tr>
																<td>
																	@if($prod->product_id == 0)
																	{{ trans('app.empty')}}
																	@else
																	<span style="color:red;">X</span>
																	@endif

																</td>
																<td>
																	<a href="/product_details/{{$prod->product_id}}">
																		@php
																		$product = App\ProductDetails::where('id','=',[$prod->product_id])->get()
																		@endphp
																		@foreach($product as $prr)
																		{{$prr->productname}}
																		@endforeach
																		@if($prod->product_id == 0)
																		<span style="color:red;">X</span>
																		@endif
																	</a>
																</td>
																<td>
																	<a href="/news/{{$prod->item_id}}">
																		@php
																		$news = App\News::where('id','=',[$prod->item_id])->get()
																		@endphp
																		@foreach($news as $ns)
																		{{$ns->news_title}}
																		@endforeach
																		@if($prod->product_id == 0)
																		<span style="color:red;">X</span>
																		@endif
																	</a>
																</td>
																<td>
																{{$prod->time}} days
																</td>
																<td>

																	{{$prod->created_at->diffForHumans()}}

																</td>
																<td>
																		<!-- delete button -->
																	<a href=""  data-toggle="modal" data-target="#posterdelete-{{$prod->id}}" class="btn btn-danger">
																		<i class="icon-remove icon-white"></i></a>

																		<div class="modal fade" id="posterdelete-{{$prod->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
																		<div class="modal-dialog" >
																			<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
																				<div class="modal-header" style="background-color:white;">
																					Are you sure to delete this poster?
																				</div>
																					<div class="modal-footer">
																							<button type="reset" class="btn btn-danger" data-dismiss="modal">{{trans('app.no')}}</button>
																							<a href="/adm/deleteposter/{{ $prod->id }}" class="btn btn-primary">{{trans('app.yes')}}</a>
																					</div>
																			</div>
																		</div>
																		</div>
																</td>
															</tr>
															@endforeach

											</tbody>
										</table>
							</div><!--/.module-body-->
						</div><!--/.module-->






						<!-- <div class="module">
							<div class="module-head">
								<h3>Boosted Products</h3>
							</div>
							<div class="module-body">
								@if(Session::has('boost_success'))
									<center>
										<div class="col-md-4" style="width:90%;">
											<div class="alert alert-success">
												{{Session::get('boost_success')}}
											</div>
										</div>
									</center>
								@endif
								@if(Session::has('removedboost_success'))
									<center>
										<div class="col-md-4" style="width:90%;">
											<div class="alert alert-success">
												{{Session::get('removedboost_success')}}
											</div>
										</div>
									</center>
								@endif

								<table class="table table-bordered" style="width:95%;margin-left:2.5%;">
														<thead>
															<tr>
																<th style="text-transform:capitalize;">{{ trans('app.seller')}}</th>
																<th style="text-transform:capitalize;">{{ trans('app.productname')}}</th>
																<th style="width:35%;text-transform:capitalize;">{{ trans('app.productfeatures')}}</th>
																<th style="text-transform:capitalize;">{{ trans('app.productdiscount')}}</th>
																<th style="text-transform:capitalize;">{{ trans('app.period')}}</th>
																<th style="text-transform:capitalize;">{{ trans('app.lefttime')}}</th>
																<th style="text-transform:capitalize;">{{ trans('app.boostdate')}}</th>
																<th style="text-transform:capitalize;">{{ trans('app.price')}}</th>
																<th>X</th>
															</tr>
														</thead>
														<tbody>
															@php($total = 0)
															@php($total1=0)
															@foreach($boostedproducts as $boost)
															<tr>
																<td>
																		<a href="{{ route('userprofile',$boost->product_seller)}}">{{$boost->product_seller}}</a>
																</td>
																<td>
																	<a href="{{ route('product_details',$boost->product_id)}}">{{substr($boost->productname,0,50)}}</a>
																</td>
																<td>
																	{{substr($boost->product_features, 0, 100)}}

																</td>
																<td>{{$boost->product_discount}}
																	<br><small style="color:red;font-style: italic;">{{substr((($boost->product_price)-(($boost->product_price)-($boost->product_discount)))*100/($boost->product_price),0,4)}}% off</small>
																</td>
																<td>
																{{$boost->boost_period}} days
																</td>
																<td>
																	@php
																	$dt = new DateTime();
																	@endphp
																	{{($boost->boost_period)-$dt->format('d')}}
																</td>
																<td>
																	{{$boost->created_at}}
																</td>
																<td>
																	@if(($boost->product_currency)==1)
									                {{$boost->product_price}}AZN
									                @elseif(($boost->product_currency)==2)
									                ${{$boost->product_price}}
									                @else(($boost->product_currency)==3)
									                {{$boost->product_price}}€
									                @endif

																</td>
																<td>
																		<a href=""  data-toggle="modal" data-target="#boostdelete-{{$boost->id}}" class="btn btn-danger">
																			<i class="icon-remove icon-white"></i></a>

																			<div class="modal fade" id="boostdelete-{{$boost->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
																			<div class="modal-dialog" >
																				<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
																					<div class="modal-header" style="background-color:white;">
																						Are you sure to delete this poster?
																					</div>
																						<div class="modal-footer">
																								<button type="reset" class="btn btn-danger" data-dismiss="modal">{{trans('app.no')}}</button>
																								<a href="/adm/removeboost/{{ $boost->id }}" class="btn btn-primary">{{trans('app.yes')}}</a>
																						</div>
																				</div>
																			</div>
																			</div>
																</td>
															</tr>
															@endforeach

											</tbody>
										</table>
							</div>
						</div> -->
						<!--/.module-->

					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	@endsection
