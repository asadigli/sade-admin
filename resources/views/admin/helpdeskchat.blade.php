@extends('admin.adminmaster')


@section('navbar')
<title>{{ trans('app.helpdeskchat')}}</title>

<script src="///ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">

</script>
	<div class="wrapper">
		<div class="container">
			<div class="row">

				<div class="span9">
					<div class="content">

						<div class="module" style="box-shadow:1px 1px 1px 1px gray;">
							<div class="module-head">
								<h3>Cavablandır</h3>
							</div>
							<div class="module-body">
									<br />
									@if(Session::has('replysuccess'))
										<center>
											<div class="col-md-4" style="width:90%;">
												<div class="alert alert-success">
													{{Session::get('replysuccess')}}
												</div>
											</div>
										</center>
									@endif

									<!-- I have an error here -->
									<form class="form-horizontal row-fluid" action='/adm/helpdesk/reply' method="post">
										<div class="control-group">
											<label class="control-label" for="">bashliq</label>
											<div class="controls">
												@php
													$helpdesklist = App\Helpdesklist::all()
												@endphp
												@foreach($helpdesklist as $hlpl)
													@if(($helpdesk->problem_id)==0)

													<b>Rəy,Post, Məhsul və ya şəxs şikayəti</b>
													@elseif(($hlpl->id)==($helpdesk->problem_id))
														@if(!count($hlpl->problem_list)==0)
															<b>{{$hlpl->problem_list}}</b>
														@else
															<b>No Mentioned problem title</b>
														@endif
													@endif
												@endforeach
											</div>
										</div>
										<input type="hidden" name="reply_user_id" value="{{$helpdesk->user_id}}">
										<input type="hidden" name="problem_id" value="{{$helpdesk->problem_id}}">
										<input type="hidden" name="item_id" value="{{$helpdesk->item_id}}">
										<input type="hidden" name="problem_title" value="{{$helpdesk->problem_title}}">
										<input type="hidden" name="reply_id" value="{{$helpdesk->id}}">
										<!-- <input type="hidden" name="problem_body" value="{{$helpdesk->problem_body}}"> -->
										<hr><div class="control-group">
											<label class="control-label" for="">Başlıq</label>
											<div class="controls">
												@php
												$user = App\User::all()
												@endphp
												@foreach($user as $user)
													@if(($user->id)==($helpdesk->user_id))
														<a href="{{ route('userprofile', $user->id)}}">{{$user->name}} {{$user->surname}}</a>
													@else
														{{$helpdesk->user_email}}
													@endif
												@endforeach
											</div>

										</div>
										<div class="control-group">
											<label class="control-label" for="">Başlıq</label>
											<div class="controls">
												{{$helpdesk->problem_title}}
											</div>

										</div>
										<div class="control-group">
											<label for="" class="control-label">Məsələ</label>
											<div class="controls">
													{{$helpdesk->problem_body}}

											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="name">Cavablandırmaq</label>
											<div class="controls">
												{{ csrf_field() }}
												<input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
												<!-- <input type="text" id="catlist" name="problem_list" placeholder="Type problem name here..." class="span8" required="" minlength="3"> -->
												<textarea name="problem_body" rows="8" cols="80" placeholder="Yaz..." style="width:90%;"></textarea>

												<!-- <span class="help-inline" style="color: red; font-size: 10px;"><i>* Minimum 3 Characters</i></span> -->
												<input type="hidden" name="_token" value="{{csrf_token()}}">
												<br><br>
												<input type="submit" name="submit" value="Göndər" class="btn-success" style="float:right;">
											</div>
										</div>
									</form>
							</div>
						</div>




					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

@endsection
