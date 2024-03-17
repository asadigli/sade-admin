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
								<h3 style="text-transform:capitalize;">{{ trans('app.edit_product')}}</h3>
							</div>
							<div class="module-body">
									<br />
									@if(Session::has('prod_edited'))
										<center>
											<div class="col-md-4" style="width:90%;">
												<div class="alert alert-success">
													{{Session::get('prod_edited')}}
												</div>
											</div>
										</center>
									@endif

									<!-- I have an error here -->
									<form class="form-horizontal row-fluid" action="/editproduct/{{$productdetails->id}}" method="post" enctype="multipart/form-data">
										{{csrf_field()}}
										@if (Auth::check())
										<div class="">
											<div class="controls">
												<input class="span8" type="hidden" id="seller" name="seller" value="{{Auth::user()->id}}">
											</div>
										</div>
										@endif
										<div class="control-group">
											<label class="control-label" for="productname">{{ trans('app.product_name')}}</label>
											<div class="controls">
												<input type="text" value="{{$productdetails->productname}}" id="basicinput" placeholder="Type name here..." maxlength="150" class="span8" name="productname" maxlength="150" required="">
											</div>
										</div>
										<div class="control-group">
                      <label class="control-label">{{ trans('app.product_id')}}</label>
                      <div class="controls">
                        <input value="{{$productdetails->main_id}}" class="" placeholder="{{ trans('app.product_id')}}" type="text" name="main_id">
                      </div>
                    </div>
										<div class="control-group">
											<label class="control-label" for="quantity">{{ trans('app.quantity')}}</label>
											<div class="controls">
												<div class="input-prepend">
													<input class="span8" value="{{$productdetails->quantity}}" name="quantity" type="number" placeholder="quantity" required>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="basicinput">{{ trans('app.price')}}</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" placeholder="1.000" value="{{$productdetails->price}}" class="span8" name="price" required="">
													<!-- <span class="add-on">
													</span> -->

											<select class="" name="currency" style="width:70px;" required="">
																	<option value="1">AZN</option>
																	<!-- <option value="2">$</option> -->
																	<!-- <option value="3">€</option> -->
											</select></div>
								      </div>
										</div>
										<div class="control-group">
											<label class="control-label" for="discount">{{ trans('app.discountifyouhave')}}</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" placeholder="1.000" value="{{$productdetails->discount}}" class="span8" name="discount">
													<span class="add-on">
														AZN
													</span>
												</div>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">{{ trans('app.condition')}}</label>
											<div class="controls">
												<select class="" name="condition" required="">
													@if($productdetails->condition == 1)
													<option value="1" selected>New</option>
													<option value="2">Used</option>
													@elseif($productdetails->condition == 2)
													<option value="1">New</option>
													<option value="2" selected>Used</option>
													@endif
												</select>
											</div>
										</div>
										<!-- <div class="control-group">
											<label class="control-label" for="country">Country<sup>*</sup></label>
											<div class="controls">
											<select class="country" id="count_id" name="country" required="">
												<option value="all">Global</option>
												@php
												$country = App\Country::all()
												@endphp
												@foreach($country as $count)
													<option value="{{$count->id}}">{{$count->name}}</option>
												@endforeach
											</select>
											<select id="count_id" name="city" class="name" required="">
												<option value="0" disabled="true" selected="true">Select</option>
											</select>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											</div>
										</div> -->
										<!-- <div class="control-group">
											<label class="control-label" for="city" >City<sup>*</sup></label>
											<div class="controls">
											</div>
										</div> -->
										<!-- <div class="control-group">
                      <label class="control-label">{{ trans('app.contact')}}</label>
                      <div class="controls">
                        <input value="{{$productdetails->contact}}" class="" placeholder="Contact here" type="number" name="contact">
                      </div>
                    </div> -->

										<div class="control-group">
	 									 <div class="controls">

	 								 <table class="table table-bordered" style="width:80%;">
	 								 				<tbody>
														<!-- header -->
	 								 				<tr class="techSpecRow"><th colspan="2">{{ trans('app.product_details')}}</th></tr>
														<!-- body -->
	 								 				<tr class="techSpecRow"><td class="techSpecTD1">{{ trans('app.brand')}}: </td><td class="techSpecTD2">
	 													<input type="text" value="{{$productdetails->brand}}" placeholder="Brand" class="span8" style="width:100%;" name="brand" required><span class="add-on">
	 												</td></tr>
	 								 				<!-- <tr class="techSpecRow"><td class="techSpecTD1">Model:</td><td class="techSpecTD2">
	 													<input type="text" placeholder="Model" class="span8" style="width:100%;" name="Model"><span class="add-on"></td></tr> -->
	 								 				<tr class="techSpecRow"><td class="techSpecTD1">{{ trans('app.released_on')}}:</td><td class="techSpecTD2">
	 													<input type="date" placeholder="Release date" class="span8" style="width:100%;" name="releasedate" value="{{$productdetails->releasedate}}"><span class="add-on">
	 												</td></tr>
	 								 				<tr class="techSpecRow"><td class="techSpecTD1">{{ trans('app.dimension')}}:</td><td class="techSpecTD2">
	 													<input type="text" placeholder="Dimension" class="span8" style="width:100%;" name="dimension" value="{{$productdetails->dimension}}"><span class="add-on">
	 												</td></tr>
	 								 				<tr class="techSpecRow"><td class="techSpecTD1">{{ trans('app.features')}}:</td><td class="techSpecTD2">
	 													<input type="text" maxlength="100" placeholder="Features" class="span8" style="width:100%;" name="features" required="" value="{{$productdetails->features}}"><span class="add-on">
	 												</td></tr>
	 								 				</tbody>
	  							  </table>
	 							</div></div>
										<!-- <div class="control-group">
                        <label class="control-label" for="videolink">Youtebe Video Link</label>
                        <div class="controls">
                          <input type="text" id="basicinput" placeholder="Add link here..." class="span8" name="videolink">
                        </div>
                      </div> -->

											<div class="control-group">
												<label class="control-label" for="descriptionname">Decsription title</label>
												<div class="controls">
													<input type="text" id="basicinput" placeholder="Type title here..." class="span8" name="descriptionname" value="{{$productdetails->descriptionname}}">
													<!-- <span class="help-inline">Minimum 5 Characters</span> -->
												</div>
											</div>
										<div class="control-group">
											<label class="control-label" for="description">Description</label>
											<div class="controls">
												<textarea class="span8" rows="5" name="description" value="{{$productdetails->description}}">{{$productdetails->description}}</textarea>
											</div>
										</div><br>




										  <div id="demo" class="collapse">
												<div class="control-group">
		 												<label class="control-label" for="descriptionname2">Second Description title</label>
		 												<div class="controls">
		 													<input type="text" placeholder="Description title" class="span8" style="width:50%;" name="descriptionname2" value="{{$productdetails->descriptionname2}}">

		 												</div>
		 										</div>
		 										<div class="control-group">
		 											<label class="control-label" for="description2">Second Description</label>
		 											<div class="controls">
		 												<textarea class="span8" rows="5" name="description2" value="{{$productdetails->description2}}">{{$productdetails->description2}}</textarea>
		 											</div>
		 										</div>

										  </div><br>
											<a style="margin-left:70%;cursor:pointer;" type="button" id="one" class="" data-toggle="collapse" data-target="#demo">More option</a>
											<br>
