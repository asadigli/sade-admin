@extends('admin.adminmaster')

@section('navbar')
<div class="wrapper">
    <div class="container">
        <div class="row">
            <!--/.span3-->
            <div class="span9">
                <div class="content">
                  <div class="module">
                      <div class="module-head">
                          <h3 style="text-transform:capitalize;">
                              {{ trans('app.addnewuser')}}</h3>
                      </div>
                      <div class="module-body table">
                        @if(Session::has('user_added'))
                  				<center>
                  					<div class="col-md-4" style="width:90%;">
                  						<div class="alert alert-success">
                  							{{Session::get('user_added')}}
                  						</div>
                  					</div>
                  				</center>
                  			@endif
                      <form class="form-horizontal row-fluid"  method="POST" action="/adm/adduser">
                          {{ csrf_field() }}

                        <div class="control-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label class="control-label" style="text-transform:capitalize;">{{ trans('app.name')}}</label>
                          <div class="controls">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="{{ trans('app.name')}}..." class="span8" required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="control-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                          <label class="control-label" style="text-transform:capitalize;">{{ trans('app.surname')}}</label>
                          <div class="controls">
                            <input type="text" id="surname" name="surname" value="{{ old('surname') }}" placeholder="{{ trans('app.surname')}}..." class="span8" required>
                            @if ($errors->has('surname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="control-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label class="control-label" style="text-transform:capitalize;">{{ trans('app.email')}}</label>
                          <div class="controls">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('app.email')}}..." class="span8" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" style="text-transform:capitalize;">{{ trans('app.position')}}</label>
                          <div class="controls">
                            <select class="form-control" id="role" name="role_id" required>
                              <option value="1" style="text-transform:capitalize;">{{ trans('app.simpleuser')}}</option>
                              <option value="2" style="text-transform:capitalize;">{{ trans('app.admin')}}</option>
                              <option value="3" style="text-transform:capitalize;">{{ trans('app.secondadmin')}}</option>
                              <option value="4" style="text-transform:capitalize;">{{ trans('app.mainadmin')}}</option>
                            </select>

                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" style="text-transform:capitalize;">{{ trans('app.gender')}}</label>
                          <div class="controls">
                            <select class="form-control" name="gender" style="width:100px;" required>
                              <option value="1" style="text-transform:capitalize;">{{ trans('app.male')}}</option>
                              <option value="2" style="text-transform:capitalize;">{{ trans('app.female')}}</option>
                            </select>
                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" style="text-transform:capitalize;">{{ trans('app.birthday')}}</label>
                          <div class="controls">
                            <input type="date" name="dob" max="2004-12-31" class="form-control" required>
                              @if ($errors->has('dob'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('dob') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="control-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label class="control-label" style="text-transform:capitalize;">{{ trans('app.password')}}</label>
                          <div class="controls">
                            <input type="password" id="password" name="password" placeholder="{{ trans('app.password')}}..." class="span8" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" style="text-transform:capitalize;">{{ trans('app.confirm_password')}}</label>
                          <div class="controls">
                            <input type="password" id="password-confirm" name="password_confirmation" placeholder="{{ trans('app.confirm_password')}}..." class="span8" required>

                          </div>
                        </div>
                        <div class="control-group">
                          <div class="controls">
                            <input type="submit" name="submit" value="{{ trans('app.createuser')}}" class="btn btn-primary">
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
