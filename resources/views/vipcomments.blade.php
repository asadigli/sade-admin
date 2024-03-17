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
                        <h3 class="animated fadeInLeft">VIP Comments</h3>
                        <p class="animated fadeInDown">
                          List <span class="fa-angle-right fa"></span> VIP Comments
                        </p>
                    </div>
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>VIP Comments </h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
        							@include('layouts.alerts')
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr class="capi">
  												<th>{{ trans('app.comment')}}</th>
  												<th>{{ trans('app.commenter')}}</th>
  												<th>{{ trans('app.date')}}</th>
  												<th>X</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
  											$vp = App\VipComments::all()
  											@endphp
  											@foreach($vp as $vp)
  										<tr>
  											<td>{{$vp->message}}</td>
  											<td>{{ $vp->name}} {{$vp->surname}}</td>
  											<td>{{$vp->created_at}}</td>
  											<td><a  class="btn btn-danger" data-toggle="modal" data-target="#vip-{{$vp->id}}">X</a> </td>

  											<div class="modal fade" id="vip-{{$vp->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
  											<div class="modal-dialog" >
  												<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
  													<div class="modal-header" style="background-color:white;">
  														Comment <i><span style="color:gray;">By {{$vp->name}} {{$vp->surname}}</span></i>
  													</div>
  													<div class="modal-body" style="background-color:white;color:black;">
  														<p>{{$vp->message}}</p>

  													</div>
  														<div class="modal-footer">
  																<button type="reset" class="btn btn-success" data-dismiss="modal">{{ trans('app.cancel')}}</button>
  																<a href="/deletevipcomment/{{$vp->id}}" class="btn btn-danger">{{ trans('app.delete')}}</a>
  														</div>
  												</div>
  											</div>
  											</div>
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
