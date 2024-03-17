@extends('admin.adminmaster')


@section('navbar')

	<div class="wrapper">

        <!-- Large modal -->
		<div class="container">
			<div class="row">


				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Add a Product to store</h3>
							</div>


							<div class="module-body">

									<!-- <div class="alert">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>Warning!</strong> Something fishy here!
									</div>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>Oh snap!</strong> Whats wrong with you?
									</div>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>Well done!</strong> Now you are listening me :)
									</div> -->

									<br />


									@if(Session::has('success'))
										<center>
											<div class="col-md-4" style="width:90%;">
												<div class="alert alert-success">
													{{Session::get('success')}}
												</div>
											</div>
										</center>
									@endif
									@if (Route::has('login'))


									<form class="form-horizontal row-fluid" action="/adm/addproduct" method="post">
										@if (Auth::check())

										<div class="">
											<div class="controls">
												<input class="span8" type="hidden" id="seller" name="seller" value="{{Auth::user()->id}}">
											</div>
										</div>
										@endif

										<div class="control-group">
											<label class="control-label" for="category">Category</label>
											<div class="controls">
												<select class="category" name="cat_name" id="cat_id" required="">
													<option value="0" disabled="true" selected="true">Select</option>
													@foreach($category as $cat)
														<option value="{{$cat->id}}">{{$cat->name}}</option>
													@endforeach
												</select>
													<select class="name" name="subcategory_name" id="cat_id" required>
														<option value="0" disabled="true" selected="true">Select</option>
													</select>
											</div>
										</div>


										<div class="control-group">
											<label class="control-label" for="productname">Product Name</label>
											<div class="controls">
												<input type="text" id="basicinput" placeholder="Type name here..." class="span8" name="productname" required="">
												<!-- <span class="help-inline">Minimum 5 Characters</span> -->
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="quantity">Quantity</label>
											<div class="controls">
												<div class="input-prepend">
													<input class="span8" name="quantity" type="number" placeholder="quantity" required>
												</div>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="pr">Price</label>
											<div class="controls">
												<div class="input-append">
													<input type="number" placeholder="1.000" class="span8" name="price" required="">
													<!-- <span class="add-on">
													</span> -->


											<select class="" name="currency" style="width:70px;" required="">
																	<option value="1">AZN</option>
																	<option value="2">$</option>
																	<option value="3">€</option>
											</select></div>
								      </div></div>


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
	 									 <div class="controls">

	 								 <table class="table table-bordered" style="width:80%;">
	 								 				<tbody>
														<!-- header -->
	 								 				<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
														<!-- body -->
	 								 				<tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">
	 													<input type="text" placeholder="Brand" class="span8" style="width:100%;" name="brand"><span class="add-on">
	 												</td></tr>
	 								 				<!-- <tr class="techSpecRow"><td class="techSpecTD1">Model:</td><td class="techSpecTD2">
	 													<input type="text" placeholder="Model" class="span8" style="width:100%;" name="Model"><span class="add-on"></td></tr> -->
	 								 				<tr class="techSpecRow"><td class="techSpecTD1">Released on:</td><td class="techSpecTD2">
	 													<input type="date" placeholder="Release date" class="span8" style="width:100%;" name="releasedate"><span class="add-on">
	 												</td></tr>
	 								 				<tr class="techSpecRow"><td class="techSpecTD1">Dimensions:</td><td class="techSpecTD2">
	 													<input type="text" placeholder="Dimension" class="span8" style="width:100%;" name="dimension"><span class="add-on">
	 												</td></tr>
	 								 				<tr class="techSpecRow"><td class="techSpecTD1">Features:</td><td class="techSpecTD2">
	 													<input type="text" placeholder="Features" class="span8" style="width:100%;" name="features" required=""><span class="add-on">
	 												</td></tr>
	 								 				</tbody>
	  							  </table>
	 							</div></div>
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
										<label class="control-label" for="basicinput">Select image to upload</label>
										<div class="controls">
									 <input type="file" name="images" id="fileToUpload">
								 </div>
									 <!-- <input type="submit" value="Upload Image" name="submit"> -->
								 </div>


										<div class="control-group">
											<div class="controls">

												<input type="hidden" name="_token" value="{{ csrf_token() }}">


												<button type="submit" class="btn btn-success" style="float:right">Submit Form</button>
											</div>
										</div>
									</form>
									@endif
							</div>


						</div>
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div>
		<!--/.container-->
	</div><!--/.wrapper-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','.category', function(){
      var cate_id=$(this).val();
      // console.log(cate_id);
      var div=$(this).parent();
      var op="";
      $.ajax({
        type:'get',
        url:'{!!URL::to('getdatabyajax')!!}',
        data:{'id':cate_id},
        success:function(data){
          op+='<option value="0" selected disabled>Choose A Category</option>';
          for(var i=0;i<data.length;i++){
            op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                }
            div.find('.name').html(" ");
            div.find('.name').append(op);
        },
        error:function(){
					console.log('error');

        }
      });
    });
		$("#submit").click(function(){
			var a =$(this).parent();
			var subcatname = a.find('.name').val();
			$.ajax({
				type:'get',
				url:'{!!URL::to('addproduct')!!}',
				data:{'subcategory_name':subcatname},
				dataType:'json',
				success:function(data){
					console.log("done!")
				},
				error:function(){

				}
			});
		});
  });
</script>

@endsection
