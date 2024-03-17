@extends('layouts.master')
@section('css')
    <title>Düzəliş et: {{ucwords($productdetails->productname)}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/icheck/skins/flat/red.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/normalize.css')}}"/>
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script src="{{ asset('adm/js/tinymce.js')}}"></script>
@endsection
@section('body')
    <div id="content">
			<br>
			<div class="form-element">
				<div class="col-md-12 padding-0">
					<div class="col-md-12">
						<div class="panel form-element-padding">
							<div class="panel-heading capi">
							 <h4>{{ trans('app.edit_product')}}</h4>
							</div>
							 <div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">
                  @include('layouts.alerts')
                <form class="form-horizontal row-fluid" action="/editproduct/{{$productdetails->id}}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <input type="hidden" id="pro_id" value="{{$productdetails->id}}">
                  <input type="hidden" name="seller" value="{{Auth::user()->id}}">
                <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="category">{{ trans('app.category')}}
                    <span class="red fa fa-star-of-life"></span></label>
                    <div class="col-xs-10">
                      <select class="form-control category" name="cat_name" id="cat_id" required>
                        <option selected="true">{{ trans('app.select')}}</option>
                        @foreach($category as $cat)
                          @if($sct = App\Subcat::where('parent_id','=',[$cat->id])->count() != 0)
                          <option value="{{$cat->id}}" @if($productdetails->category_id == $cat->id) selected @endif>{{$cat->name}}</option>
                          @endif
                        @endforeach
                      </select>
                        <select class="name form-control" name="subcategory_name" id="cat_id" required>
                          <option value="{{$productdetails->subcat_id}}" selected>
                            @foreach($ss = App\Subcat::where('id',$productdetails->subcat_id)->get() as $s)
                              {{$s->name}}
                            @endforeach
                          </option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="productname">{{ trans('app.product_name')}}</label>
                    <div class="col-xs-10">
                      <input class="form-control" type="text" value="{{$productdetails->productname}}" placeholder="Type name here..." maxlength="150" class="span8" name="productname" maxlength="150" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="slug">Slug</label>
                    <div class="col-xs-10">
                      <input class="form-control" type="text" name="slug" value="{{$productdetails->slug}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi">{{ trans('app.product_id')}}</label>
                    <div class="col-xs-10">
                      <input value="{{$productdetails->main_id}}" class="form-control" placeholder="{{ trans('app.product_id')}}" type="text" name="main_id">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="quantity">{{ trans('app.quantity')}}</label>
                    <div class="col-xs-10">
                      <div class="input-prepend">
                        <input class="form-control" value="{{$productdetails->quantity}}" name="quantity" type="number" placeholder="quantity" required min="0">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="price" >{{ trans('app.price')}}</label>
                    <div class="col-xs-10">
                      <div class="input-append">
                        <input class="form-control" type="text" placeholder="1.000" id="price" value="{{$productdetails->price}}" name="price" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="currency">{{ trans('app.currency')}}</label>
                    <div class="col-xs-10">
                      <div class="input-append">
                        <select class="form-control" name="currency" required>
                          <option value="1">AZN</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label" for="discount">{{ trans('app.discountifyouhave')}}</label>
                    <div class="col-xs-5">
                      <div class="input-append">
                        <input class="form-control" type="text" id="discount" oninput="getdisc1()" placeholder="{{__('app.Discounted_price')}}" value="{{$productdetails->discount}}" name="discount">
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="input-append">
                        <input class="form-control" type="text" id="result" oninput="getdisc()" placeholder="{{__('app.New_price')}}" value="{{$productdetails->price - $productdetails->discount}}">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label ">{{ trans('app.condition')}}</label>
                    <div class="col-xs-10">
                      <select class="form-control capi" name="condition" required="">
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
                 <table class="table table-bordered">
                    <tbody>
                        <tr class="techSpecRow capi"><th colspan="2">{{ trans('app.product_details')}}</th></tr>
                        <tr class="techSpecRow">
                          <td class="techSpecTD1 capi">{{ trans('app.brand')}}: </td>
                          <td class="techSpecTD2">
                            <input type="text" value="{{$productdetails->brand}}" placeholder="Brand" class="form-control capi" name="brand" required><span class="add-on">
                          </td>
                        </tr>
                        <tr class="techSpecRow">
                          <td class="techSpecTD1 capi">{{ trans('app.released_on')}}:</td>
                          <td class="techSpecTD2">
                            <input type="date" placeholder="Release date" class="form-control capi" name="releasedate" value="{{$productdetails->releasedate}}"><span class="add-on">
                          </td>
                        </tr>
                        <tr class="techSpecRow">
                          <td class="techSpecTD1 capi">{{ trans('app.dimension')}}:</td>
                          <td class="techSpecTD2">
                            <input type="text" placeholder="Dimension" class="form-control capi" name="dimension" value="{{$productdetails->dimension}}"><span class="add-on">
                          </td>
                        </tr>
                        <tr class="techSpecRow">
                          <td class="techSpecTD1 capi">{{ trans('app.features')}}:</td>
                          <td class="techSpecTD2">
                            <textarea type="text" maxlength="100" placeholder="Features" class="form-control" name="features">{{$productdetails->features}}</textarea>
                          </td>
                        </tr>
                    </tbody>
                  </table>
                  <!-- <div class="control-group">
                      <label class="control-label" for="videolink">Youtebe Video Link</label>
                      <div class="controls">
                        <input type="text" id="basicinput" placeholder="Add link here..." class="span8" name="videolink">
                      </div>
                    </div> -->

                    <div class="form-group">
                      <label class="col-xs-2 control-label capi" for="descriptionname">Decsription title</label>
                      <div class="col-xs-10">
                        <input class="form-control capi" type="text"  placeholder="Type title here..." name="descriptionname" value="{{$productdetails->descriptionname}}">
                        <!-- <span class="help-inline">Minimum 5 Characters</span> -->
                      </div>
                    </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="description">Description</label>
                    <div class="col-xs-10">
                      <textarea class="form-control " rows="5" name="description" value="{{$productdetails->description}}">{{$productdetails->description}}</textarea>
                    </div>
                  </div>
                    <div id="demo" class="collapse @if(!empty($productdetails->descriptionname2)) active in @endif">
                      <div class="form-group">
                          <label class="col-xs-2 control-label capi" for="descriptionname2">Second Description title</label>
                          <div class="col-xs-10">
                            <input class="form-control " type="text" placeholder="Description title" name="descriptionname2" value="{{$productdetails->descriptionname2}}">
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2 control-label capi" for="description2">Second Description</label>
                        <div class="col-xs-10">
                          <textarea class="form-control " rows="5" name="description2" value="{{$productdetails->description2}}">{{$productdetails->description2}}</textarea>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label capi">{{trans('app.image_upload_text')}} <span class="red fa fa-star-of-life"></span></label>
                        <div class="col-xs-10">
                          <input type="file" class="form-control form-control-line" name="pictures[]" multiple>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-xs-2 control-label capi" for="description2"></label>
                      <div class="col-xs-10">
                        <a style="cursor:pointer;text-decoration:underline;" type="button" id="one"  data-toggle="collapse" data-target="#demo">Daha çox</a>
                      </div>
                    </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for=""></label>
                    <div class="col-xs-10">
                      <button type="submit" class="btn btn-success pull-right capi">{{ trans('app.change')}}</button>
                    </div>
                  </div>
                </form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
</div>
@endsection
@section('js')
<script src="/adm/js/jquery.min.js"></script>
<script src="/adm/js/jquery.ui.min.js"></script>
<script src="/adm/js/bootstrap.min.js"></script>
<script src="/adm/js/plugins/moment.min.js"></script>
<script src="/adm/js/plugins/icheck.min.js"></script>
<script src="/adm/js/plugins/jquery.nicescroll.js"></script>
<script src="/adm/js/main.js"></script>
<script type="text/javascript">
      (function(jQuery){
           $('input').iCheck({
              checkboxClass: 'icheckbox_flat-red',
              radioClass: 'iradio_flat-red'
            });
        })(jQuery);
</script>
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
@endsection
