@extends('admin.adminmaster')


@section('navbar')
<title>{{ trans('app.unverifiedcomments')}}</title>
	<div class="wrapper">
		<div class="container">
			<div class="row">


				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3 style="text-transform:capitalize;">{{ trans('app.unverifiedcomments')}} - <i><a href="/verified">{{ trans('app.verifiedcomments')}}</a> </i></h3>
							</div>
							<div class="module-body table">
								@if(Session::has('newcommentrejected'))
									<center>
										<div class="col-md-4" style="width:90%;">
											<div class="alert alert-danger">
												{{Session::get('newcommentrejected')}}
											</div>
										</div>
									</center>
								@endif
								@if(Session::has('newcommentconfirmed'))
									<center>
										<div class="col-md-4" style="width:90%;">
											<div class="alert alert-success">
												{{Session::get('newcommentconfirmed')}}
											</div>
										</div>
									</center>
								@endif
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" >
									<thead>
										<tr>
											<th style="text-transform:capitalize">{{ trans('app.commenter_name')}}</th>
											<th style="text-transform:capitalize">{{ trans('app.comment')}}</th>
											<th style="text-transform:capitalize">{{ trans('app.post')}}/{{ trans('app.news')}}</th>
											<th style="text-transform:capitalize">{{ trans('app.date')}}</th>
											<th>X</th>
										</tr>
									</thead>
									<tbody>
										@php
										$newscomment = App\Newscomment::where('verify','=',0)->orderBy('created_at','desc')->get()
										@endphp
										@foreach($newscomment as $nsc)
										<tr class="odd gradeX">
											<td> {{$nsc->name}} {{$nsc->surname}}</td>
											<td>{{substr(($nsc->message),0,50)}}
												@if(strlen($nsc->message) > 50)
												...
												@endif
											</td>
											<td>
												@php
												$ne = App\News::where('id','=',[$nsc->news_id])->get()
												@endphp
												@if($nsc->news_id != 0)
												@foreach($ne as $ne)
														<a href="/news/{{$nsc->news_id}}" style="color:green;"> {{substr(($ne->news_title),0,50)}}
														@if(strlen($ne->news_title) > 50)
	 													 ...
	 													@endif </a>
												@endforeach
												@endif

												@php
												$prodd = App\ProductDetails::where('id','=',[$nsc->product_id])->get()
												@endphp
												@if($nsc->news_id == 0)
												@foreach($prodd as $p)
												 <a href="/product_details/{{$nsc->product_id}}" style="color:red;"> {{substr(($p->productname),0,50)}}
													@if(strlen($p->productname) > 50)
													 ...
													@endif</a>
												@endforeach
												@endif



											</td>
											<td>
												{{$nsc->created_at->diffForHumans()}}
											</td>
											<td>
												<button class="btn btn-primary" data-toggle="modal" data-target="#more-{{$nsc->id}}" style="text-transform:capitalize;"> {{ trans('app.more')}}</button>&nbsp;
												<!-- <button class="btn btn-primary" data-toggle="modal" data-target="#confirm-{{$nsc->id}}">Confirm</button> -->
												<!-- <button class="btn btn-danger" data-toggle="modal" data-target="#reject-{{$nsc->id}}">Reject</button> -->





												<!-- MORE POPUP -->
												<div class="modal fade" id="more-{{$nsc->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
												<div class="modal-dialog" >
													<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
														<div class="modal-header" style="background-color:white;">
															Comment <i><span style="color:gray;">By {{$nsc->name}} {{$nsc->surname}}</span></i>
														</div>
														<div class="modal-body" style="background-color:white;color:black;">
															<p>{{$nsc->message}}</p>

														</div>
															<div class="modal-footer">
																<form class="" action="/adm/verifynewscomment/{{$nsc->id}}" method="post">
																	{{csrf_field()}}
																	<input type="hidden" name="verify" value="1">
																	<button type="reset" class="btn btn-success" data-dismiss="modal">Cancel</button>
																	<button type="submit" class="btn btn-primary">Confirm</button>

																	<a href="/adm/rejectnewscomment/{{$nsc->id}}" class="btn btn-danger">Reject</a>
																</form>

															</div>
													</div>
												</div>
												</div>

											</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr>
											<th style="text-transform:capitalize">{{ trans('app.commenter_name')}}</th>
											<th style="text-transform:capitalize">{{ trans('app.comment')}}</th>
											<th style="text-transform:capitalize">{{ trans('app.post')}}/{{ trans('app.news')}}</th>
											<th style="text-transform:capitalize">{{ trans('app.date')}}</th>
											<th>X</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

@endsection
