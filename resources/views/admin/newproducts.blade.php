@extends('admin.adminmaster')


@section('navbar')
<title>{{ trans('app.productlist')}}</title>

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="span9">
					<div class="content">
						<div class="module">
							<div class="module-head">
								<h3>{{ trans('app.productlist')}}
									<!-- <a href="/sellproduct" style="float:right;">{{ trans('app.sellproduct')}}</a> -->
								</h3>
							</div>
							<div class="module-body table" >
								@if(Session::has('productdeleted'))
									<center>
										<div class="col-md-4" style="width:90%;">
											<div class="alert alert-success">
												{{Session::get('productdeleted')}}
											</div>
										</div>
									</center>
								@endif
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" >
									<thead>
										<tr style="font-size:11px;">
											<th style="text-transform:capitalize;">Category/<br>Subcategory</th>
											<th style="text-transform:capitalize;">{{trans('app.seller')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.productid')}}</th>
											<th style="width:60px;text-transform:capitalize;">{{ trans('app.product')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.price')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.condition')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.time')}}</th>
											<th><center>X</center></th>
										</tr>
									</thead>
									<tbody>
										@php
										$productdetails = App\ProductDetails::all()
										@endphp
										@foreach($productdetails as $prodet)
										<tr class="odd gradeX" style="font-size:11px;">
											<td>
													@php
														$category = App\Category::all()
													@endphp
													@foreach($category as $cat)
														@if(($cat->id)==($prodet->category_id))
															<b>{{$cat->name}}</b>
														@endif
													@endforeach
													<br>
													@php
														$subcat = App\Subcat::all()
													@endphp
													@foreach($subcat as $sub)
														@if(($sub->id)==($prodet->subcat_id))
															{{$sub->name}}
														@endif
													@endforeach
													{{$prodet->subcat_id}}
												</td>
												@php
													$user = App\User::all()
												@endphp
												@foreach($user as $user)
													@if(($user->id)==($prodet->seller))
														<td><a href="{{ route('userprofile', $user->id)}}">{{$user->name}}<br>{{$user->surname}}</a></td>
													@endif
												@endforeach
												<td>{{$prodet->id}}</td>
												<td><u>
													<a href="#" data-toggle="modal" data-target="#proddetails-{{$prodet->id}}">{{$prodet->productname}}</a>
												</u></td>
												<td class="center">
												@if(empty($prodet->discount))
													@if(($prodet->currency)==1)
														{{$prodet->price}}AZN
													@elseif(($prodet->currency)==2)
														${{$prodet->price}}
													@else(($prodet->currency)==3)
														{{$prodet->price}}EURO
													@endif
												@else
													@if(($prodet->currency)==1)
														{{($prodet->price)-($prodet->discount)}}AZN
													@elseif(($prodet->currency)==2)
														${{($prodet->price)-($prodet->discount)}}
													@else(($prodet->currency)==3)
														{{($prodet->price)-($prodet->discount)}}EURO
													@endif <br>
													<small style="color:red;">{{substr((($prodet->price)-(($prodet->price)-($prodet->discount)))*100/($prodet->price),0,4)}}% off</small>
												@endif

											</td>
											@if(($prodet->condition)==1)
												<td style="color:red;">New</td>
											@elseif(($prodet->condition)==2)
												<td style="color:blue;">Used</td>
											@endif

											<td>{{$prodet->created_at}}</td>
											<td>
												<a class="btn btn-success" data-toggle="modal" data-target="#confirmprod-{{$prodet->id}}">{{ trans('app.confirm')}}</a>
												<br><br>
													<a href="#"  class="btn btn-primary" data-toggle="modal" data-target="#delete-{{$prodet->id}}" style="text-transform:capitalize;">{{ trans('app.delete')}}</a>
													<div class="modal fade" id="confirmprod-{{$prodet->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
													<div class="modal-dialog" >
														<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
															<div class="modal-header">
																{{ trans('app.areyousuretoconfirm')}} <i>{{$prodet->productname}}</i>?
															</div>
															<form class="form-horizontal row-fluid" action="/adm/confirmproduct/{{$prodet->id}}" method="post">
																	<div class="modal-body" style="background-color:white;color:black;">
																		@if($prodet->confirmed==0)
																		<input type="radio" name="confirmed" value="0" checked> Reject
																		<input type="radio" name="confirmed" value="1"> Confirm
																		@elseif($prodet->confirmed==1)
																		<input type="radio" name="confirmed" value="0"> Reject
																		<input type="radio" name="confirmed" value="1" checked> Confirm
																		@endif
																	</div>
																	<div class="modal-footer">
																		<button type="submit" name="submit" class="btn btn-primary">{{ trans('app.change')}}</button>
																	</div>
															</form>
														</div>
													</div>
													</div>

												<div class="modal fade" id="delete-{{$prodet->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
												<div class="modal-dialog" >
													<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
														<div class="modal-header" style="background-color:white;">
															Are you sure to delete <i>{{$prodet->productname}}</i>?
														</div>
														<div class="modal-footer">
																<button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
																<a href="/adm/rejectproduct/{{$prodet->id}}"  class="btn btn-primary">Yes</a>
														</div>
													</div>
												</div>
												</div>

												<!-- <div class="modal fade" id="proddetails-{{$prodet->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
												<div class="modal-dialog" >
													<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
														<div class="modal-header" style="background-color:white;">
															<i>{{$prodet->productname}}</i>
														</div>
															<div class="modal-footer">
																	<button type="reset" class="btn btn-danger" data-dismiss="modal">{{trans('app.close')}}</button>
															</div>
													</div>
												</div>
												</div> -->

											</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr style="font-size:11px;">
											<th style="text-transform:capitalize;">Category/<br>Subcategory</th>
											<th style="text-transform:capitalize;">{{trans('app.seller')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.productid')}}</th>
											<th style="width:60px;text-transform:capitalize;">{{ trans('app.product')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.price')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.condition')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.time')}}</th>
											<th><center>X</center></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div><!--/.module-->

					<br />

					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

@endsection
	<!-- <script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script> -->
