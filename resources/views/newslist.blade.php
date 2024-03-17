@extends('layouts.master')

@section('css')
<title>{{ ucwords(trans('app.news_list'))}}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/datatables.bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
@endsection
@section('body')
<div id="content">
<div class="panel box-shadow-none content-header">
<div class="panel-body">
<div class="col-md-12">
<h3 class="animated fadeInLeft">News List</h3>
<p class="animated fadeInDown">
List <span class="fa-angle-right fa"></span> News
</p>
</div>
</div>
</div>
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
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>News List - <small><a class="capi" href="/addnews" title="{{ trans('app.addnews')}}">{{ trans('app.addnews')}}</a></h3>
                      </small>
                    </div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
    										<tr class="capi">
    											<th style="width:10%;">ID</th>
    											<th>{{ trans('app.news_title')}}</th>
    											<th>{{ trans('app.news')}}</th>
    											<th style="width:30%;"><center>X</center></th>
    										</tr>
                      </thead>
                      <tbody>
                        @foreach($news as $news)
    										<tr class="odd gradeX">
                          <td>{{$news->id}}</td>
                          <td>{{$news->news_title}}</td>
                          <td>{!! $news->news_body !!}</td>
    											<td>
                            <a data-toggle="modal" data-target="#newsedit{{$news->access_token}}"  class="btn btn-success capi">{{ trans('app.more')}}</a>
                            <a href="#" class="btn btn-primary capi"  data-toggle="modal" data-target="#more{{$news->id}}">{{ trans('app.details')}}</a>
                            <a class="btn btn-danger"  data-toggle="modal" data-target="#newsdelete{{$news->id}}">{{ trans('app.delete')}}</a>
                              <!-- more modal  -->
                              <div class="modal fade" id="more{{$news->id}}" role="dialog">
                                 <div class="modal-dialog">
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       <h4 class="modal-title">More</h4>
                                     </div>
                                     <div class="modal-body">
                                       <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                         <ul class="list-group">
                                           <li class="list-group-item"><b class="blue capi">ID:</b> {{$news->id}}</li>
                                           <li class="list-group-item"><b class="blue capi">Link:</b><a href="https://sade.store/n/{{$news->id}}" target="_blank"> sade.store/n/{{$news->id}}</a> </li>
                                           <li class="list-group-item"><b class="blue capi">Title:</b> {{$news->news_title}}</li>
                                           <li class="list-group-item "><b class="blue capi">News: </b> {!! $news->news_body !!}</li>
                                         </ul>
                                        </div>
                                        </div>
                                     </div>
                                     <div class="modal-footer">
                                     </div>
                                   </div>
                                 </div>
                                 <!-- more modal end here -->
        												<div class="modal fade" id="newsdelete{{$news->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
          												<div class="modal-dialog" >
          													<div class="modal-content">
          														<div class="modal-header">{{ trans('app.delete')}}</div>
                                      <div class="modal-body">
                                        Are you sure to delete <i class="capi">{{$news->news_title}}</i>?
                                      </div>
          															<div class="modal-footer">
          																	<button type="reset" class="btn btn-danger" data-dismiss="modal">{{__('app.no')}}</button>
          																	<a href="/newsdelete/{{$news->id}}"  class="btn btn-primary">{{__('app.yes')}}</a>
          															</div>
          													</div>
          												</div>
        												</div>
                                <!-- edit modal  -->
                                <div class="modal fade" id="newsedit{{$news->access_token}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
          												<div class="modal-dialog" >
          													<div class="modal-content">
          														<div class="modal-header">{{ trans('app.edit')}}</div>
                                      <form action="/editnews/{{$news->id}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-body">
                                          <input class="form-control" type="text" name="title" value="{{$news->news_title}}" style="width:100%;" placeholder="News title..." required>
                                          <br><br>
                                          <input class="form-control" type="text" name="slug" value="{{$news->slug}}" style="width:100%;" placeholder="Product slug...">
                                          <br><br>
                                          <textarea name="body">{!! $news->news_body !!}</textarea>
                                        </div>
            														<div class="modal-footer">
            																<button type="reset" class="btn btn-danger capi" data-dismiss="modal">{{trans('app.cancel')}}</button>
                                            <button type="submit" class="btn btn-primary capi">{{ trans('app.edit')}}</button>
            														</div>
                                      </form>
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
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('adm/js/tinymce.js')}}"></script>
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