<!--
								<div class="control-group">
										<label class="control-label" for="basicinput">Select image to upload</label>
										<div class="controls">
											<input type="file" class="form-control form-control-line" name="pictures[]" multiple>


										</div>
								 			</div> -->
										<div class="control-group">
											<div class="controls">
												<button type="submit" class="btn btn-success" style="float:right;margin-right:18%;">{{ trans('app.change')}}</button>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

 <script type="text/javascript">
 	var form = document.querySelector('form');
 	var request = new XMLHttpRequest();
 	form .addEventListener('submit', function(e){
 		e.preventDefault();
 		var formdata = new FormData(form);
 		request.open('post','submit');
 		request.send(formdata);
 	},false);
 </script>


 	<script type="text/javascript">
   $(document).ready(function(){
     $(document).on('change','.category', function(){
       var cate_id=$(this).val();
       console.log(cate_id);
 			// console.log(data.length);
       var div=$(this).parent();
       var op="";
       $.ajax({
         type:'get',
         url:'{!!URL::to('getdatabyaj')!!}',
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
 				url:'{!!URL::to('addprod')!!}',
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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 <script type="text/javascript">
 $(document).ready(function(){
 	$(document).on('change','.country', function(){
 		var count_id=$(this).val();
 		var div=$(this).parent();
 		var op=" ";
 		$.ajax({
 			type:'GET',
 			url:'{!!URL::to('getcitybyajax')!!}',
 			data:{'id':count_id},
 			cache: false,
 			success:function(data){
 				op+='<option value="0" selected disabled>Choose A City</option>';
 				for(var i=0; i<data.length; i++){
 					op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
 					}
 					div.find('.name').html(" ");
 					div.find('.name').append(op);
 			},
 			error:function(){
 				console.log('error var');
 			}
 		});
 	});
 	$("#submit").click(function(){
 		var a =$(this).parent();
 		var city = a.find('.name').val();
 		$.ajax({
 			type:'post',
 			url:'{!!URL::to('addprod')!!}',
 			data:{'city':city},
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
