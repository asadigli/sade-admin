@extends('admin.adminmaster')


@section('navbar')
<title>{{ trans('app.location')}}</title>

<script src="///ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">

</script>
	<div class="wrapper">
		<div class="container">
			<div class="row">


				<div class="span9">
					<div class="content">
									<div class="col-md-6">
										<!-- Custom Tabs -->
										<div class="nav-tabs-custom">
											<div class="module">
											<div class="module-head">
											<ul class="nav nav-tabs">
												<li class="active"><a href="#tab_1" data-toggle="tab">Country</a></li>
												<li><a href="#tab_2" data-toggle="tab">City</a></li>
												<li><a href="#tab_3" data-toggle="tab">Phonecode</a></li>
												<li class="dropdown">
													<a class="dropdown-toggle" data-toggle="dropdown" href="#">
														Dropdown <span class="caret"></span>
													</a>
													<ul class="dropdown-menu">
														<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
														<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
														<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
														<li role="presentation" class="divider"></li>
														<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
													</ul>
												</li>
												<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
											</ul>
										</div>
										</div>
											<div class="tab-content">
												<div class="tab-pane active" id="tab_1">
													 <!-- country list -->
													 <div class="card-block">
														 <div class="module">
															 <div class="module-head">
																 <h3>Add Country</h3>
															 </div>
															 <div class="module-body">
																	 <br />
																	 @if(Session::has('country_add'))
																		 <center>
																			 <div class="col-md-4" style="width:90%;">
																				 <div class="alert alert-success">
																					 {{Session::get('country_add')}}
																				 </div>
																			 </div>
																		 </center>
																	 @endif

																	 <!-- I have an error here -->
																	 <form class="form-horizontal row-fluid" action='/adm/addcountryname' method="post">
																		 <div class="control-group">
																			 <label class="control-label" for="name">Country Name</label>
																			 <div class="controls">
																				 {{ csrf_field() }}

																				 <input type="text" id="name" name="name" placeholder="Type country name here..." class="span8" required="">
																				 <input type="hidden" name="_token" value="{{csrf_token()}}">
																				 <br><br>
																				 <input type="submit" name="submit" value="Add" class="btn btn-primary">
																			 </div>
																		 </div>
																	 </form>
															 </div>
															 <div class="module">
																 <div class="module-head">
																	 <h3>Country List</h3>
																 </div>
																 <div class="module-body table" >
																	 <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" >
																		 <thead>
																			 <tr style="font-size:14px;">
																				 <th>Country ID</th>
																				 <th>Country Name</th>
																				 @if((Auth::user()->role_id)==4)
																				 <th>x</th>
																				 @endif
																			 </tr>
																		 </thead>
																		 <tbody>
																		 @php
																		 $ct = App\Country::all()
																		 @endphp
																			 @foreach($ct as $ct)
																			 <tr class="odd gradeX" style="font-size:14px;">
																				 <th>{{$ct->id}}</th>
																				 <th>{{$ct->name}}</th>
																				 @if((Auth::user()->role_id)==4)
																				 <th><a class="btn btn-danger" data-toggle="modal" data-target="#Modal-{{$ct->id}}">Delete</a>	<br>	<br>

																				 <div class="modal fade" id="Modal-{{$ct->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
																				 <div class="modal-dialog" >
																					 <div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
																						 <div class="modal-header" style="background-color:white;">
																							 Are you sure to delete <i>{{$ct->name}}</i>?
																						 </div>
																							 <div class="modal-footer">
																									 <button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
																									 <a href="" class="btn btn-primary">Yes</a>
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
																				 <th>Country ID</th>
																				 <th>Country Name</th>
																				 @if((Auth::user()->role_id)==4)
																				 <th>x</th>
																				 @endif
																			 </tr>
																		 </tfoot>
																	 </table>
																 </div>
															 </div><!--/.module-->

														 </div>
														 </div>


												</div>
												<!-- /.tab-pane -->
												<div class="tab-pane" id="tab_2">
													 <!-- city list -->
													 <div class="card-block">
														 <div class="module">
															 <div class="module-head">
																 <h3>Add City</h3>
															 </div>
															 <div class="module-body">
																	 <br />
																 @if(Session::has('city_add'))
																	 <center>
																		 <div class="col-md-4" style="width:90%;">
																			 <div class="alert alert-success">
																				 {{Session::get('city_add')}}
																			 </div>
																		 </div>
																	 </center>
																 @endif
																	 <form class="form-horizontal row-fluid" action='/adm/addcityname' method="post">
																		 <div class="control-group">
																			 <label class="control-label" for="name">Country Name</label>

																			 <div class="controls">
																				 {{ csrf_field() }}
																				 <!-- <label class="control-label">Parent Category</label><br> -->

																				 <select class="country_id" name="country_id" id="country_id" placeholder="City" required="">
																								 <option value="" name="country_id">Choose Country</option>
																							 @foreach($country as $cont)
																								 <option value="{{$cont->id}}" name="country_id">{{$cont->name}}</option>
																							 @endforeach
																				 </select>
																			 </div><br>
																			 <label class="control-label" for="name">City Name</label>
																			 <div class="controls">
																				 <!-- <label class="control-label" for="name">Add SubCategory</label><br> -->
																				 <input type="text" id="subname" name="name" placeholder="Type city name here..." class="subname span8" required="">

																				 <input type="hidden" name="_token" value="{{csrf_token()}}">
																				 <br><br>
																				 <input type="submit" name="submit" value="Add" class="btn btn-primary">
																			 </div>
																		 </div>
																	 </form>
															 </div>
															 <div class="module">
																 <div class="module-head">
																	 <h3>City List</h3>
																 </div>
																 <div class="module-body table" >
																	 <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" >
																		 <thead>
																			 <tr style="font-size:14px;">
																				 <th>Country ID</th>
																				 <th>Country Name</th>
																				 <th>Country Name</th>
																				 @if((Auth::user()->role_id)==4)
																				 <th>x</th>
																				 @endif
																			 </tr>
																		 </thead>
																		 <tbody>
																		 @php
																		 $city = App\City::all()
																		 @endphp
																			 @foreach($city as $ct)
																			 <tr class="odd gradeX" style="font-size:14px;">
																				 <th>{{$ct->id}}</th>
																				 <th>{{$ct->name}}</th>
																				 <th>
																				 @php
																				 $country = App\Country::all()
																				 @endphp
																				 @foreach($country as $cty)
																				 @if(($ct->country_id)==($cty->id))
																				 {{$cty->name}}
																				 @endif
																				 @endforeach
																				 </th>
																				 @if((Auth::user()->role_id)==4)
																				 <th><a class="btn btn-danger" data-toggle="modal" data-target="#Modalcity-{{$ct->id}}">Delete</a>	<br>	<br>

																				 <div class="modal fade" id="Modalcity-{{$ct->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
																				 <div class="modal-dialog" >
																					 <div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
																						 <div class="modal-header" style="background-color:white;">
																							 Are you sure to delete <i>{{$ct->name}}</i>?
																						 </div>
																							 <div class="modal-footer">
																									 <button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
																									 <a href="" class="btn btn-primary">Yes</a>
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
																				 <th>City ID</th>
																				 <th>City Name</th>
																				 <th>Country Name</th>
																				 @if((Auth::user()->role_id)==4)
																				 <th>x</th>
																				 @endif
																			 </tr>
																		 </tfoot>
																	 </table>
																 </div>
															 </div><!--/.module-->
														 </div>
														</div>


												</div>
												<!-- /.tab-pane -->
												<div class="tab-pane" id="tab_3">
														<!-- phone code part -->
											      <div class="card-block">
															<div class="module">
																<div class="module-head">
																	<h3>Add PhoneCode</h3>
																</div>
																<div class="module-body">
																		<br />
																	@if(Session::has('phonecode_add'))
																		<center>
																			<div class="col-md-4" style="width:90%;">
																				<div class="alert alert-success">
																					{{Session::get('phonecode_add')}}
																				</div>
																			</div>
																		</center>
																	@endif
																		<form class="form-horizontal row-fluid" action='/adm/addphonecode' method="post">
																			<div class="control-group">
																				<label class="control-label" for="name">Country Name</label>

																				<div class="controls">
																					{{ csrf_field() }}
																					<select class="country_id" name="country_id" id="country_id" placeholder="Category" required="Choose a category">
																									<option value="" name="country_id">Choose Country</option>
																									@foreach($country as $cont)
																										<option value="{{$cont->id}}" name="country_id">{{$cont->name}}</option>
																									@endforeach
																					</select>
																				</div>
																				<br>
																				<label class="control-label" for="name">Phonecode</label>

																				<div class="controls">
																					<!-- <h4 for="subname">SubCategory Name</h4><br> -->
																					<input type="text" id="subname" name="name" placeholder="Type phonecode here..." class="subname span8" required="">
																					<input type="hidden" name="_token" value="{{csrf_token()}}">
																					<br><br>
																					<input type="submit" name="submit" value="Add" class="btn btn-primary">
																				</div>
																			</div>
																		</form>
																</div>
																<div class="module">
																	<div class="module-head">
																		<h3>Phonecode List</h3>
																	</div>
																	<div class="module-body table" >
																		<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" >
																			<thead>
																				<tr style="font-size:14px;">
																					<th>PhoneCode ID</th>
																					<th>PhoneCode</th>
																					<th>Country Name</th>
																					@if((Auth::user()->role_id)==4)
																					<th>x</th>
																					@endif
																				</tr>
																			</thead>
																			<tbody>
																			@php
																			$phonecode = App\Phonecode::all()
																			@endphp
																				@foreach($phonecode as $ph)
																				<tr class="odd gradeX" style="font-size:14px;">
																					<th>{{$ph->id}}</th>
																					<th>{{$ph->name}}</th>
																					<th>
																					@php
																					$country = App\Country::all()
																					@endphp
																					@foreach($country as $cty)
																					@if(($ph->country_id)==($cty->id))
																					{{$cty->name}}
																					@endif
																					@endforeach
																					</th>
																					@if((Auth::user()->role_id)==4)
																					<th><a class="btn btn-danger" data-toggle="modal" data-target="#Modalphonecode-{{$ph->id}}">Delete</a>	<br>	<br>

																					<div class="modal fade" id="Modalphonecode-{{$ph->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
																					<div class="modal-dialog" >
																						<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
																							<div class="modal-header" style="background-color:white;">
																								Are you sure to delete <i>{{$ph->name}}</i>?
																							</div>
																								<div class="modal-footer">
																										<button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
																										<a href="" class="btn btn-primary">Yes</a>
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
																					<th>PhoneCode ID</th>
																					<th>PhoneCode</th>
																					<th>Country Name</th>
																					@if((Auth::user()->role_id)==4)
																					<th>x</th>
																					@endif
																				</tr>
																			</tfoot>
																		</table>
																	</div>
																</div><!--/.module-->

															</div>
											    	</div>


												</div>
												<!-- /.tab-pane -->
											</div>
											<!-- /.tab-content -->
										</div>
										<!-- nav-tabs-custom -->

								</div>
						</div>
					</div>
					<!--/.content-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->
<script type="text/javascript">
$(document).ready(function(e) {
    $(".btnclink").click(function(e) {
         $(".btnclink").removeClass("btn-danger");
         $(this).addClass("btn-danger");
         var target = $(this).data("target");

          var acpanels = $("#accordion-home").find(".panel-collapse.in").not(target);
          acpanels.collapse("hide");
          $(target).collapse("show");
    });
});

</script>
@endsection
