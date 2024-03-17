@extends('layouts.master')

@section('css')
<title>{{ ucwords(trans('app.verifiedcomments'))}}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/datatables.bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
@endsection
@section('body')
  <div id="content">
    <div class="panel box-shadow-none content-header">
      <div class="panel-body">
        <div class="col-md-12">
          <h3 class="animated fadeInLeft">Verified Comments</h3>
            <p class="animated fadeInDown">
              List <span class="fa-angle-right fa"></span> Verified Comments
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Verified Comments <small><a href="/unverified">{{ trans('app.unverifiedcomments')}}</a></small> </h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
        								@include('layouts.alerts')
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr class="capi">
    											<th>{{ trans('app.commenter_name')}}</th>
    											<th>{{ trans('app.comment')}}</th>
    											<th>{{ trans('app.post')}}/{{ trans('app.news')}}</th>
    											<th>{{ trans('app.date')}}</th>
    											<th>X</th>
                        </tr>
                      </thead>
                      <tbody>
    										@foreach($newscomment = App\Newscomment::where('verify','=',1)->orderBy('created_at','desc')->get() as $nsc)
    										<tr class="odd gradeX">
    											<td> {{$nsc->name}} {{$nsc->surname}}</td>
    											<td>{{substr(($nsc->message),0,50)}}
    												@if(strlen($nsc->message) > 50)
    												...
    												@endif
    											</td>
    											<td>
    												@if($nsc->news_id != 0)
      												@foreach($ne = App\News::where('id','=',[$nsc->news_id])->get() as $ne)
      														<a href="/news/{{$nsc->news_id}}" style="color:green;">{{ str_limit($ne->news_title, $limit = 50, $end = '...') }}</a>
      												@endforeach
    												@endif
    												@if($nsc->news_id == 0)
      												@foreach($prodd = App\ProductDetails::where('id','=',[$nsc->product_id])->get() as $p)
      												 <a href="https://sade.store/product-details/{{$p->slug}}" target="_blank">{{ str_limit($p->productname, $limit = 50, $end = '...') }}</a>
      												@endforeach
    												@endif
    											</td>
    											<td>{{$nsc->created_at->diffForHumans()}}</td>
    											<td>
    												<button class="btn btn-primary" data-toggle="modal" data-target="#more-{{$nsc->id}}" style="text-transform:capitalize;">{{ trans('app.more')}}</button>&nbsp; <br><br>
    												<button class="btn btn-success" data-toggle="modal" data-target="#vip-{{$nsc->id}}">{{ trans('app.make_it_vip')}}</button>
    												<div class="modal fade" id="more-{{$nsc->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
      												<div class="modal-dialog" >
      													<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
      														<div class="modal-header" style="background-color:white;">
      															{{ trans('app.comment')}}, <i><span style="color:gray;">{{ trans('app.by')}}{{$nsc->name}} {{$nsc->surname}}</span></i>
      														</div>
      														<div class="modal-body" style="background-color:white;color:black;"><p>{{$nsc->message}}</p><b style="color:red;">{{$nsc->user_ip}}</b></div>
      															<div class="modal-footer">
      																	<button type="reset" class="btn btn-success" data-dismiss="modal">{{ trans('app.cancel')}}</button>
      																	<a href="/rejectnewscomment/{{$nsc->id}}" class="btn btn-danger">{{ trans('app.delete')}}</a>
      															</div>
      													</div>
      												</div>
    												</div>
    												<div class="modal fade" id="vip-{{$nsc->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
    												<div class="modal-dialog" >
    													<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
    														<div class="modal-header" style="background-color:white;">
    															{{ trans('app.comment')}}, <i><span style="color:gray;">{{ trans('app.by')}} {{$nsc->name}} {{$nsc->surname}}</span></i>
    														</div>
    														<div class="modal-body" style="background-color:white;color:black;">
    															<p>{{$nsc->message}}</p></div>
    															<div class="modal-footer">
    																<form class="" action="/addvipcomment" method="POST">
    																	{{ csrf_field() }}
    																	<input type="hidden" name="message" value="{{ $nsc->message}}">
    																	<input type="hidden" name="name" value="{{ $nsc->name}}">
    																	<input type="hidden" name="surname" value="{{ $nsc->surname}}">
    																	<input type="hidden" name="rating" value="{{ $nsc->rating}}">
    																	<button class="btn btn-success" type="submit">{{ trans('app.make_it_vip')}}</button>&nbsp;
    																</form>
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
@endsection
@section('js')
<script src="{{ asset('adm/js/jquery.min.js')}}"></script>
<script src="{{ asset('adm/js/jquery.ui.min.js')}}"></script>
<script src="{{ asset('adm/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/moment.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/datatables.bootstrap.min.js')}}"></script>
<script src="{{ asset('adm/js/plugins/jquery.nicescroll.js')}}"></script>
<script src="{{ asset('adm/js/main.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatables-example').DataTable();
  });
</script>
@endsection
