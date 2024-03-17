@extends('admin.adminmaster')


@section('navbar')
<title>{{ trans('app.categorycreation')}}</title>

<script src="///ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">

</script>
	<div class="wrapper">
		<div class="container">
			<div class="row">


				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Add Category</h3>
							</div>
							<div class="module-body">
									<br />
									@if(Session::has('succ'))
										<center>
											<div class="col-md-4" style="width:90%;">
												<div class="alert alert-success">
													{{Session::get('succ')}}
												</div>
											</div>
										</center>
									@endif

									<!-- I have an error here -->
									<form class="form-horizontal row-fluid" action='/adm/cat' method="post">
										<div class="control-group">
											<label class="control-label" for="name">Category Name</label>
											<div class="controls">
												{{ csrf_field() }}

												<input type="text" id="catlist" name="name" placeholder="Type category name here..." class="span8" required="" maxlength="60" minlength="3">
												<br><br><span class="help-inline" style="color: red; font-size: 10px;"><i>* Minimum 3 Characters</i></span>
												<br><br>
												<input type="submit" name="submit" value="Add" class="btn btn-success">
											</div>
										</div>
									</form>
							</div>
						</div>


						<div class="module">
							<div class="module-head">
								<h3>Add Sub-Category</h3>
							</div>
							<div class="module-body">
									<br />

														@if(Session::has('succes'))
															<center>
																<div class="col-md-4" style="width:90%;">
																	<div class="alert alert-success">
																		{{Session::get('succes')}}
																	</div>
																</div>
															</center>
														@endif

									<form class="form-horizontal row-fluid" action='/adm/subcat' method="post">
										<div class="control-group">

											<div class="controls">
												{{ csrf_field() }}
												<!-- <label class="control-label">Parent Category</label><br> -->
												<br>
												<h4>Parent Category Name</h4><br>

												<select class="parent_id" name="parent_id" id="parent_id" placeholder="Category" required="Choose a category">
																<option value="">Choose Category</option>
														@foreach($category as $cat)
																<option value="{{$cat->id}}">{{$cat->name}}</option>
														@endforeach
												</select><br><br>
												<!-- <label class="control-label" for="name">Add SubCategory</label><br> -->
												<h4 for="subname">SubCategory Name</h4><br>
												<input type="text" id="subname" name="subname" placeholder="Type sub-category name here..." class="subname span8" required="">
												<br><br><span class="help-inline" style="color: red; font-size: 10px;"><i>* Minimum 3 Characters</i></span><br>
												<br><br>
												<input type="submit" name="submit" value="Add" class="btn btn-success">
											</div>
										</div>
									</form>
							</div>
						</div>
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

@endsection
