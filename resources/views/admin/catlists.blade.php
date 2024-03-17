@extends('admin.adminmaster')


@section('navbar')
<title>{{ trans('app.catlists')}}</title>
	<div class="wrapper">
		<div class="container">
			<div class="row">


				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>All Categories</h3>
							</div>
							<div class="module-body table">
								@if(Session::has('successmessage_category'))
									<center>
										<div class="col-md-4" style="width:90%;">
											<div class="alert alert-success">
												{{Session::get('successmessage_category')}}
											</div>
										</div>
									</center>
								@endif
								@if(Session::has('category_edited'))
									<center>
										<div class="col-md-4" style="width:90%;">
											<div class="alert alert-success">
												{{Session::get('category_edited')}}
											</div>
										</div>
									</center>
								@endif
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" >
									<thead>
										<tr>
											<th> Category ID</th>
											<th>Category Name</th>
											<th>X</th>
										</tr>
									</thead>
									<tbody>
										@foreach($category as $cat)
										<tr class="odd gradeX">
											<td>{{$cat->id}}</td>
											<td>{{$cat->name}}</td>
											<td><a href=""><button class="btn btn-success" data-toggle="modal" data-target="#CatEdit-{{$cat->id}}">Edit</button></a>&nbsp;
												<a href=""><button class="btn btn-danger" data-toggle="modal" data-target="#Modalcate-{{$cat->id}}">Delete</button></a>


												<div class="modal fade" id="Modalcate-{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
												<div class="modal-dialog" >
													<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
														<div class="modal-header" style="background-color:white;">
															Are you sure to delete <i>{{$cat->name}}</i>?
														</div>
															<div class="modal-footer">
																	<button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
																	<a href="/adm/deletecategory/{{ $cat->id }}" class="btn btn-primary">Yes</a>
															</div>
													</div>
												</div>
												</div>

												<div class="modal fade" id="CatEdit-{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
												<div class="modal-dialog" >
													<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
														<div class="modal-header" style="background-color:white;">
															<span style="text-transform:capitalize;">{{ trans('app.edit_category')}}</span>
														</div>
															<div class="modal-footer">
																<form class="" action="/adm/categoryedit/{{$cat->id}}" method="post">
																	{{ csrf_field() }}
																	<input type="text" name="name" value="{{$cat->name}}">
																	<br>
																	<button type="reset" class="btn btn-danger" data-dismiss="modal">{{ trans('app.reset')}}</button>
																	<button type="submit" class="btn btn-primary" name="submit">{{ trans('app.change')}}</button>
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
											<th>Category ID</th>
											<th>Category Name</th>
											<th>X</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>



						<!--/.module-->
							<!-- subcategories -->
							<div class="module">
								<div class="module-head">
									<h3>All Sub-Categories</h3>
								</div>
								<div class="module-body table">
									@if(Session::has('successmessage_subcat'))
										<center>
											<div class="col-md-4" style="width:90%;">
												<div class="alert alert-success">
													{{Session::get('successmessage_subcat')}}
												</div>
											</div>
										</center>
									@endif
									<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
										<thead>
											<tr>
												<th>SubCategory ID</th>
												<th>SubCategory Name</th>
												<th>Parent Category</th>
												<th>X</th>
											</tr>
										</thead>
										<tbody>
											@foreach($subcat as $sub)
											<tr class="odd gradeX">
												<td>{{$sub->id}}</td>
												<td>{{$sub->name}}</td>
												<td>
												@foreach($category as $cat)
												@if(($sub->parent_id)==($cat->id))
												{{$cat->name}}
												@endif
												@endforeach

											</td>

												<td><button class="btn btn-success">Edit</button>&nbsp;
													<button class="btn btn-danger" data-toggle="modal" data-target="#Modalcat-{{$sub->id}}">Delete</button>

													<div class="modal fade" id="Modalcat-{{$sub->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
													<div class="modal-dialog" >
														<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
															<div class="modal-header" style="background-color:white;">
																Are you sure to delete <i>{{$sub->name}}</i>?
															</div>
																<div class="modal-footer">
																		<button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
																		<a href="/adm/deletesubcat/{{ $sub->id }}" class="btn btn-primary">Yes</a>
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
												<th>SubCategory ID</th>
												<th>SubCategory Name</th>
												<th>Parent Category</th>
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
