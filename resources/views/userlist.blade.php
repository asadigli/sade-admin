@extends('layouts.master')

@section('css')
<title>{{ ucwords(trans('app.userlist'))}}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/datatables.bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
@endsection
@section('body')
  <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">User List</h3>
                        <p class="animated fadeInDown">
                          List <span class="fa-angle-right fa"></span> Users
                        </p>
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
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>User List</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr class="capi">
    											<th>{{ trans('app.name')}} / {{trans('app.surname')}}</th>
    											<th>{{ trans('app.position')}}</th>
    											<th>{{ trans('app.email')}}</th>
    											<th>{{ trans('app.gender')}}</th>
    											@if((Auth::user()->role_id) == 4)
    											<th><center>X</center> </th>
    											@endif
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($user as $user)
    										<tr class="odd gradeX">
    											<!-- <th><img src="/uploads/avatars/{{ $user->avatar}}" alt="" style="box-shadow:1px 1px 1px 1px gray;border-radius:50%;height:40px;width:70px;"></th> -->
    											<!-- <th>{{$user->id}}</th> -->
    											<th><a class="capi">{{$user->name}} {{$user->surname}}</a></th>
    											@if(($user->role_id)==1)
    											<th>S.İ.</th>
    											@elseif(($user->role_id)==2)
    											<th style="color:blue;">3.A.</th>
    											@elseif(($user->role_id)==3)
    											<th style="color:green;">2.A.</th>
    											@elseif(($user->role_id)==4)
    											<th style="color:red;">1.A.</th>
    											@endif
    											<th>{{$user->email}}</th>
    											@if(($user->gender)==1)
    											<th>{{ trans('app.male')}}</th>
    											@else
    											<th>{{ trans('app.female')}}</th>
    											@endif
    											@if((Auth::user()->role_id)==4)
    											<th>
                            @if(!empty($user->mobile))
                            <a class="btn btn-danger" data-toggle="modal" data-target="#verify-{{$user->id}}" title="Nömrəni təsdiqlə">
                              @if($user->mobile_verification == 0)
                              <i class="fa fa-question"></i>
                              @else
                              <i class="fa fa-check-circle"></i>
                              @endif
                            </a>
                            @endif
                            <a class="btn btn-success capi" data-toggle="modal" data-target="#assign{{$user->id}}">{{ trans('app.assign')}}</a>
                            <a class="btn btn-primary capi" data-toggle="modal" data-target="#resetpass{{$user->id}}">{{ trans('app.reset_password')}}</a>
                            <a class="btn btn-danger capi" data-toggle="modal" data-target="#delete-{{$user->id}}">{{ trans('app.delete')}}</a>
                            <!-- assign modal -->
                            <div class="modal fade" id="assign{{$user->id}}" role="dialog">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Assign</h4>
                                  </div>
                                  <form class="" action="/assignadmin/{{{$user->id}}}/edit" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                      <p><b>User:</b> <i class="capi">{{$user->name}} {{$user->surname}}</i></p>
                                      <select class="form-control" id="role_id" name="role_id" style="width:100%;" required>
                                        <option value="{{$user->role_id}}" name="role_id">
                                          @if($user->role_id == 1)
                                            Sadə İstifadəçi
                                          @elseif($user->role_id == 2)
                                            3-cü Dərəcəli
                                          @elseif($user->role_id == 3)
                                            2-ci Dərəcəli
                                          @else
                                            1-ci Dərəcəli
                                          @endif
                                        </option>
                                        <option value="1" name="role_id">Sadə İstifadəçi</option>
                                        <option value="2" name="role_id">3-cü Dərəcəli</option>
                                        <option value="3" name="role_id">2-ci Dərəcəli</option>
                                        <option value="4" name="role_id">1-ci Dərəcəli</option>
                                      </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{trans('app.close')}}</button>
                                        <button type="submit" name="submit" class="btn btn-success">Assign</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <!-- reset password -->
                            <div class="modal fade" id="resetpass{{$user->id}}" role="dialog">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Reset Password</h4>
                                  </div>
                                  <form class="" action="/changepassword/{{{$user->id}}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <!-- <div class="col-sm-12"> -->
                                          <input name="password"type="password" class="form-control" placeholder="New password..." required>
                                        <!-- </div> -->
                                      </div>
                                      <br><br>
                                       @if ($errors->has('password'))
                                           <span class="help-block">
                                               <strong class="red">{{ $errors->first('password') }}</strong>
                                           </span>
                                       @endif
                                      <div class="form-group">
                                        <!-- <div class="col-sm-12"> -->
                                          <input name="password_confirmation" style="width:100%" type="password" class="form-control" placeholder="Confirm password..." required>
                                        <!-- </div> -->
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{trans('app.close')}}</button>
                                        <button type="submit" name="submit" class="btn btn-success capi">{{trans('app.change')}}</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <!-- delete popup -->
      											<div class="modal fade" id="delete-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
        											<div class="modal-dialog" >
        												<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
        													<div class="modal-header" style="background-color:white;">
                                    Silmək
        													</div>
                                  <div class="modal-body">
                                    <i class="capi">{{$user->name}} {{$user->surname}}</i>-ı silməkdə əminsinizmi?
                                  </div>
        														<div class="modal-footer">
        																<button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
        																<a href="/userdelete/{{ $user->id }}" class="btn btn-primary">Yes</a>
        														</div>
        												</div>
        											</div>
      											</div>
                            <!-- verify number -->
                            <div class="modal fade" id="verify-{{$user->id}}" role="dialog">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Nömrə təsdiqləmək</h4>
                                  </div>
                                  <form action="/verify/{{$user->id}}/number" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                      <p><b>İstifadəçi:</b> <i class="capi">{{$user->name}} {{$user->surname}}</i></p>
                                      <p><b>Nörmə:</b> <i class="capi">{{$user->mobile}}</i></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{trans('app.close')}}</button>
                                        <button type="submit" name="submit" class="btn btn-success">@if($user->mobile_verification == 0) Təsdiqlə @else Təsdiqi geri çək @endif</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
    											</th>
    											@endif
    										</tr>
    										@endforeach
                      </tbody>
                        </table>
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
<script src="{{ asset('adm/js/plugins/moment.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/datatables.bootstrap.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/jquery.nicescroll.js')}}"></script>

<script src="{{ asset('adm/js/main.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatables-example').DataTable();
  });
</script>
@endsection
