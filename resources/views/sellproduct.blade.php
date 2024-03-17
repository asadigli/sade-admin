@extends('layouts.master')
@section('css')
    <title>{{ ucwords(trans('app.sellproduct'))}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/icheck/skins/flat/red.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/normalize.css')}}"/>
@endsection
@section('body')
    <div id="content">
			<br>
			<div class="form-element">
				<div class="col-md-12 padding-0">
					<div class="col-md-12">
						<div class="panel form-element-padding">
							<div class="panel-heading capi"><h4>{{ trans('app.add_product')}}</h4></div>
							 <div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">
                  @include('layouts.alerts')
                <form class="form-horizontal row-fluid" action="/addnewproduct" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <h4  style="cursor:pointer;text-align:center;color:blue;"><i style="color:gray;">{{trans('app.last_added_product')}}:</i>
                  @foreach($pro_last = App\ProductDetails::orderBy('created_at','desc')->take(1)->get() as $pl) <b class="center" title="{{$pl->productname}}">{{$pl->main_id}}</b> @endforeach</h4>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="category">{{ trans('app.category')}}
                    <span class="red fa fa-star-of-life"></span></label>
                    <div class="col-xs-10">
                      <select class="form-control category" name="cat_name" id="cat_id" required>
                        <option selected="true">{{ trans('app.select')}}</option>
                        @foreach($category as $cat)
                          @if($sct = App\Subcat::where('parent_id','=',[$cat->id])->count() != 0)
                          <option value="{{$cat->id}}" required>{{$cat->name}}</option>
                          @endif
                        @endforeach
                      </select>
                        <select class="name form-control" name="subcategory_name" id="cat_id" required>
                          <option value="0" disabled="true" selected="true" required>{{ trans('app.select')}}</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="productname">{{ trans('app.product_name')}} <span class="red fa fa-star-of-life"></span></label>
                    <div class="col-xs-10">
                      <input class="form-control" type="text"  placeholder="Type name here..." maxlength="150" class="span8" name="productname" maxlength="150" required>
                      @if ($errors->has('productname'))
                        <span class="help-block">
                            <strong class="red">{{trans('app.productname_unique_text')}}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="productname">ID <span class="red fa fa-star-of-life"></span></label>
                    <div class="col-xs-10">
                      <input class="form-control" type="text" placeholder="Type ID here..." maxlength="50" class="span8" name="main_id" required="">
                      @if ($errors->has('main_id'))
                        <span class="help-block">
                            <strong class="red">{{trans('app.main_id_unique_text')}}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="quantity">{{ trans('app.quantity')}} <span class="red fa fa-star-of-life"></span></label>
                    <div class="col-xs-10">
                      <div class="input-prepend">
                        <input class="form-control"  name="quantity" type="number" placeholder="quantity" required min="0">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="price">{{ trans('app.price')}} <span class="red fa fa-star-of-life"></span></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" id="price" placeholder="1.000" name="price" required step="0.01" min="0">
                    </div>
                  <div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="currency">{{ trans('app.currency')}}</label>
                    <div class="col-xs-10">
                      <select class="form-control" name="currency"  required="">
                          <option value="1">AZN</option>
                          <!-- <option value="2">$</option> -->
                          <!-- <option value="3">€</option> -->
                      </select>
                  </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="discount">{{ trans('app.discountifyouhave')}}</label>
                    <div class="col-xs-5">
                      <div class="input-append">
                        <input class="form-control" type="number" id="discount" oninput="getdisc1()" placeholder="{{__('app.Discounted_price')}}" name="discount" step="0.01">
                      </div>
                    </div>
                    <div class="col-xs-5">
                      <div class="input-append">
                        <input class="form-control" type="number" id="result" oninput="getdisc()" placeholder="{{__('app.New_price')}}" step="0.01">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi">{{ trans('app.condition')}}</label>
                    <div class="col-xs-10">
                      <input type="radio" name="condition" value="1" checked> {{ trans('app.new')}}
                      <input type="radio" name="condition" value="2"> {{ trans('app.used')}}
                    </div>
                  </div>
                 <table class="table table-bordered">
                        <tbody>
                        <tr class="techSpecRow capi">
                          <th colspan="2">{{ trans('app.product_details')}}</th>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">{{ trans('app.brand')}}: </td>
                          <td class="techSpecTD2">
                            <input type="text" placeholder="Brand" value="B/B" class="form-control" name="brand" required><span class="add-on">
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">{{ trans('app.released_on')}}:</td>
                          <td class="techSpecTD2">
                            <input type="date" placeholder="Release date" class="form-control" name="releasedate"><span class="add-on">
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">{{ trans('app.dimension')}}:</td>
                          <td class="techSpecTD2">
                            <input type="text" placeholder="Dimension" class="form-control" name="dimension"><span class="add-on">
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">{{ trans('app.features')}} <span class="red fa fa-star-of-life"></span>:</td>
                          <td class="techSpecTD2">
                            <textarea  maxlength="250" class="form-control" placeholder="Features"  name="features">---</textarea>
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">{{ trans('app.shipping_in_baku')}}:</td>
                          <td class="techSpecTD2">
                            <input type="text" placeholder="Shipping in baku" class="form-control" name="shipping_in_baku"><span class="add-on">
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">{{ trans('app.shipping_to_regions')}}:</td>
                          <td class="techSpecTD2">
                            <input  maxlength="200" class="form-control" placeholder="Shipping to regions" name="shipping_to_regions"
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">{{ trans('app.sadestore_points')}}:</td>
                          <td class="techSpecTD2">
                            <input type="text" placeholder="{{ trans('app.sadestore_points')}}" class="form-control" name="sadestore_points"><span class="add-on">
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">{{ trans('app.buy_2_get_1')}}:</td>
                          <td class="techSpecTD2">
                            <input maxlength="250" class="form-control" placeholder="{{ trans('app.buy_2_get_1')}}" name="buy_2_get_1">
                          </td>
                        </tr>
                      </tbody>
                  </table>
                    <div class="form-group">
                      <label class="col-xs-2 control-label capi" for="descriptionname">Decsription title</label>
                      <div class="col-xs-10">
                        <input class="form-control" value="Daha Ətraflı" type="text" placeholder="Title here..." name="descriptionname">
                      </div>
                    </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi" for="description">Description</label>
                    <div class="col-xs-10">
                      <textarea class="form-control" rows="5" name="description"></textarea>
                    </div>
                  </div><br>
                  <div id="demo" class="collapse">
                      <div class="form-group">
                          <label class="col-xs-2 control-label capi" for="descriptionname2">Second Description title</label>
                          <div class="col-xs-10">
                            <input class="form-control" type="text" placeholder="Description title" name="descriptionname2">
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2 control-label capi" for="description2">Second Description</label>
                        <div class="col-xs-10">
                          <textarea class="form-control" rows="5" name="description2"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label capi">{{trans('app.image_upload_text')}} <span class="red fa fa-star-of-life"></span></label>
                        <div class="col-xs-10">
                          <input type="file" class="form-control form-control-line" name="pictures[]" multiple required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label capi"></label>
                        <div class="col-xs-10">
                          <a style="text-decoration:underline;cursor:pointer;" type="button" id="one" class="" data-toggle="collapse" data-target="#demo">More option</a>
                        </div>
                    </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi"></label>
                    <div class="col-xs-10">
                      <button type="submit" class="btn btn-success pull-right capi">{{ trans('app.post_it')}}</button>
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
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('adm/js/tinymce.js')}}"></script>
<script src="{{ asset('adm/js/jquery.min.js') }}"></script>
<script src="{{ asset('adm/js/jquery.ui.min.js') }}"></script>
<script src="{{ asset('adm/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adm/js/plugins/moment.min.js') }}"></script>
<script src="{{ asset('adm/js/plugins/icheck.min.js') }}"></script>
<script src="{{ asset('adm/js/plugins/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('adm/js/main.js') }}"></script>
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
       // url: "//getdatabyaj/",
       url:'/product/getdatabyaj',
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
      url:'/product/addprod',
      data:{'subcategory_name':subcatname},
      dataType:'json',
      success:function(data){
        console.log("done!")
      },
      error:function(){
        console.log("again error!!!!!")
      }
    });
  });
 });
</script>

<script type="text/javascript">
$(document).ready(function(){
$(document).on('change','.country', function(){
  var count_id=$(this).val();
  var div=$(this).parent();
  var op=" ";
  $.ajax({
    type:'GET',
    url:'/product/getcitybyajax',
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
    url:'/product/addprod',
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
