@extends('admin.adminmaster')

@section('navbar')
<title>{{ trans('app.vipcomments')}}</title>

	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Poster Products Photos</h3>
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
							@if(Session::has('vipcommentdeleted'))
							<br>
								<center>
									<div class="col-md-4" style="width:90%;">
										<div class="alert alert-danger">
											{{Session::get('vipcommentdeleted')}}
										</div>
									</div>
								</center>
							@endif
							<div class="module-body">
								<table class="table table-bordered" style="width:95%;margin-left:2.5%;">
										<thead>
											<tr>
												<th  style="text-transform:capitalize;">{{ trans('app.comment')}}</th>
												<th  style="text-transform:capitalize;">{{ trans('app.commenter')}}</th>
												<th  style="text-transform:capitalize;">{{ trans('app.date')}}</th>
												<th>X</th>
											</tr>
										</thead>
										<tbody>
											@php
											$vp = App\VipComments::all()
											@endphp
											@foreach($vp as $vp)
										<tr>
											<td>{{$vp->message}}</td>
											<td>{{ $vp->name}} {{$vp->surname}}</td>
											<td>{{$vp->created_at}}</td>
											<td><a  class="btn btn-danger" data-toggle="modal" data-target="#vip-{{$vp->id}}">X</a> </td>

											<div class="modal fade" id="vip-{{$vp->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
											<div class="modal-dialog" >
												<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
													<div class="modal-header" style="background-color:white;">
														Comment <i><span style="color:gray;">By {{$vp->name}} {{$vp->surname}}</span></i>
													</div>
													<div class="modal-body" style="background-color:white;color:black;">
														<p>{{$vp->message}}</p>

													</div>
														<div class="modal-footer">
																<button type="reset" class="btn btn-success" data-dismiss="modal">{{ trans('app.cancel')}}</button>
																<a href="/adm/deletevipcomment/{{$vp->id}}" class="btn btn-danger">{{ trans('app.delete')}}</a>
														</div>
												</div>
											</div>
											</div>
											</tr>
											@endforeach

										</tbody>
										</table>
							</div><!--/.module-body-->
						</div>

					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	@endsection
