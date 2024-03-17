@extends('layouts.master')

@section('css')
    <title>{{ ucwords($page->title)}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/icheck/skins/flat/red.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/normalize.css')}}"/>
    <style media="screen">
      .title{
         width: 15%;
         color: black;
      }
    </style>
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
              <br>
              <div id="exTab1" class="container">
                <ul class="nav nav-pills capi">
              		<li class="active"><a href="#1a" data-toggle="tab">{{ trans('app.preview')}}</a></li>
              		<li><a href="#2a" data-toggle="tab">{{ trans('app.edit')}}</a></li>
              	</ul>
              	<div class="tab-content clearfix">
              		<div class="tab-pane active" id="1a">
                    <table class="table">
                      <hr>
                      <tbody>
                              <tr>
                                <td class="title capi"><b>{{ trans('app.short_name')}}</b></td>
                                <td>{{$page->shortname}}</td>
                              </tr>
                              <tr>
                                <td class="title capi"><b>{{trans('app.title')}}</b> </td>
                                <td>{{$page->title}}</td>
                              </tr>
                              <tr>
                                <td class="title"><b>Slug</b></td>
                                <td>{{$page->slug}}</td>
                              </tr>
                              <tr>
                                <td class="title"><b>Status</b></td>
                                <td class="capi">
                                  @if($page->status == 1)
                                    <span style="color:red;">{{trans('app.active')}}</span>
                                  @elseif($page->status == 0)
                                     <span style="color:blue;">{{trans('app.closed')}}</span>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td class="title"><b>Header</b></td>
                                <td class="capi">
                                  @if($page->header_seem == 1)
                                    <span style="color:red;">{{trans('app.open')}}</span>
                                  @elseif($page->header_seem == 0)
                                     <span style="color:blue;">{{trans('app.closed')}}</span>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td class="title"><b>Footer</b></td>
                                <td class="capi">
                                  @if($page->footer_seem == 1)
                                    <span style="color:red">{{trans('app.active')}}</span>
                                  @elseif($page->footer_seem == 0)
                                     <span style="color:blue;">{{trans('app.closed')}}</span>
                                  @endif
                                </td>
                              </tr>
                              @if($page->footer_seem == 1)
                              <tr>
                                <td class="title"><b>Footer</b></td>
                                <td class="capi">
                                  @if($page->information_footer == 1)
                                    <span >{{trans('app.information')}}</span>
                                  @elseif($page->information_footer == 0)
                                     <span>{{trans('app.guide')}}</span>
                                  @endif
                                </td>
                              </tr>
                              @endif
                              <tr>
                                <td class="title capi"><b>{{ trans('app.details')}}</b></td>
                                <td>{!! $page->details !!}</td>
                              </tr>
                              <tr>
                                <td class="title capi"><b>{{trans('app.image')}}</b></td>
                                <td>
                                  <img src="https://sade.store/public/uploads/pages/{{$page->image}}" alt="{{$page->title}}">
                                </td>
                              </tr>
                              @php
                                $tabs = App\Tab::where('page_id', '=', [$page->id])->get()
                              @endphp
                              @if(count($tabs) != 0)
                              <tr>
                                <td class="title capi"><b>Tabs</b></td>
                                @foreach($tabs as $tb)
                                <td>
                                  <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <h4 class="panel-title">
                                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$tb->id}}">{{$tb->question}}</a>
                                        </h4>
                                      </div>
                                      <div id="collapse-{{$tb->id}}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                          {!! $tb->answer !!}
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              @endforeach
                              @endif
                          </tbody>
                        </table>
              				</div>
              				<div class="tab-pane" id="2a">
                        <hr>
                         <form style="width: 80%;" action="/update/page/{{$page->id}}" method="post" enctype="multipart/form-data">
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
                                     <input type="text" placeholder="Short name..." class="form-control" value="{{$page->shortname}}" name="shortname" required><span class="add-on">
                                   </td>
                                 </tr>
                                 <tr class="techSpecRow capi">
                                   <td class="techSpecTD1">{{ trans('app.title')}}: </td>
                                   <td class="techSpecTD2">
                                     <input type="text" placeholder="Title..." class="form-control" value="{{$page->title}}" name="title" required><span class="add-on">
                                   </td>
                                 </tr>
                                 <tr class="techSpecRow capi">
                                   <td class="techSpecTD1">Status:</td>
                                   <td class="techSpecTD2">
                                     <label class="radio">
                                       <input type="radio" name="status" value="1" {{ ($page->status == 1) ? "checked" : "" }}/>
                                       <span class="outer">
                                       <span class="inner"></span></span> Active
                                       <input type="radio" name="status" value="0" {{ ($page->status == 0) ? "checked" : "" }}/>
                                       <span class="outer">
                                       <span class="inner"></span></span> Not Active
                                     </label>
                                   </td>
                                 </tr>
                                 <tr class="techSpecRow capi">
                                   <td class="techSpecTD1">Menu Appearance:</td>
                                   <td class="techSpecTD2">
                                     <label class="radio">
                                       <input type="radio" name="header_seem" value="1" {{ ($page->header_seem == 1) ? "checked" : "" }}/>
                                       <span class="outer">
                                       <span class="inner"></span></span> Yes
                                       &nbsp; &nbsp; <input type="radio" name="header_seem" value="0" {{ ($page->header_seem == 0) ? "checked" : "" }}/>
                                       <span class="outer">
                                       <span class="inner"></span></span> No
                                     </label>
                                   </td>
                                 </tr>
                                 <tr class="techSpecRow capi">
                                   <td class="techSpecTD1">Footer Appearance:</td>
                                   <td class="techSpecTD2">
                                     <label class="radio">
                                       <input type="radio" name="footer_seem" value="1" {{ ($page->footer_seem == 1) ? "checked" : "" }}/>
                                       <span class="outer">
                                       <span class="inner"></span></span> Yes
                                       &nbsp; &nbsp; <input type="radio" name="footer_seem" value="0" {{ ($page->footer_seem == 0) ? "checked" : "" }}/>
                                       <span class="outer">
                                       <span class="inner"></span></span> No
                                     </label>
                                   </td>
                                 </tr>
                                 <tr class="techSpecRow capi">
                                   <td class="techSpecTD1">Footer Section:</td>
                                   <td class="techSpecTD2">
                                     <label class="radio">
                                       <input type="radio" name="in_fo" value="1"  {{ ($page->information_footer == 1) ? "checked" : "" }}/>
                                       <span class="outer">
                                       <span class="inner"></span></span> {{trans('app.information')}}
                                       &nbsp; &nbsp; &nbsp; &nbsp; <input type="radio" name="in_fo" value="0"  {{ ($page->information_footer == 0) ? "checked" : "" }}/>
                                       <span class="outer">
                                       <span class="inner"></span></span> {{trans('app.guide')}}
                                     </label>
                                   </td>
                                 </tr>
                                 <tr class="techSpecRow">
                                   <td class="techSpecTD1 capi">Slug:</td>
                                   <td class="techSpecTD2">
                                     <input type="text" placeholder="Slug..." class="form-control" value="{{$page->slug}}" name="slug"><span class="add-on">
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
                                     <textarea  maxlength="250" class="form-control"  name="details">{{$page->details}}</textarea>
                                   </td>
                                 </tr>
                                 <tr class="techSpecRow capi">
                                   <td class="techSpecTD1">Select image to upload (only 1):</td>
                                   <td class="techSpecTD2">
                                     <input type="file" class="form-control form-control-line" name="image" value="{{$page->image}}">
                                   </td>
                                 </tr>
                               </tbody>
                           </table>
                           <div class="form-group">
                             <label class="col-xs-2 control-label capi"></label>
                             <div class="col-xs-10">
                               <button type="submit" class="btn btn-success pull-right capi">{{ trans('app.edit')}}</button>
                             </div>
                           </div><br>
                         </form>
              				</div>
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
