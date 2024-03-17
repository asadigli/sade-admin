@extends('master')

@section('sidebar')
<!-- Sidebar ================================================== -->

<!-- Sidebar end=============================================== -->
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="/">Home</a> <span class="divider">/</span></li>
		<li class="active">Forget password?</li>
    </ul>
	<h3> FORGET YOUR PASSWORD?</h3>
	<hr class="soft"/>

	<div class="row">
		<div class="span9" style="min-height:900px">
			<div class="well">
			<h5>Reset your password</h5><br/>
			Please enter the email address for your account. A verification code will be sent to you. Once you have received the verification code, you will be able to choose a new password for your account.<br/><br/><br/>






				<div class="panel-body">
						@if (session('status'))
								<div class="alert alert-success">
										{{ session('status') }}
								</div>
						@endif

						<form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
								{{ csrf_field() }}

								<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
										<label for="email" class="control-label">E-Mail Address</label>

										<div class="col-md-6">
												<input id="email" type="email" class="span3" name="email" value="{{ old('email') }}" style="margin-right:70%;" required>

												@if ($errors->has('email'))
														<span class="help-block">
																<strong>{{ $errors->first('email') }}</strong>
														</span>
												@endif
										</div>
								</div><br><br>

								<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
												<button type="submit" class="btn btn-primary">
														Send Password Reset Link
												</button>
										</div>
								</div>
						</form>
				</div>

		</div>
		</div>
	</div>


@endsection
