@extends('admin.adminmaster')


@section('navbar')
<title>{{ trans('app.about')}}</title>

	<div class="wrapper">

        <!-- Large modal -->
		<div class="container">
			<div class="row">
				<div class="span9">
						<!--content-->
						<div class="content">

							<div class="module">
								<div class="module-head">
									<h3>Haqqında bölməsi</h3>
								</div>
								<div class="module-body">
															<form class="form-horizontal row-fluid" action="/" method="post">
																	<div class="control-group">
																	<label class="control-label" for="productname">Product Name</label>
																	<div class="controls">
																		<input type="text" id="basicinput" placeholder="Type name here..." class="span8" name="productname" required="">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label">Condition</label>
																	<div class="controls">
																		<select class="" name="condition" required="">
																			<option value="1">New</option>
																			<option value="2">Used</option>
																		</select>
																	</div>
																</div>
																	<div class="control-group">
																		<label class="control-label" for="descriptionname">Decsription title</label>
																		<div class="controls">
																			<input type="text" id="basicinput" placeholder="Type title here..." class="span8" name="descriptionname">
																			<!-- <span class="help-inline">Minimum 5 Characters</span> -->
																		</div>
																	</div>
																<div class="control-group">
																	<label class="control-label" for="description">Description</label>
																	<div class="controls">
																		<textarea class="span8" rows="5" name="description"></textarea>
																	</div>
																</div><br>




																  <div id="demo" class="collapse">
																		<div class="control-group">
								 												<label class="control-label" for="descriptionname2">Second Description title</label>
								 												<div class="controls">
								 													<input type="text" placeholder="Description title" class="span8" style="width:50%;" name="descriptionname2">

								 												</div>
								 										</div>
								 										<div class="control-group">
								 											<label class="control-label" for="description2">Second Description</label>
								 											<div class="controls">
								 												<textarea class="span8" rows="5" name="description2"></textarea>
								 											</div>
								 										</div>

																  </div><br>
																	<a style="margin-left:70%;" type="button" id="one" class="" data-toggle="collapse" data-target="#demo">More option</a>
																	<br>
																<div class="control-group">
																	<div class="controls">

																		<input type="hidden" name="_token" value="{{ csrf_token() }}">

																		<button type="submit" class="btn btn-success" style="float:right">Submit Form</button>
																	</div>
								</div>
							</form>
					</div>
				</div>
			</div>
				</div><!--/.span9-->
			</div>
		</div>

	</div><!--/.wrapper-->


@endsection
