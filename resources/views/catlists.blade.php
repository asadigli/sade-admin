@extends('layouts.master')

@section('css')
<title>{{ ucwords(trans('app.catlists'))}}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/datatables.bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
@endsection
@section('body')
  <div id="content">
   <div class="panel box-shadow-none content-header">
    <div class="panel-body">
      <div class="col-md-12">
        <h3 class="animated fadeInLeft">All Categories</h3>
        <p class="animated fadeInDown">
          Lists <span class="fa-angle-right fa"></span> Categories
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
                    <div class="panel-heading"><h3>All Categories
                      <small><a class="capi" href="/catcreation" title="{{trans('app.add_new_category')}}">{{trans('app.add_new_category')}}</a> </small>
                    </h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
    										<tr class="capi">
    											<th style="width:15%;">Category ID</th>
    											<th>Category Name</th>
    											<th style="width: 30%;"><center>X</center> </th>
                        </tr>
                      </thead>
                      <tbody>
    										@foreach($category as $cat)
    										<tr class="odd gradeX">
    											<td>{{$cat->id}}</td>
    											<td>{{$cat->name}}</td>
    											<td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#CatEdit-{{$cat->id}}">Edit</button>&nbsp;
    												<button class="btn btn-danger" data-toggle="modal" data-target="#Modalcate-{{$cat->id}}">Delete</button>
    												<div class="modal fade" id="Modalcate-{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
    												<div class="modal-dialog" >
    													<div class="modal-content">
    														<div class="modal-header capi">{{trans('app.delete')}}</div>
                                <div class="modal-body">
                                  Are you sure to delete <i class="capi">{{$cat->name}}</i>?
                                </div>
    															<div class="modal-footer">
    																	<button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
    																	<a href="/deletecategory/{{ $cat->id }}" class="btn btn-primary">Yes</a>
    															</div>
    													</div>
    												</div>
    												</div>
    												<div class="modal fade" id="CatEdit-{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
    												<div class="modal-dialog" >
    													<div class="modal-content">
    														<div class="modal-header capi">
    															{{ trans('app.edit_category')}}
    														</div>
                                  <form class="" action="/categoryedit/{{$cat->id}}" method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="modal-body">
                                        <input type="text" class="form-control" style="width:100%;" name="name" value="{{$cat->name}}" placeholder="Category name..." required>
                                        <br><br>
                                        <input type="text" class="form-control" style="width:100%;" name="slug" value="{{$cat->slug}}" placeholder="Category slug...">
                                        <br><br>
                                        <input type="file" name="poster" value="{{$cat->poster}}">
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
                <br>
                <!-- sub categories here -->
                <div class="panel">
                  <div class="panel-heading"><h3>All Sub-Categories</h3></div>
                  <div class="panel-body">
                    <div class="responsive-table">
                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr class="capi">
  												<th style="width:15%;">SubCategory ID</th>
  												<th>SubCategory Name</th>
  												<th>Parent Category</th>
  												<th style="width: 30%;">X</th>
                        </tr>
                      </thead>
                      <tbody>
  											@foreach($subcat as $sub)
  											<tr class="odd gradeX">
  												<td>{{$sub->id}}</td>
  												<td>{{$sub->name}}</td>
  												<td>
  												@foreach($category as $cat)
  												@if(($sub->parent_id)==($cat->id))
  												{{$cat->name}}
  												@endif
  												@endforeach
  											</td>
  												<td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#subcatEdit-{{$sub->id}}">Edit</button>&nbsp;
  													<button class="btn btn-danger" data-toggle="modal" data-target="#Modalcat-{{$sub->id}}">Delete</button>
  													<div class="modal fade" id="Modalcat-{{$sub->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
  													<div class="modal-dialog" >
  														<div class="modal-content">
  															<div class="modal-header capi">{{ trans('app.delete')}}</div>
                                <div class="modal-body">
  																Are you sure to delete <i class="capi">{{$sub->name}}</i>?
                                </div>
  																<div class="modal-footer">
  																		<button type="reset" class="btn btn-danger" data-dismiss="modal">No</button>
  																		<a href="/deletesubcat/{{ $sub->id }}" class="btn btn-primary">Yes</a>
  																</div>
  														</div>
  													</div>
  													</div>
                            <!-- subcat edit -->
                            <div class="modal fade" id="subcatEdit-{{$sub->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                            <div class="modal-dialog" >
                              <div class="modal-content">
                                <div class="modal-header capi">
                                  {{ trans('app.edit_sub_category')}}
                                </div>
                                <form class="" action="/subcatedit/{{$sub->id}}" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="modal-body">
                                  <input type="text" class="form-control" name="name" value="{{$sub->name}}" placeholder="Sub-category name.." required>
                                  <br>
                                  <input type="text" class="form-control" name="slug" value="{{$sub->slug}}" placeholder="Sub-category slug..">
                                  <br>
                                  <input type="file" name="poster" value="{{$sub->poster}}">
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
