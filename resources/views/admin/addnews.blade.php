@extends('admin.adminmaster')


@section('navbar')
<title>{{ trans('app.addnews')}}</title>


	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="span9">
					<div class="content">
						<div class="module">
							<div class="module-head">
								<h3>Add News</h3>
							</div>
							<div class="module-body">
									<br />
									@if(Session::has('newsadded'))
										<center>
											<div class="col-md-4" style="width:90%;">
												<div class="alert alert-success">
													{{Session::get('newsadded')}}
												</div>
											</div>
										</center>
									@endif

									<!-- I have an error here -->
									<form class="form-horizontal row-fluid" action="/adm/addnews" method="post" enctype="multipart/form-data">
										{{csrf_field()}}
										<div class="control-group">
											<label class="control-label" for="news_title">News Title</label>
											<div class="controls">
												<input type="text" id="basicinput" maxlength="100" placeholder="Type name here..." maxlength="150" class="span8" name="news_title" maxlength="150" required="">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="news_body">More Detail</label>
											<div class="controls">
												<textarea class="span8" rows="5" name="news_body" required placeholder="add more details about the news..."></textarea>
											</div>
										</div>
										<br>
								<div class="control-group">
										<label class="control-label" for="basicinput">Select image to upload</label>
										<div class="controls">
											<input type="file" name="news_image_1" /><br><br>
											<input type="file" name="news_image_2" /><br><br>
											<input type="file" name="news_image_3" />

								 					</div>
								 			</div>
										<div class="control-group">
											<div class="controls">
												<button type="submit" class="btn btn-success" style="float:right;margin-right:18%;">Share</button>
											</div>
										</div>
									</form>
							</div>
						</div>

						<br><br>


						<div class="module">
							<div class="module-body table" >
								@if(Session::has('newsdeleted'))
									<center>
										<div class="col-md-4" style="width:90%;">
											<div class="alert alert-success">
												{{Session::get('newsdeleted')}}
											</div>
										</div>
									</center>
								@endif
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" >
									<thead>
										<tr style="font-size:11px;">
											<th style="text-transform:capitalize;">News Title</th>
											<th style="text-transform:capitalize;">Creation Date</th>
											<th style="text-transform:capitalize;">Image 1</th>
											<th style="text-transform:capitalize;">Image 2</th>
											<th style="text-transform:capitalize;">Image 3</th>
											<th><center>X</center></th>
										</tr>
									</thead>
									<tbody>
										@php
										$news = App\News::orderBy('created_at','desc')->get()
										@endphp
										@foreach($news as $news)
										<tr class="odd gradeX" style="font-size:11px;">
											<td>
												{{$news->news_title}}
											</td>
											<td>
												{{$news->created_at->diffForHumans()}}
											</td>
											<td>
												{{$news->news_image_1}}
											</td>
											<td>
												{{$news->news_image_2}}
											</td>
											<td>
												{{$news->news_image_3}}
											</td>
											<td>
												<a class="btn btn-danger"  data-toggle="modal" data-target="#basicModal-{{$news->id}}">{{ trans('app.delete')}}</a>
												<div class="modal fade" id="basicModal-{{$news->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
												<div class="modal-dialog" >
													<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
														<div class="modal-header" style="background-color:white;">
															Are you sure to delete <i>{{$news->news_title}}</i>?
														</div>
															<div class="modal-footer">
																	<button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
																	<a href="/adm/newsdelete/{{$news->id}}"  class="btn btn-primary">Yes</a>
															</div>
													</div>
												</div>
												</div>

											</td>
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr style="font-size:11px;">
											<th style="text-transform:capitalize;">News Title</th>
											<th style="text-transform:capitalize;">Creation Date</th>
											<th style="text-transform:capitalize;">Image 1</th>
											<th style="text-transform:capitalize;">Image 2</th>
											<th style="text-transform:capitalize;">Image 3</th>
											<th><center>X</center></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>

					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

@endsection
