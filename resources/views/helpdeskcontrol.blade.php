@extends('layouts.master')
@section('css')
    <title>Əlaqələr </title>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/icheck/skins/flat/red.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/normalize.css')}}"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <style media="screen">
      a{cursor: pointer;}
      .ldng-gif{
        position: fixed;
        background: #f3f3f3d4;
        height: 100%;
        width: 100%;
        z-index: 10000;
        display: flex;
      }
      .ldng-gif img{
        max-height: 12%;
        display: block;
        margin: auto;
      }
      #mail tbody tr .contact{
        width: 38%;
      }
    </style>
@endsection
@section('body')
    <div class='ldng-gif'><img src='/images/ldng.gif' alt='loading'></div>
    <div id="content">
            <div class="col-md-12" style="padding:30px;">
              <div class="col-md-12 mail-wrapper">
                  <div class="col-md-12 padding-0">
                      <div class="col-md-3 mail-left">
                          <div class="col-md-12 mail-left-header">
                                <center>
                                <button type="button" class="btn btn-danger btncompose-mail" data-toggle="modal" data-target="#Modalboost"/>
																	Compose Mail
																</button>
                                </center>
                          </div>
													<div class="modal fade" id="Modalboost" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
														<div class="modal-dialog" >
															<div class="modal-content">
																	<div class="modal-header">
																		 Mesaj yaz
																	</div>
																	<form class="" action="/sendproblem" method="post">
																		{{csrf_field()}}
																		<div class="modal-body" style="background-color:white;">
																			<div class="form-group">
                                        <label for=""><span>Kimə:</span></label>
  																			<select class="form-control" name="reply_user_id" required>
  																				@foreach($user = App\User::all() as $user)
  																				<option value="{{$user->id}}">{{$user->email}}</option>
  																				@endforeach
  																			</select>
                                      </div>
																			<span>Başlıq:</span>
																			<input type="text" name="problem_title" class="form-control" required><br>
																			<input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
																			<br><br>
																				<textarea placeholder="Yaz..." name="problem_body"></textarea>
																		</div>
																		<div class="modal-footer">
																				<button type="submit" name="submit" class="btn btn-primary">Göndər</button>
																		</div>
																  </form>
														    </div>
															</div>
														</div>
                          <div class="col-md-12 mail-left-content">
                               <ul class="nav">
                                  <li></li>
                                  <li><h5>Folder</h5></li>
                                  <li>
                                    <a class="ml-list active" data-url="cnt-list"><span class="fa fa-inbox"></span>
																			Inbox (<i class="incount"></i>)</a>
                                  </li>
                                  <li>
                                    <a class="ml-list" data-url="helpdeskcontrol-sent"><span class="fa fa-paper-plane"></span> Send Mail</a>
                                  </li>
                                  <li>
                                    <a class="ml-list" data-url="helpdeskcontrol-deleted"><span class="fa fa-trash"></span> Deleted</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                      <div class="col-md-9 mail-right">
                          <div class="col-md-12 mail-right-header">
                            <div class="col-md-10 col-sm-10 padding-0">
                                 <div class="input-group searchbox-v1">
                                  <span class="input-group-addon  border-none box-shadow-none" id="basic-addon1">
                                    <span class="fa fa-search"></span>
                                  </span>
                                  <input type="text" id="myInput" class="txtsearch border-none box-shadow-none" placeholder="Axtar..." aria-describedby="basic-addon1">
                                </div>
							                @include('layouts.alerts')
                            </div>
                            <div class="col-md-2 col-sm-2 padding-0 text-right mail-right-options">
                                 <div class="btn-group pull-right right-option-v1">
                                    <i class="fa fa-ellipsis-v right-option-v1-icon" data-toggle="dropdown"></i>
                                    <ul class="dropdown-menu" role="menu">
                                      <li><a href="#">Action</a></li>
                                      <li><a href="#">Another action</a></li>
                                      <li><a href="#">Something else here</a></li>
                                      <li class="divider"></li>
                                      <li><a href="#">Separated link</a></li>
                                    </ul>
                                  </div>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12 mail-right-tool">
                              <ul class="nav">
                                  <li>
                                    <!-- <input type="checkbox" class="icheck parent-select" name="checkbox1" /> -->
                                  </li>
                                  <li>
                                    <a><span class="fa fa-eye"></span></a>
                                  </li>
                                  <!-- <li><a href=""><span class="fa fa-trash"></span></a></li> -->
                              </ul>
                          </div>
                          <div class="col-md-12 mail-right-content">
                              <table class="table table-hover" id="mail"></table>
                              <a class="btn btn-primary ldmoreml">Daha çox</a>
													</div>
                          <div class="modal fade" id="more" role="dialog"></div>
                          <div class="modal fade" id="delete" role="dialog"></div>
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
<script src="/adm/js/plugins/icheck.min.js"></script>
<script src="/adm/js/plugins/jquery.nicescroll.js"></script>
<script src="{{ asset('adm/js/main.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script>
 $(document).ready(function(){
   $("#myInput").on("keyup", function() {
     var value = $(this).val().toLowerCase();
     $("#mail tr").filter(function() {
       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
     });
   });
 });
 var n = 10;
 var base_url = "/cnt-list";
 function getlist(numb,get_url){
   $.ajax({
     url: get_url,
     type: "GET",
     data: {numb:numb},
     success: function(d){
       $(".incount").html(d.count);
       let data = d.res;
       let html = "";
       for (var i = 0; i < data.length; i++) {
         var stat = "read";var type = "";
         if (data[i]["read"] == 0) {stat = "unread";}
         if(data[i]["problem_title"] === 'CALL ME'){var type = "style='color:red;'";}
         if(data[i]["read"] == 0){
           var read = "<a class='btn btn-success unread maskasread' data-id='"+data[i]['id']+"'><i class='fa fa-envelope-open' title='make as read'></i></a>";
         }else{
           var read = "<a class='btn btn-primary read maskasread' data-id='"+data[i]['id']+"'><i class='fa fa-envelope' title='make as unread'></i></a>";
         }
         html += "<tr class='"+stat+"'><td class='check'><input type='checkbox' class='icheck' name='contact-select' value='1'/></td><td class='contact'><a class='capi' data-toggle='modal' data-target='#more' data-id='"+data[i]["id"]+"'>"+data[i]["name"]+" "+data[i]["surname"]+" </a></td><td class='subject'><a data-toggle='modal' data-target='#more' data-id='"+data[i]["id"]+"' "+type+" title='"+data[i]["created_at"]+"'>"+data[i]["problem_title"]+"</a></td><td class='subject'><div class='btn-group'>"+read+"<a data-toggle='modal' data-target='#delete' data-name='"+data[i]["name"]+" "+data[i]["surname"]+"' data-id='"+data[i]["id"]+"' class='btn btn-danger'><i class='fa fa-trash'></i> </a></div></td></tr>";
       }
       if (numb > data.length) {$(".ldmoreml").css("display","none");}else{$(".ldmoreml").css("display","");}
       $("#mail").html(html);
       (function(jQuery){
         $('input').iCheck({
           checkboxClass: 'icheckbox_flat-red',
           radioClass: 'iradio_flat-red'
         });
       })(jQuery);
     },complete:function(){$(".ldng-gif").remove();}
   });
 }
 $(document.body).on("click",".maskasread",function(){
   ldn();
   if ($(this).hasClass("read")) {var typ = "read";}else{var typ = "unread";}
   $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
   $.ajax({
     url: "/read-contact",
     type: "POST",
     data:{id:$(this).data("id"),tp:typ},
     success: function(data){getlist(n,base_url);},complete:function(){$(".ldng-gif").remove();}
   });
 });
 $(document.body).on("click",".dlt_contact",function(){
   ldn();
   $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
   $.ajax({
     url: "/delete-contact",
     type: "POST",
     data:{id:$(this).data("id"),tp:"delete"},
     success: function(data){getlist(n,base_url);$('#delete').modal('toggle');},
     complete:function(){$(".ldng-gif").remove();}
   });
 });
 getlist(n,base_url);
 $(document.body).on("click","a[data-target='#delete']",function(){
   $("#delete").html("<div class='modal-dialog'><div class='modal-content'><div class='modal-header'><h4 class='modal-title'>Detele</h4></div><div class='modal-body'>Are sure to delete letter from <b class='capi'>"+$(this).data("name")+"</b>?</div><div class='modal-footer'><a class='btn btn-primary' data-dismiss='modal'>Cancel</a><a class='btn btn-danger dlt_contact' data-id='"+$(this).data("id")+"'>Yes</a></div></div></div>");
 });
 $(document.body).on("click","a[data-target='#more']",function(){
   $.ajax({
     url: "/get-contact-details",
     type: "GET",
     data:{id:$(this).data("id")},
     success: function(data){
       $("#more").html("<div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title'>More</h4></div><div class='modal-body'><div id='myCarousel' class='carousel slide' data-ride='carousel'><ul class='list-group'><li class='list-group-item'><b style='color:#003399'>ID:</b> id</li><li class='list-group-item capi'><b style='color:#003399'>Sender: </b>"+data["name"]+" "+data["surname"]+"</li><li class='list-group-item'><b style='color:#003399'>Email:</b> "+data['email']+"</li><li class='list-group-item'><b style='color:#003399'>IP:</b> "+data['user_ip']+"</li><li class='list-group-item'><b style='color:#003399'>Time:</b> "+data['created_at']+"</li><li class='list-group-item'><b style='color:#003399'>Phone:</b> "+data["phone_number"]+"</li><li class='list-group-item'><b style='color:#003399'>Title: </b> "+data["problem_title"]+"</li><li class='list-group-item'><b style='color:#003399'>Details: </b> "+data["problem_body"]+"</li></ul></div></div></div><div class='modal-footer'></div></div>");
     },complete:function(){$(".ldng-gif").remove();}
   });
 });
 $(".ml-list").on("click",function(){
   ldn();
   $(".ml-list").removeClass("active");
   $(this).addClass("active");
   base_url = $(this).data("url");
   getlist(n,base_url);
 });
 $(".ldmoreml").on("click",function(){
   ldn();
   n += 10;
   getlist(n,base_url);
 });
 function ldn(){
   $("body").append("<div class='ldng-gif'><img src='/images/ldng.gif' alt='loading'></div>");
 }
 ldn();
 $(document.body).on("click",".iCheck-helper",function(){
   console.log("works");
   // if ($(this).is(':checked')) {
   //   $(".contact-select").prop( "checked", true );
   // }else{
   //   $(".contact-select").prop( "checked", false );
   // }
 });
 setInterval(function(){getlist(n,base_url);},20000);
 </script>
@endsection
