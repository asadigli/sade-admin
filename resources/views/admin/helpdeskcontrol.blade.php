@extends('admin.adminmaster')


@section('navbar')
<title>{{ trans('app.helpdeskcontrol')}}</title>

<script src="///ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">

</script>
<link rel="stylesheet" href="/css/pagination.css">
<div class="wrapper">
		<div class="container">
				<div class="row">

						<!--/.span3-->
						<div class="span9">
								<div class="content">
										<div class="module message">
												<div class="module-head">
														<h3>
																Message</h3>
												</div>
												<div class="module-option clearfix">
														<div class="pull-left">
																<div class="btn-group">
																		<button class="btn">
																				Inbox</button>
																		<button class="btn dropdown-toggle" data-toggle="dropdown">
																				<span class="caret"></span>
																		</button>
																		<ul class="dropdown-menu">
																				<li><a href="#">Inbox
																				@if(empty($helpdesk->reply_user_id))
																					({{count($helpdesk)}})
																				@endif</a></li>
																				<li><a href="#">Replied(
																				@if(!empty($helpdesk->reply_user_id))
																					{{count($helpdesk)}}
																				@endif)</a></li>
																				<li><a href="#">Draft</a></li>
																				<li><a href="#">Trash</a></li>
																				<li class="divider"></li>
																				<li><a href="#">Settings</a></li>
																		</ul>
																</div>
														</div>
														<div class="pull-right">
															<!-- <button class="btn btn-primary" ><i class="fa fa-bug" style="height:20px;"></i></button> -->

																<a data-toggle="modal" data-target="#Modalboost" class="btn btn-primary">Compose</a>
														</div>
												</div>



												<div class="modal fade" id="Modalboost" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
													<div class="modal-dialog" >
														<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
															<div class="modal-header">
																 Mesaj yaz
															</div>
															<form class="" action="/sendproblem" method="post">
																<div class="modal-body" style="background-color:white;">
																	<!-- <input type="text" name="problem_id" value="0"> -->
																	@php
																	$user = App\User::all()
																	@endphp
																	<span style="color:black;font-size:14px;">Kimə:</span>
																	<select class="" name="reply_user_id" required>
																		@foreach($user as $user)
																		<option value="{{$user->id}}">{{$user->email}}</option>
																		@endforeach
																	</select><br>
																	<span style="color:black;font-size:14px;">Başlıq:</span> <input type="text" name="problem_title" required><br>


																	@if (Route::has('login'))
																	@if (Auth::check())
																	<input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
																	@endif
																	@endif
																	<textarea placeholder="Yaz..." name="problem_body" rows="8" cols="130" style="width:90%;" required></textarea>
																</div>
																<div class="modal-footer">
																	<input type="hidden" name="_token" value="{{ csrf_token() }}">
																	<button type="submit" class="btn btn-primary">Göndər</button>
																</div>
															</form>
														</div>
													</div>
												</div>



												<div class="module-body table">
														<table class="table table-message">
																<tbody>
																		<tr class="heading">
																				<td class="cell-check">
																					{{ trans('app.sender')}}
																						<!-- <input type="checkbox" class="inbox-checkbox"> -->
																				</td>
																				<td class="cell-icon">
																					{{ trans('app.email')}}
																				</td>
																				<td class="cell-author hidden-phone hidden-tablet">
																						{{ trans('app.title')}}
																				</td>
																				<td class="cell-title">
																						{{ trans('app.body')}}
																				</td>

																				<td class="cell-icon hidden-phone hidden-tablet">
																				</td>
																				<td class="cell-time align-right">
																						{{ trans('app.date')}}
																				</td>
																		</tr>
																		@foreach($contact as $ct)
																			<tr class="unread">
																						<!-- <tr class="unread starred"> -->
																				<td class="cell-check">
																					{{$ct->name }} {{$ct->surname}}
																						<!-- <a href=""><button class="btn">Reply</button> -->
																				</td>
																				<td class="cell-icon">
																						<i class="icon-star"></i> {{$ct->email}}
																				</td>
																				<td class="cell-author hidden-phone hidden-tablet">
																						{{$ct->problem_title}}
																				</td>
																				<td class="cell-title">
																						<i></i> {{$ct->problem_body}}
																				</td>
																				<td class="cell-icon hidden-phone hidden-tablet">
																						<i class="icon-paper-clip"></i>
																				</td>
																				<td class="cell-time align-right">
																					{{$ct->created_at}}
																				</td>
																		</tr>
																	@endforeach
															</tbody>
														</table>
												</div>
												<div class="module-foot">
													<center>{{ $contact->links()}}</center>
												</div>
										</div>

						<div class="module">
							<div class="module-head">
								<h3>Problem Əlavə et</h3>
							</div>
							<div class="module-body">
									<br />
									@if(Session::has('succ1'))
										<center>
											<div class="col-md-4" style="width:90%;">
												<div class="alert alert-success">
													{{Session::get('succ1')}}
												</div>
											</div>
										</center>
									@endif

									<!-- I have an error here -->
									<form class="form-horizontal row-fluid" action='/adm/addproblem' method="post">
										<div class="control-group">
											<label class="control-label" for="name">Problem Siyahısı</label>
											<div class="controls">
												{{ csrf_field() }}


												<input type="text" name="problem_list" placeholder="Type problem name here..." class="span8" required="" minlength="3">
												<br><br><span class="help-inline" style="color: red; font-size: 10px;"><i>* Minimum 3 Characters</i></span>
												<input type="hidden" name="_token" value="{{csrf_token()}}">
												<br><br>
												<input type="submit" name="submit" value="Add" class="btn-success">
											</div>
										</div>
									</form>
							</div>
						</div>


						<div class="module">
							<div class="module-head">
								<h3>Problem List</h3>
							</div>
							<div class="module-body">
									<br />
									<div class="control-group">
										<center>
									<select class="" name="" style="width:600px;">
										<option value="">Select</option>
										@foreach($helpdesklist as $help)
											<option value="{{$help->id}}">{{$help->problem_list}}</option>
										@endforeach
									</select>
								</center>
									<hr>
								</div>
							</div>
						</div>
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

@endsection
