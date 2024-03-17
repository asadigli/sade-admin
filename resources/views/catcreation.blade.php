@extends('layouts.master')

@section('css')
    <title class="capi">{{ ucwords(trans('app.categorycreation'))}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/icheck/skins/flat/red.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/normalize.css')}}"/>
@endsection
@section('body')
    <div id="content">
			<br>
      <div class="form-element">
				<div class="col-md-12 padding-0">
					<div class="col-md-12">
						<div class="panel form-element-padding">
							<div class="panel-heading capi">
							 <h4>
                 <a href="/catlists">{{ trans('app.category_list')}}</a>
               </h4>
							</div>
            </div>
          </div>
        </div>
      </div>
      @include('layouts.alerts')
      <br>
			<div class="form-element">
				<div class="col-md-12 padding-0">
					<div class="col-md-12">
						<div class="panel form-element-padding">
							<div class="panel-heading capi">
							 <h4>{{ trans('app.add_category')}}</h4>
							</div>
							 <div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">
                    <form class="form-horizontal row-fluid" action='/addnewcat' method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
    										<div class="form-group">
    											<label class="col-sm-2 control-label text-right" for="name">{{ trans('app.category_name')}}</label>
    											<div class="col-sm-10">
    												<input type="text" id="catlist" name="name" placeholder="Type category name here..." class="form-control" required maxlength="60" minlength="3">
                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong class="red">{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
    											</div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label text-right" for="name">{{ trans('app.image')}}</label>
    											<div class="col-sm-10">
                              <input type="file" name="poster" class="form-control capi">
                            <br>
    											</div>
    										</div>
                      <div class="form-group">
  											<label class="col-sm-2 control-label text-right"></label>
  											<div class="col-sm-10">
  												<input type="submit" name="submit" value="{{ trans('app.add')}}" class="btn btn-success pull-right">
  											</div>
  										</div>
  									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
      <br>
			<div class="form-element">
				<div class="col-md-12 padding-0">
					<div class="col-md-12">
						<div class="panel form-element-padding">
							<div class="panel-heading capi">
							 <h4>{{ trans('app.add_sub_category')}}</h4>
							</div>
							 <div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">
                  <form class="form-horizontal row-fluid" action='/addnewsubcat' method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label class="col-sm-2 control-label text-right" for="name">{{ trans('app.category_name')}}</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="parent_id" id="parent_id" placeholder="Category" required="Choose a category">
                          <option value="">Choose Category</option>
                          @foreach($category as $cat)
                          <option value="{{$cat->id}}">{{$cat->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label text-right" for="name">{{ trans('app.subcategory_name')}}</label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" id="subname" name="subname" placeholder="Type sub-category name here..." required maxlength="60" minlength="3">
                          @if ($errors->has('subname'))
                              <span class="help-block">
                                  <strong class="red">{{ $errors->first('subname') }}</strong>
                              </span>
                          @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label text-right capi" for="name">{{ trans('app.image')}}</label>
                      <div class="col-sm-10">
                          <input type="file" name="poster" class="form-control">
                        <br>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label text-right"></label>
                      <div class="col-sm-10">
                        <input type="submit" name="submit" value="{{ trans('app.add')}}" class="btn btn-success pull-right">
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
