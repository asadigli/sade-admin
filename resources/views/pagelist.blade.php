@extends('layouts.master')

@section('css')
<title>{{ ucwords(trans('app.pages'))}}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/datatables.bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
@endsection
@section('body')
  <div id="content">
   <div class="panel box-shadow-none content-header">
    <div class="panel-body">
      <div class="col-md-12">
        <h3 class="animated fadeInLeft">All Pages</h3>
        <p class="animated fadeInDown">
          Lists <span class="fa-angle-right fa"></span> Pages
        </p>
      </div>
    </div>
  </div>
  @include('layouts.alerts')
  <div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading capi"><h3>{{trans('app.active_pages')}}
          <small><a class="capi" href="/createpages" title="{{trans('app.create_page')}}">{{trans('app.create_page')}}</a> </small>
        -  <small><a class="capi" href="/tabscontrol" title="{{trans('app.create_page')}}">Tabs</a> </small>
            </h3>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
              <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr class="capi">
  									<th>Title</th>
  									<th>Slug</th>
  									<th>Details</th>
  									<th>X</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($pages as $page)
  								   <tr class="odd gradeX">
  								   		<td>{{$page->title}}</td>
  											<td>{{$page->slug}}</td>
  											<td>{!! $page->details !!}</td>
  											<td>
                          <a class="btn btn-primary capi" href="/page-detail/{{$page->slug}}">{{trans('app.more')}}</a> <br><br>
                          <button class="btn btn-success capi" data-toggle="modal" data-target="#active-edit{{$page->id}}">{{trans('app.edit')}}</button><br><br>
  												<button class="btn btn-danger capi" data-toggle="modal" data-target="#active-delete{{$page->id}}">{{trans('app.delete')}}</button>
                            <!-- modals start here -->
                            <div class="modal fade" id="active-delete{{$page->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
  													<div class="modal-dialog" >
  														<div class="modal-content">
  															<div class="modal-header capi">{{ trans('app.delete')}}</div>
                                <div class="modal-body">
  																{{trans('app.are_you_sure_to_delete')}} <i class="capi">{{$page->title}}</i>?
                                </div>
  																<div class="modal-footer">
  																		<button type="reset" class="btn btn-primary capi" data-dismiss="modal">{{trans('app.no')}}</button>
  																		<a href="/deletepage/{{$page->token}}" class="btn btn-danger capi">{{trans('app.yes')}}</a>
  																</div>
  														</div>
  													</div>
  													</div>
                            <!--  edit -->
                            <div class="modal fade" id="active-edit{{$page->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
                            <div class="modal-dialog" >
                              <div class="modal-content">
                                <div class="modal-header capi">
                                  {{ trans('app.edit_page')}}
                                </div>
                                  <form class="" action="/editpage/{{$page->id}}" method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="modal-body">
                                        <input type="text" class="form-control" style="width:100%;" name="title" value="{{$page->title}}" placeholder="Title..." required>
                                        <br><br>
                                        <input type="text" class="form-control" style="width:100%;text-transform:lowercase;" name="slug" value="{{$page->slug}}" placeholder="Slug...">
                                          @if ($errors->has('slug'))
                                            <span class="help-block">
                                                <strong class="red">{{ $errors->first('slug') }}</strong>
                                            </span>
                                          @endif
                                        <br><br>
                                        <b>Status:</b>
                                          <label class="radio">
                                            <input type="radio" name="status" value="1" {{ ($page->status == 1) ? "checked" : "" }}/>
                                            <span class="outer">
                                            <span class="inner"></span></span> Active
                                            <input type="radio" name="status" value="0"  {{ ($page->status == 0) ? "checked" : "" }}/>
                                            <span class="outer">
                                            <span class="inner"></span></span> Not Active
                                          </label>
                                        <br><br>
                                        <b>Header:</b>
                                          <label class="radio">
                                            <input type="radio" name="header_seem" value="1"  {{ ($page->header_seem == 1) ? "checked" : "" }}/>
                                            <span class="outer">
                                            <span class="inner"></span></span> Yes
                                            &nbsp; &nbsp; <input type="radio" name="header_seem" value="0"  {{ ($page->header_seem == 0) ? "checked" : "" }}/>
                                            <span class="outer">
                                            <span class="inner"></span></span> No
                                          </label>
                                        <br><br>
                                        <b>Footer:</b>
                                          <label class="radio">
                                            <input type="radio" name="footer_seem" value="1" {{ ($page->footer_seem == 1) ? "checked" : "" }}/>
                                            <span class="outer">
                                            <span class="inner"></span></span> Yes
                                            &nbsp; &nbsp; <input type="radio" name="footer_seem" value="0"  {{ ($page->footer_seem == 0) ? "checked" : "" }}/>
                                            <span class="outer">
                                            <span class="inner"></span></span> No
                                          </label>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="reset" class="btn btn-danger capi" data-dismiss="modal">{{ trans('app.close')}}</button>
                                          <button type="submit"  name="submit" class="btn btn-primary capi">{{ trans('app.change')}}</button>
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

              <!-- Not active ones -->
              <br>
              <div class="panel">
                <div class="panel-heading capi"><h3>{{trans('app.not_active_pages')}}</h3></div>
                <div class="panel-body">
                  <div class="responsive-table">
                  <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr class="capi">
                      <th>Title</th>
                      <th>Slug</th>
                      <th>Details</th>
                      <th>X</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pages_na as $pna)
                    <tr class="odd gradeX">
                      <td>{{$pna->title}}</td>
                      <td>{{$pna->slug}}</td>
                      <td>{!! $pna->details !!}</td>
                      <td>
                        <a class="btn btn-primary capi" href="/page-detail/{{$pna->slug}}">{{trans('app.more')}}</a><br><br>
                        <button class="btn btn-success capi" data-toggle="modal" data-target="#not-active-edit{{$pna->id}}">{{trans('app.edit')}}</button><br><br>
                        <button class="btn btn-danger capi" data-toggle="modal" data-target="#not-active-delete{{$pna->id}}">{{trans('app.delete')}}</button>
                        <!-- modals start here -->
                        <div class="modal fade" id="not-active-delete{{$pna->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
                        <div class="modal-dialog" >
                          <div class="modal-content">
                            <div class="modal-header capi">{{trans('app.delete')}}</div>
                            <div class="modal-body">
                              {{trans('app.are_you_sure_to_delete')}} <i class="capi">{{$pna->title}}</i>?
                            </div>
                              <div class="modal-footer">
                                  <button type="reset" class="btn btn-primary capi" data-dismiss="modal">{{trans('app.no')}}</button>
                                  <a href="/deletepage/{{$pna->token}}" class="btn btn-danger capi">{{trans('app.yes')}}</a>
                              </div>
                          </div>
                        </div>
                        </div>
                        <div class="modal fade" id="not-active-edit{{$pna->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
                        <div class="modal-dialog" >
                          <div class="modal-content">
                            <div class="modal-header capi">
                              {{ trans('app.edit_page')}}
                            </div>
                              <form class="" action="/editpage/{{$pna->id}}" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="modal-body">
                                    <input type="text" class="form-control" style="width:100%;" name="title" value="{{$pna->title}}" placeholder="Title..." required>
                                    <br><br>
                                    <input type="text" class="form-control" style="width:100%;text-transform:lowercase;" name="slug" value="{{$pna->slug}}" placeholder="Slug...">
                                      @if ($errors->has('slug'))
                                        <span class="help-block">
                                            <strong class="red">{{ $errors->first('slug') }}</strong>
                                        </span>
                                      @endif
                                    <br><br>
                                    <ul>
                                      <li><label class="radio">
                                        <b>Status:</b>&nbsp; &nbsp;&nbsp; &nbsp;
                                        <input type="radio" name="status" value="1" {{ ($pna->status == 1) ? "checked" : "" }}/>
                                         Active &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input type="radio" name="status" value="0"  {{ ($pna->status == 0) ? "checked" : "" }}/>
                                         Not Active
                                      </label>
                                    </li><br>
                                    <li><label class="radio capi">
                                      <b>Header:</b>&nbsp; &nbsp;&nbsp; &nbsp;
                                      <input type="radio" name="header_seem" value="1"  {{ ($pna->header_seem == 1) ? "checked" : "" }}/>
                                       {{trans('app.active')}} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                       <input type="radio" name="header_seem" value="0"  {{ ($pna->header_seem == 0) ? "checked" : "" }}/>
                                       {{trans('app.closed')}}
                                    </label></li><br>
                                    <li><label class="radio capi">
                                      <b>Footer:</b>&nbsp; &nbsp;&nbsp; &nbsp;
                                      <input type="radio" name="footer_seem" value="1" {{ ($pna->footer_seem == 1) ? "checked" : "" }}/>
                                      {{trans('app.active')}} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                      <input type="radio" name="footer_seem" value="0"  {{ ($pna->footer_seem == 0) ? "checked" : "" }}/>
                                      {{trans('app.closed')}}
                                    </label></li>
                                    </ul>


                                  </div>
                                  <div class="modal-footer">
                                      <button type="reset" class="btn btn-danger capi" data-dismiss="modal">{{ trans('app.close')}}</button>
                                      <button type="submit"  name="submit" class="btn btn-primary capi">{{ trans('app.change')}}</button>
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
