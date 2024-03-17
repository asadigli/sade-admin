@extends('layouts.master')

@section('css')
    <title class="capi">{{ ucwords(trans('app.addnewuser'))}}</title>
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
							 <h4>{{ trans('app.addnewuser')}}</h4>
							</div>
							 <div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">
                  @if(Session::has('user_added'))
                    <center>
                      <div class="col-md-4" style="width:100%;">
                        <div class="alert alert-success">
                          {{Session::get('user_added')}}
                        </div>
                      </div>
                    </center>
                  @endif
                      <form class="form-horizontal row-fluid"  method="POST" action="/adduser">
                          {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label class="col-sm-2 control-label text-right capi">{{ trans('app.name')}}</label>
                          <div class="col-sm-10">
                            <input class="form-control capi" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="{{ trans('app.name')}}..." required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                          <label class="col-sm-2 control-label text-right capi">{{ trans('app.surname')}}</label>
                          <div class="col-sm-10">
                            <input class="form-control capi" type="text" id="surname" name="surname" value="{{ old('surname') }}" placeholder="{{ trans('app.surname')}}..." class="span8" required>
                            @if ($errors->has('surname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label class="col-sm-2 control-label text-right capi">{{ trans('app.email')}}</label>
                          <div class="col-sm-10">
                            <input class="form-control capi" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('app.email')}}..." required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label text-right capi">{{ trans('app.position')}}</label>
                          <div class="col-sm-10">
                            <select class="form-control capi" id="role" name="role_id" required>
                              <option value="1">{{ trans('app.simpleuser')}}</option>
                              <option value="2">{{ trans('app.admin')}}</option>
                              <option value="3">{{ trans('app.secondadmin')}}</option>
                              <option value="4">{{ trans('app.mainadmin')}}</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label text-right capi">{{ trans('app.gender')}}</label>
                          <div class="col-sm-10">
                            <select class="form-control capi" name="gender" required>
                              <option value="1">{{ trans('app.male')}}</option>
                              <option value="2">{{ trans('app.female')}}</option>
                            </select>
                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label text-right capi">{{ trans('app.birthday')}}</label>
                          <div class="col-sm-10">
                            <input type="date" name="dob" max="2004-12-31" class="form-control" required>
                              @if ($errors->has('dob'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('dob') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label class="col-sm-2 control-label text-right capi">{{ trans('app.password')}}</label>
                          <div class="col-sm-10">
                            <input class="form-control capi" type="password" id="password" name="password" placeholder="{{ trans('app.password')}}..." required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label text-right capi">{{ trans('app.confirm_password')}}</label>
                          <div class="col-sm-10">
                            <input class="form-control capi" type="password" id="password-confirm" name="password_confirmation" placeholder="{{ trans('app.confirm_password')}}..." required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label"></label>
                          <div class="col-sm-10">
                            <input class="btn btn-primary capi pull-right" type="submit" name="submit" value="{{ trans('app.createuser')}}">
                          </div>
                        </div>
                        <br>
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
@endsection
