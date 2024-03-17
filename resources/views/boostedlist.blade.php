@extends('layouts.master')

@section('css')
    <title class="capi">{{ ucwords(trans('app.boostedlist'))}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/icheck/skins/flat/red.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/normalize.css')}}"/>
@endsection

@section('body')
    <div id="content"><br>
      @if(Session::has('success'))
      <br>
        <center>
          <div class="col-md-4" style="width:100%;">
            <div class="alert alert-success">
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
							 <h4>{{ trans('app.addposter')}}</h4>
							</div>
							 <div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">
                    <form enctype="multipart/form-data" action="/addposter" method="post">
    									{{ csrf_field()}}
                      <div class="form-group">
  											<label class="col-sm-2 control-label text-right capi" for="product_id">{{ trans('app.product')}}</label>
  											<div class="col-sm-10">
                          <select class="form-control" name="product_id">
        										<option value="0" selected>{{ trans('app.empty')}}</option>
        										@php
        										$productdetails = App\ProductDetails::all();
        										@endphp
        										@foreach($productdetails as $prodet)
        										<option value="{{$prodet->id}}" name="product_id">{{substr($prodet->productname,0,15)}}... <i>ID: {{$prodet->id}}</i></option>
        										@endforeach
        									</select>
  											</div>
  										</div><br><br><hr>
                      <div class="form-group">
  											<label class="col-sm-2 control-label text-right capi" for="item_id">{{ trans('app.news')}}</label>
  											<div class="col-sm-10">
        									<select class="form-control" name="item_id">
        										<option value="0" selected>{{ trans('app.select_news')}}</option>
        										@php
        										$news = App\News::all()
        										@endphp
        										@foreach($news as $news)
        										<option value="{{$news->id}}" >{{substr($news->news_title,0,15)}}...</option>
        										@endforeach
        									</select>
  											</div>
  										</div><br><br><hr>
                      <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                      <div class="form-group">
  											<label class="col-sm-2 control-label text-right capi" for="time">{{ trans('app.set_time')}}</label>
  											<div class="col-sm-10">
        									<input class="form-control" type="number" name="time" required>
  											</div>
  										</div><br><br><hr>
                      <div class="form-group">
  											<label class="col-sm-2 control-label text-right capi" for="poster">{{ trans('app.choose_image')}}</label>
  											<div class="col-sm-10">
                          <input class="form-control" type="file" name="poster" required>
  											</div>
  										</div><br><br><hr>
                      <div class="form-group">
  											<label class="col-sm-2 control-label text-right capi"></label>
  											<div class="col-sm-10">
                          <button type="submit" class="btn btn-primary pull-right capi" name="submit">{{ trans('app.create_poster')}}</button><br>
  											</div>
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
							<div class="panel-heading capi">
							 <h4>{{ trans('app.boostedlist')}}</h4>
							</div>
							 <div class="panel-body" style="padding-bottom:30px;">
								<div class="col-md-12">
  							@if(Session::has('deletedposter'))
  							<br>
  								<center>
  									<div class="col-md-4" style="width:100%;">
  										<div class="alert alert-success">
  											{{Session::get('deletedposter')}}
  										</div>
  									</div>
  								</center>
  							@endif
  								<table class="table table-bordered">
  									<thead>
  										<tr class="capi">
  											<th>{{ trans('app.empty')}}</th>
  											<th>{{ trans('app.productname')}}</th>
  											<th>{{ trans('app.news_title')}}</th>
  											<th>{{ trans('app.period')}}</th>
  											<th>{{ trans('app.boostdate')}}</th>
  											<th>X</th>
  										</tr>
  									</thead>
  									<tbody>
    									@php
  											$poster = App\Poster::all()
  										@endphp
  										@php($total = 0)
  										@php($total1=0)
  										@foreach($poster as $prod)
  										<tr>
  											<td>
  												@if($prod->product_id == 0)
  													{{ trans('app.empty')}}
  												@else
  												   <span style="color:red;">X</span>
  												@endif
  											</td>
  											<td>
  												<a href="https://sade/store/product_details/{{$prod->product_id}}">
    												@php
    												  $product = App\ProductDetails::where('id','=',[$prod->product_id])->get()
    												@endphp
    												@foreach($product as $prr)
    													{{$prr->productname}}
    												@endforeach
    												@if($prod->product_id == 0)
    													<span class="red">X</span>
    												@endif
    											</a>
  											</td>
  											<td>
  												<a href="https://sade/store/news/{{$prod->item_id}}">
  													@php
  														$news = App\News::where('id','=',[$prod->item_id])->get()
  													@endphp
  													@foreach($news as $ns)
  														{{$ns->news_title}}
  													@endforeach
  													@if($prod->product_id == 0)
  														<span class="red">X</span>
  													@endif
  												</a>
  											</td>
  											<td>{{$prod->time}} days </td>
  											<td>{{$prod->created_at->diffForHumans()}}</td>
  											<td>
  													<a href="" data-toggle="modal" data-target="#posterdelete-{{$prod->id}}" class="btn btn-danger">
  															<i class="fa fa-trash"></i></a>
  																		<div class="modal fade" id="posterdelete-{{$prod->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
  																		<div class="modal-dialog" >
  																			<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
  																				<div class="modal-header" style="background-color:white;">
  																					Are you sure to delete this poster?
  																				</div>
  																					<div class="modal-footer">
  																							<button type="reset" class="btn btn-primary" data-dismiss="modal">{{trans('app.no')}}</button>
  																							<a href="/deleteposter/{{ $prod->id }}" class="btn btn-danger">{{trans('app.yes')}}</a>
  																					</div>
  																			</div>
  																		</div>
  																		</div>
  																</td>
  															</tr>
  															@endforeach
  											</tbody>
  										</table>
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
