@extends('layouts.master')

@section('css')
<title>{{ ucwords(trans('app.unverifiedcomments'))}}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/datatables.bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
@endsection
@section('body')
  <div id="content">
    <div class="panel box-shadow-none content-header">
      <div class="panel-body">
        <div class="col-md-12">
          <h3 class="animated fadeInLeft">Unverified Comments</h3>
              <p class="animated fadeInDown">
              List <span class="fa-angle-right fa"></span> Unverified Comments
              </p>
          </div>
        </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Unverified Comments <small><a href="/verified">{{ trans('app.verifiedcomments')}}</a></small> </h3></div>
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
    										@foreach($newscomment = App\Newscomment::where('verify','=',0)->orderBy('created_at','desc')->get() as $nsc)
    										<tr class="odd gradeX">
    											<td> {{$nsc->name}} {{$nsc->surname}}</td>
    											<td>{{ str_limit($nsc->message, $limit = 50, $end = '...') }}</td>
    											<td>
    												@if($nsc->news_id != 0)
      												@foreach($ne = App\News::where('id','=',[$nsc->news_id])->get() as $ne)
      														 <a href="https://sade.store/news/{{$ne->slug}}" target="_blank">{{ str_limit($nsc->news_title, $limit = 50, $end = '...') }}</a>
      												@endforeach
    												@else
      												@foreach($prodd = App\ProductDetails::where('id','=',[$nsc->product_id])->get() as $p)
      												  <a href="https://sade.store/product-details/{{$p->slug}}" target="_blank">{{ str_limit($p->productname, $limit = 50, $end = '...') }}</a>
      												@endforeach
    												@endif
    											</td>
    											<td>{{$nsc->created_at->diffForHumans()}}</td>
    											<td>
    												<button class="btn btn-primary capi" data-toggle="modal" data-target="#more-{{$nsc->id}}"> {{ trans('app.more')}}</button>&nbsp;
    												<div class="modal fade" id="more-{{$nsc->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
    												<div class="modal-dialog" >
    													<div class="modal-content">
    														<div class="modal-header">
    															Comment <i><span style="color:gray;">By {{$nsc->name}} {{$nsc->surname}}</span></i>
    														</div>
    														<div class="modal-body"><p>{{$nsc->message}}</p><b style="color:red;">{{$nsc->user_ip}}</b></div>
    															<div class="modal-footer">
    																<form class="" action="/verifynewscomment/{{$nsc->id}}" method="post">
    																	{{csrf_field()}}
    																	<input type="hidden" name="verify" value="1">
    																	<button type="reset" class="btn btn-success" data-dismiss="modal">Cancel</button>
    																	<button type="submit" class="btn btn-primary">Confirm</button>
    																	<a href="/rejectnewscomment/{{$nsc->id}}" class="btn btn-danger">Reject</a>
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
