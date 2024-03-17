@extends('layouts.master')

@section('css')
<title>{{ucwords(trans('app.my_profile'))}}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/simple-line-icons.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/mediaelementplayer.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/icheck/skins/flat/red.css') }}"/>
@endsection

@section('body')
          <div id="content" class="profile-v1">
             <div class="col-md-12 col-sm-12 profile-v1-wrapper">
                <div class="col-md-9  profile-v1-cover-wrap" style="padding-right:0px;">
                    <div class="profile-v1-pp">
                      <img src="{{ asset('uploads/avatars/'. Auth::user()->avatar)}}" style="cursor:pointer;" data-toggle="modal" data-target="#updateprofile{{Auth::user()->id}}"/>
                      <h2 class="copi">{{ Auth::user()->name}} {{Auth::user()->surname}}</h2>
                      <!-- <input type="button" class="btn btn-danger" value="follow" /> -->
                    </div>
                    <div class="col-md-12 profile-v1-cover">
                      <img src="{{ asset('adm/img/bg1.jpg')}}" class="img-responsive">
                    </div>
                </div>
                <div class="modal fade modal-primary" id="updateprofile{{Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="moreModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="capi modal-title" id="moreModalLabel">Change Profile</h5>
                      </div>
                      <form enctype="multipart/form-data" action="/update/profilephoto/{{Auth::user()->id}}" method="post" >
                      {{csrf_field()}}
                        <div class="modal-body">
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="avatar">Select Photo</label>
                            <div class="col-sm-10">
                              <input class="form-control" type="file" name="avatar">
                            </div>
                          </div>
                          <br>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-danger capi" data-dismiss="modal">{{trans('app.cancel')}}</button>
                          <!-- <button data-toggle="modal" data-dismiss="modal" data-target="#deleteprofile{{Auth::user()->id}}" class="btn btn-primary">Delete Current</button> -->
                          <button type="submit" name="submit" class="btn btn-success capi">{{trans('app.change')}}</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12 padding-0 profile-v1-right">
                    <div class="col-md-6 col-sm-4 profile-v1-right-wrap padding-0">
                      <div class="col-md-12 padding-0 sub-profile-v1-right text-center sub-profile-v1-right1">
                          <h1>0</h1>
                          <p></p>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-4 profile-v1-right-wrap padding-0">
                        <div class="col-md-12 sub-profile-v1-right text-center sub-profile-v1-right2">
                           <h1>0</h1>
                           <p></p>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-4 profile-v1-right-wrap padding-0">
                        <div class="col-md-12 sub-profile-v1-right text-center sub-profile-v1-right3">
                          <h1>0</h1>
                          <p></p>
                        </div>
                    </div>
                </div>
             </div>
                 @if(Session::has('success'))
             			<br>
                   <center>
                     <div class="col-md-4" style="width:100%;">
                       <div class="alert alert-success">
                         {{Session::get('success')}}
                       </div>
                     </div>
                   </center>
                 @endif
             <div class="form-element">
               <div class="col-md-12 padding-0">
                 <div class="col-md-8">
                   <div class="panel form-element-padding">
                     <div class="panel-heading">
                      <h4>Change Settings</h4>
                     </div>
                      <div class="panel-body" style="padding-bottom:30px;">
                       <div class="col-md-12">
                         <form class="" action="/changeprofilesettings/{{Auth::user()->id}}" method="post">
                           {{ csrf_field()}}
                         <div class="form-group">
                           <label class="col-sm-2 control-label text-right">Name</label>
                           <div class="col-sm-10">
                             <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" placeholder="Name..." required>
                           </div>
                         </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label text-right">Surname</label>
                             <div class="col-sm-10">
                               <input type="text" class="form-control" name="surname" value="{{Auth::user()->surname}}" placeholder="Surname..." required>
                             </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label text-right">Birth Date</label>
                              <div class="col-sm-10">
                                <input type="date" class="form-control" name="dob" value="{{Auth::user()->dob}}" required>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label text-right">Email</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}" placeholder="Email..." required>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label text-right"></label>
                              <div class="col-sm-10">
                                <button type="submit" name="submit" class="btn btn-success capi pull-right"> {{trans('app.change')}}</button>
                              </div>
                          </div>
                         </form>
                       </div>
                     </div>
                   </div>
                 </div>
                 <div class="col-md-4 col-sm-12">
                   <!-- <div class="col-md-6 panel" style="padding:20px;padding-bottom:0px;">
                     <div class="form-group form-animate-checkbox">
                       <input type="checkbox" class="checkbox">
                       <label> Checkbox</label>
                     </div>
                   </div>
                   <div class="col-md-6 panel" style="padding:20px;padding-bottom:0px;">
                     <div class="form-group form-animate-checkbox">
                       <input type="checkbox" class="checkbox">
                       <label> Checkbox</label>
                     </div>
                   </div> -->

                   <div class="col-md-12 panel form-element-padding" style="padding-bottom:50px;padding-right:0px;">
                     <div class="panel-heading">
                        <h4>Change Password</h4>
                     </div>
                     <div class="panel-body">
                       <form action="/changepassword/{{Auth::user()->id}}" method="post">
                         {{csrf_field()}}
                         <div class="form-group">
                           <div class="col-sm-12"><input name="password" type="password" class="form-control" placeholder="New password..." required></div>
                         </div>
                         <br>
                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong class="red">{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                         <div class="form-group">
                           <div class="col-sm-12"><input name="password_confirmation" type="password" class="form-control" placeholder="Confirm password..." required></div>
                         </div>
                         <div class="form-group">
                           <div class="col-sm-12">
                             <button type="submit" name="button" class="btn btn-success capi pull-right">{{trans('app.change')}}</button>
                           </div>
                         </div>
                       </form>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
@endsection

@section('js')
<script src="{{ asset('adm/js/jquery.min.js')}}"></script>
<script src="{{ asset('adm/js/jquery.ui.min.js')}}"></script>
<script src="{{ asset('adm/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/icheck.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/moment.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/mediaelement-and-player.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/jquery.nicescroll.js')}}"></script>

<script src="{{ asset('adm/js/main.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
   $('input').iCheck({
    checkboxClass: 'icheckbox_flat-red',
    radioClass: 'iradio_flat-red'
  });
   $('video,audio').mediaelementplayer({
            alwaysShowControls: true,
            videoVolume: 'vertical',
            features: ['playpause','progress','volume','fullscreen']
          });
 });
</script>
@endsection
