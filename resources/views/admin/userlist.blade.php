@extends('admin.adminmaster')


@section('navbar')
<title>{{ trans('app.userlist')}}</title>


	<div class="wrapper">
		<div class="container">
			<div class="row">


				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>User List</h3>
							</div>
							<div class="module-body table" >
								@if(Session::has('userdeleted'))
									<center>
										<div class="col-md-4" style="width:90%;">
											<div class="alert alert-success">
												{{Session::get('userdeleted')}}
											</div>
										</div>
									</center>
								@endif
								@if(Session::has('adminsucc'))
									<center>
										<div class="col-md-4" style="width:90%;">
											<div class="alert alert-success">
												{{Session::get('adminsucc')}}
											</div>
										</div>
									</center>
								@endif
								@if (Route::has('login'))
								@if (Auth::check())
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" >
									<thead>
										<tr style="font-size:14px;">
											<th style="text-transform:capitalize;">{{ trans('app.name')}}/<br>{{trans('app.surname')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.position')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.email')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.gender')}}</th>
											@if((Auth::user()->role_id)==4)
											<th>x</th>
											@endif
										</tr>
									</thead>
									<tbody>
										@foreach($user as $user)
										<tr class="odd gradeX" style="font-size:14px;">
											<th><a href="">{{$user->name}} {{$user->surname}}</a></th>
											@if(($user->role_id)==1)
											<th>S.İ.</th>
											@elseif(($user->role_id)==2)
											<th style="color:blue;">3.A.</th>
											@elseif(($user->role_id)==3)
											<th style="color:green;">2.A.</th>
											@elseif(($user->role_id)==4)
											<th style="color:red;">1.A.</th>
											@endif
											<th>{{$user->email}}</th>
											@if(($user->gender)==1)
											<th>{{ trans('app.male')}}</th>
											@else
											<th>{{ trans('app.female')}}</th>
											@endif
											<!-- <th>{{$user->country}}/{{$user->city}}</th> -->

											@if((Auth::user()->role_id)==4)
											<th><a class="btn btn-danger" data-toggle="modal" data-target="#basicModal-{{$user->id}}"  style="text-transform:capitalize;">{{ trans('app.delete')}}</a>	<br>	<br>
												<a href="/adm/registeradmin/{{ $user->id }}" class="btn btn-success" style="text-transform:capitalize;">{{ trans('app.assign')}}</a>

										<div class="modal fade" id="basicModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
											<div class="modal-dialog" >
												<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
													<div class="modal-header" style="background-color:white;">
														 <i>{{$user->name}}</i>, silməkdə əminsinizmi?
													</div>
														<div class="modal-footer">
																<button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
																<a href="/adm/userdelete/{{ $user->id }}" class="btn btn-primary">Yes</a>
														</div>
												</div>
											</div>
											</div>

											</th>
											@endif
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr style="font-size:14px;">
											<!-- <th>User</th> -->
											<!-- <th>ID</th> -->
											<th style="text-transform:capitalize;">{{ trans('app.name')}}/<br>{{trans('app.surname')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.position')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.email')}}</th>
											<th style="text-transform:capitalize;">{{ trans('app.gender')}}</th>
											<!-- <th>Countr/City</th> -->

											@if((Auth::user()->role_id)==4)
											<th>x</th>
											@endif

										</tr>
									</tfoot>
								</table>
								@endif
								@endif
							</div>
						</div><!--/.module-->

					<br />

					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->


@endsection
