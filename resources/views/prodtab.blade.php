@extends('layouts.master')

@section('css')
  <title>{{$title}}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/icheck/skins/flat/red.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/normalize.css')}}"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
@endsection

@section('body')
  <div id="content">
   <div class="panel box-shadow-none content-header">
    <div class="panel-body">
      <div class="col-md-12">
        <h3 class="animated fadeInLeft capi">{{$title}}</h3>
        <p class="animated fadeInDown">
          Tab Control<span class="fa-angle-right fa"></span> {{$title}}
        </p>
      </div>
    </div>
  </div>
  @include('layouts.alerts')
  <div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading capi"><h3>{{$title}}
            @if($title == 'Tab List')
              <small><a href="/add-product-tab">Add Tab</a> </small>
            @elseif($title == 'Add Tab')
              <small><a href="/product-tabs-list">Tab List</a> </small>
            @endif
            </h3>
        </div>
        <div class="panel-body">
          @if(Request::path() == 'product-tabs-list')
          <div class="responsive-table">
              <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr class="capi">
  									<th>Product</th>
                    <th>Title</th>
                    <th>Detail</th>
                    <th>X</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($prodtab as $pt)
  								   <tr class="odd gradeX">
                       <td>
                         @php
                         $prod = App\ProductDetails::where('id','=',[$pt->product_id])->get()
                         @endphp
                         @foreach($prod as $pr)
                          <a href="https://sade.store/product-details/{{$pr->slug}}" target="_blank">{{$pr->productname}}</a>
                         @endforeach
                       </td>
                       <td>
                         {{$pt->title}}
                       </td>
                       <td>{{$pt->detail}}</td>
  											<td>
                          <button class="btn btn-danger capi" data-toggle="modal" data-target="#active-delete{{$pt->id}}">{{trans('app.delete')}}</button>
                          <button class="btn btn-success capi" data-toggle="modal" data-target="#active-edit{{$pt->id}}">{{trans('app.edit')}}</button>
                            <div class="modal fade" id="active-delete{{$pt->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
  													<div class="modal-dialog" >
  														<div class="modal-content">
  															<div class="modal-header capi">{{ trans('app.delete')}}</div>
                                <div class="modal-body">
  																{{trans('app.are_you_sure_to_delete')}} <i class="capi">{{$pt->title}}</i>?
                                </div>
  																<div class="modal-footer">
  																		<button type="reset" class="btn btn-primary" data-dismiss="modal">{{trans('app.no')}}</button>
  																		<a href="/deleteprodtab/{{$pt->id}}" class="btn btn-danger capi">{{trans('app.yes')}}</a>
  																</div>
  														</div>
  													</div>
  													</div>
                            <!-- edit modal -->
                            <div class="modal fade" id="active-edit{{$pt->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
  													<div class="modal-dialog" >
  														<div class="modal-content">
  															<div class="modal-header capi">{{ trans('app.edit')}}</div>
                                <form action="/prodtabedit/{{$pt->id}}" method="post">
                                  {{csrf_field()}}
                                  <div class="modal-body">
                                    <select class="form-control" name="product_id" style="width: 90%;">
                                      <option value="" selected>
                                        @php
                                        $prod_1 = App\ProductDetails::where('id','=',[$pt->product_id])->get()
                                        @endphp
                                        @foreach($prod_1 as $p1)
                                        {{$p1->productname}}
                                        @endforeach
                                      </option>
                                      @foreach($pros as $pro)
                                      <option value="{{$pro->id}}">{{$pro->productname}}</option>
                                      @endforeach
                                    </select><br><br>
                                    <input type="text" class="form-control" style="width: 90%;" placeholder="title..." name="title" value="{{$pt->title}}"><br><br>
                                    <input type="text" class="form-control" style="width: 90%;" placeholder="detail..." name="detail" value="{{$pt->detail}}">
                                  </div>
  																<div class="modal-footer">
  																		<button type="reset" class="btn btn-primary" data-dismiss="modal">{{trans('app.close')}}</button>
  																		<button type="submit" name="submit" class="btn btn-danger capi">{{trans('app.edit')}}</button>
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
              @elseif(Request::path() == 'add-product-tab')
                        <form action="/addproducttab" method="post">
                          {{ csrf_field()}}
                            <div class="form-group">
                              <select class="form-control selectpicker" name="product_id" data-show-subtext="true" data-live-search="true" required>
                                <option value="0" selected disabled>Product</option>
                                @php
                                $prods = App\ProductDetails::all()
                                @endphp
                                @foreach($prods as $pr)
                                <option value="{{$pr->id}}">{{$pr->productname}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name="title" placeholder="Title..." required>
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name="detail" placeholder="Details..." required>
                            </div>
                            <div class="form-group">
                              <button type="submit" name="submit" class="btn btn-success pull-right">Add Tab</button>
                            </div>
                        </form>
                    @endif
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

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script src="{{ asset('adm/js/main.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatables-example').DataTable();
  });
</script>
@endsection
