@extends('layouts.master')

@section('css')
    <title>{{ ucwords(trans('app.create_page'))}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/icheck/skins/flat/red.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/normalize.css')}}"/>
@endsection
@section('body')
    <div id="content">
			<br>
      @include('layouts.alerts')
			<div class="form-element">
				<div class="col-md-12 padding-0">
					<div class="col-md-12">
						<div class="panel form-element-padding">
							<div class="panel-heading capi">
							 <h4>{{ trans('app.create_page')}}</h4>
							</div>
							 <div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">
                <form class="form-horizontal row-fluid" action="/create/new/page" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                 <table class="table table-bordered">
                    <tbody>
                        <tr class="techSpecRow capi">
                          <center style="font-weight:bold;color:red;"> Do not use comman name for link (slug)</center>
                          <br>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">{{ trans('app.short_name')}}: </td>
                          <td class="techSpecTD2">
                            <input type="text" placeholder="Short name..." class="form-control" name="shortname" required><span class="add-on">
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">{{ trans('app.title')}}: </td>
                          <td class="techSpecTD2">
                            <input type="text" placeholder="Title..." class="form-control" name="title" required><span class="add-on">
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">Status:</td>
                          <td class="techSpecTD2">
                            <label class="radio">
                              <input type="radio" name="status" value="1"/>
                              <span class="outer">
                              <span class="inner"></span></span> Active
                              <input type="radio" name="status" value="0" checked/>
                              <span class="outer">
                              <span class="inner"></span></span> Not Active
                            </label>
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">Menu Appearance:</td>
                          <td class="techSpecTD2">
                            <label class="radio">
                              <input type="radio" name="header_seem" value="1"/>
                              <span class="outer">
                              <span class="inner"></span></span> Yes
                              &nbsp; &nbsp; <input type="radio" name="header_seem" value="0" checked/>
                              <span class="outer">
                              <span class="inner"></span></span> No
                            </label>
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">Footer Appearance:</td>
                          <td class="techSpecTD2">
                            <label class="radio">
                              <input type="radio" name="footer_seem" value="1"/>
                              <span class="outer">
                              <span class="inner"></span></span> Yes
                              &nbsp; &nbsp; <input type="radio" name="footer_seem" value="0" checked/>
                              <span class="outer">
                              <span class="inner"></span></span> No
                            </label>
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">Footer Section:</td>
                          <td class="techSpecTD2">
                            <label class="radio">
                              <input type="radio" name="in_fo" value="1"/>
                              <span class="outer">
                              <span class="inner"></span></span> {{trans('app.information')}}
                              &nbsp; &nbsp; &nbsp; &nbsp; <input type="radio" name="in_fo" value="0" checked/>
                              <span class="outer">
                              <span class="inner"></span></span> {{trans('app.guide')}}
                            </label>
                          </td>
                        </tr>
                        <tr class="techSpecRow">
                          <td class="techSpecTD1 capi">Slug:</td>
                          <td class="techSpecTD2">
                            <input type="text" placeholder="Slug..." style="text-transform:lowercase;" class="form-control" name="slug"><span class="add-on">
                              @if ($errors->has('slug'))
                                <span class="help-block">
                                    <strong class="red">{{ $errors->first('slug') }}</strong>
                                </span>
                              @endif
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">{{ trans('app.details')}}:</td>
                          <td class="techSpecTD2">
                            <textarea  maxlength="250" class="form-control"  name="details"></textarea>
                          </td>
                        </tr>
                        <tr class="techSpecRow capi">
                          <td class="techSpecTD1">Select image to upload (only 1):</td>
                          <td class="techSpecTD2">
                            <input type="file" class="form-control form-control-line" name="image">
                          </td>
                        </tr>
                      </tbody>
                  </table>
                  <div class="form-group">
                    <label class="col-xs-2 control-label capi"></label>
                    <div class="col-xs-10">
                      <button type="submit" class="btn btn-success pull-right capi">{{ trans('app.create')}}</button>
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
