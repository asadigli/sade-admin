<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="Permission required">
  <meta name="author" content="Sade Store Administration">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex,nofollow">
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
  <title>{{ ucwords(trans('app.login'))}}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/font-awesome.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/simple-line-icons.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/icheck/skins/flat/aero.css')}}"/>
  <link href="{{ asset('adm/css/style.css')}}" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('images/logo-dark.png')}}">
</head>
    <body id="mimin">
      <div class="container">
        <form class="form-signin" method="post" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="panel periodic-login">
              <div class="panel-body text-center">
                <h3 class="capi"> <b>{{ trans('app.login')}}</b> </h3>
                <hr><br>
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} form-animate-text">
                    <input name="email" type="email" id="email" placeholder="E-mail..." class="form-text" value="{{ old('email') }}" autofocus required autocomplete="off">
                    <span class="bar"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong style="color:white;">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} form-animate-text" style="margin-top:40px !important;">
                    <input  name="password" id="password" placeholder="Password..." type="password"  class="form-text" required>
                    <span class="bar"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                  <label class="pull-left">
                    <input type="checkbox" class="icheck pull-left" name="remember" value="forever" id="rememberme" {{ old('remember') ? 'checked' : '' }}/> Remember me
                  </label>
                  <input type="submit" class="btn col-md-12" value="Sign In"/>
              </div>
          </div>
        </form>
      </div>
<script src="/adm/js/jquery.min.js"></script>
<script src="/adm/js/jquery.ui.min.js"></script>
<script src="/adm/js/bootstrap.min.js"></script>
<script src="/adm/js/plugins/moment.min.js"></script>
<script src="/adm/js/plugins/icheck.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_flat-aero',
    radioClass: 'iradio_flat-aero'
  });
});
</script>
</body>
</html>
