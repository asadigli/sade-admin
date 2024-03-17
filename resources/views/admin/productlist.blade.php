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
								<h3>{{ trans('app.productlist')}} <a href="/adm/sellproduct" style="float:right;">{{ trans('app.sellproduct')}}</a></h3>
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
											<!-- <th style="text-transform:capitalize;">Category/<br>Subcategory</th> -->
											<th style="text-transform:capitalize;">{{ trans('app.productid')}}</th>
											<th style="text-transform:capitalize;">Rating</th>
											<th style="width:60px;text-transform:capitalize;">{{ trans('app.product')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.price')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.time')}}</th>
											<th><center>X</center></th>
										</tr>
									</thead>
									<tbody>
										@foreach($productdetails as $prodet)
										<tr class="odd gradeX" style="font-size:11px;">
											<td>{{$prodet->main_id}}</td>

												<td>


													@php
				                   $star_1 = App\Newscomment::where('news_id','=',0)->where('product_id','=',[$prodet->id])->where('verify','=',1)->get()
				                  @endphp
				                  @php($total = 0)
				                  @foreach($star_1 as $st)
				                   @php($total += $st->rating)
				                  @endforeach
				                  @if(count($star_1) != 0)
				                      <b style="color:gray;">{{substr($total/(count($star_1)),0,3)}}</b>
				                       <i class="fa fa-star" style="color:orange;"></i> / {{count($star_1)}}
				                  @else
				                    0 <i class="fa fa-star-o" style="color:orange;"></i>
				                  @endif

												</td>

												<td><u><a href="/product_details/{{$prodet->productname}}">{{$prodet->productname}}</a></u></td>
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

											<td>{{$prodet->created_at->toFormattedDateString()}}</td>
											<td><a href="/productedit/{{$prodet->id}}"  class="btn btn-success">{{ trans('app.edit')}}</a>
												<br><br><a class="btn btn-danger"  data-toggle="modal" data-target="#basicModal-{{$prodet->id}}">{{ trans('app.delete')}}</a>
												<br><br>
													<!-- <a href="#"  class="btn btn-primary" data-toggle="modal" data-target="#basicModalboost-{{$prodet->id}}" style="text-transform:capitalize;">{{ trans('app.boost')}}</a> -->


												<div class="modal fade" id="basicModal-{{$prodet->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
												<div class="modal-dialog" >
													<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
														<div class="modal-header" style="background-color:white;">
															Are you sure to delete <i>{{$prodet->productname}}</i>?
														</div>
															<div class="modal-footer">
																	<button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
																	<a href="/adm/del/{{ $prodet->id }}"  class="btn btn-primary">Yes</a>
															</div>
													</div>
												</div>
												</div>

											</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr style="font-size:11px;">
											<th style="text-transform:capitalize;">{{ trans('app.productid')}}</th>
											<!-- <th style="text-transform:capitalize;">Category/<br>Subcategory</th> -->
											<th style="text-transform:capitalize;">Rating</th>
											<th style="width:60px;text-transform:capitalize;">{{ trans('app.product')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.price')}}</th>
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
