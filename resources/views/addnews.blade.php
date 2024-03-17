@extends('layouts.master')

@section('css')
    <title class="capi">{{ ucwords(trans('app.addnews'))}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/icheck/skins/flat/red.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/normalize.css')}}"/>
@endsection
@section('body')
    <div id="content">
			<br>
        @if(Session::has('success'))
          <center>
            <div class="col-md-4" style="width:100%;">
              <div class="alert alert-primary">
                {{Session::get('success')}}
              </div>
            </div>
          </center>
        @endif
			<div class="form-element">
				<div class="col-md-12 padding-0">
					<div class="col-md-12">
						<div class="panel form-element-padding">
							<div class="panel-heading capi">
							 <h4>{{ trans('app.add_news')}}</h4>
							</div>
							 <div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">
                    <form class="form-horizontal row-fluid" action="/addnews" method="post" enctype="multipart/form-data">
    										{{csrf_field()}}
    										<div class="form-group">
    											<label class="col-sm-2 control-label text-right" for="news_title">News Title</label>
    											<div class="col-sm-10">
    												<input class="form-control" type="text" maxlength="100" placeholder="Type name here..." maxlength="150" name="news_title" maxlength="150" required="">
    											</div>
    										</div>
    										<div class="form-group">
    											<label class="col-sm-2 control-label text-right" for="news_body">More Detail</label>
    											<div class="col-sm-10">
    												<textarea name="news_body" placeholder="Add more details about the news..."></textarea>
    											</div>
    										</div>
    								   <div class="form-group">
    										<label class="col-sm-2 control-label text-right">Select image to upload</label>
    										<div class="col-sm-10">
    											<input class="form-control" type="file" name="pictures[]" multiple><br><br>
                        </div>
    								 	</div>
    										<div class="form-group">
                          <label class="col-sm-2 control-label text-right"></label>
    											<div class="col-sm-10">
    												<button type="submit" class="btn btn-success pull-right capi">{{ trans('app.share')}}</button>
    											</div>
    										</div>
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
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('adm/js/tinymce.js')}}"></script>
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
