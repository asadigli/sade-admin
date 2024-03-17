@extends('layouts.master')

@section('css')
    <title>{{ucwords(trans('app.contacts'))}}</title>
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
							<div class="panel-heading">
							 <h4>Problem Əlavə et</h4>
							</div>
							 <div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">
									@include('layouts.alerts')
									<form class="" action="/addproblem" method="post">
										{{ csrf_field() }}
										<div class="form-group"><label class="col-sm-2 control-label text-right">Normal</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" placeholder="Type problem here..." name="problem_list" required>
											</div>
											<br><br><br><br>
											<input type="submit" name="submit" value="Add" class="btn btn-success pull-right">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><br>
			<div class="form-element">
				<div class="col-md-12 padding-0">
					<div class="col-md-12">
						<div class="panel form-element-padding">
							<div class="panel-heading">
							 <h4>Problem Siyahısı</h4>
							</div>
							 <div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">
										<div class="form-group">
											<div class="col-sm-10">
												<select class="form-control">
													<option value="">Select</option>
                          @php
                          $helpdesklist = App\Helpdesklist::all()
                          @endphp
													@foreach($helpdesklist as $help)
														<option value="{{$help->id}}">{{$help->problem_list}}</option>
													@endforeach
												</select>
											</div>
										</div>
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
