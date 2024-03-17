@extends('layouts.master')
@section('css')
<title>{{ ucwords(trans('app.productlist'))}}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/datatables.bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
@endsection
@section('body')
<div id="content">
  <div class="panel box-shadow-none content-header">
    <div class="panel-body">
      <div class="col-md-12">
      <h3 class="animated fadeInLeft capi">{{ trans('app.product_list')}}</h3>
      <p class="animated fadeInDown">{{__('app.List')}} <span class="fa-angle-right fa"></span> {{__('app.Products')}}</p>
      </div>
    </div>
  </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  @include('layouts.alerts')
                  <div class="panel">
                    <div class="panel-heading capi"><h3>{{ trans('app.product_list')}}
                      - <small><a href="/sellproduct">{{ trans('app.sellproduct')}}</a></small>
                      - <small><a href="/product-tabs-list">{{ trans('app.product_tabs')}}</a></small>
                    </h3>
                    </div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
    										<tr class="capi">
                          <th style="width:10%;">{{ trans('app.productid')}}</th>
                          <th>QR Code</th>
                          <th>Link</th>
    											<th>{{ trans('app.product')}}</th>
    											<th>{{ trans('app.price')}}</th>
    											<th style="width:30%;"><center>X</center></th>
    										</tr>
                      </thead>
                      <tbody>
                        @foreach($productdetails as $prodet)
    										<tr class="odd gradeX" style="font-size:11px;">
    											<td>{{$prodet->main_id}}</td>
                          <td><center><img src='data:image/png;base64,{{DNS2D::getBarcodePNG("https://sade.store/p/".$prodet->id, "QRCODE")}}' alt='barcode' />
                            <br><br><p>{{$prodet->main_id}}</p></center>
                          </td>
                          <td><a href="https://sade.store/p/{{$prodet->id}}" target="_blank">sade.store/p/{{$prodet->id}}</a></td>
    												<td><u><a href="//sade.store/product-details/{{$prodet->slug}}" target="_blank">{{$prodet->productname}}</a></u></td>
    												<td class="center">
    												@if(empty($prodet->discount))
    													@if(($prodet->currency)==1)
    														{{$prodet->price}}AZN
    													@elseif(($prodet->currency)==2)
    														${{$prodet->price}}
    													@else(($prodet->currency)==3)
    														{{$prodet->price}}EURO
    													@endif
    												@else
    													@if(($prodet->currency)==1)
    														{{($prodet->price)-($prodet->discount)}}AZN
    													@elseif(($prodet->currency)==2)
    														${{($prodet->price)-($prodet->discount)}}
    													@else(($prodet->currency)==3)
    														{{($prodet->price)-($prodet->discount)}}EURO
    													@endif <br>
    													<small style="color:red;">{{substr((($prodet->price)-(($prodet->price)-($prodet->discount)))*100/($prodet->price),0,4)}}% off</small>
    												@endif
    											</td>
    											<td>
                            <a data-toggle="modal" data-target="#productedit{{$prodet->id}}"  class="btn btn-success capi" title="{{__('app.edit')}}"><i class="fa fa-edit"></i> </a>
                            <a href="#" class="btn btn-primary capi"  data-toggle="modal" data-target="#more{{$prodet->id}}" title="{{__('app.details')}}"><i class="fa fa-eye"></i> </a>
                            <a class="btn btn-danger"  data-toggle="modal" data-target="#productdelete{{$prodet->id}}" title="{{__('app.delete')}}"><i class="fa fa-trash"></i> </a>
    											</td>
    										</tr>
                        <!-- more modal  -->
                        <div class="modal fade" id="more{{$prodet->id}}" role="dialog">
                           <div class="modal-dialog">
                             <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title capi">{{__('app.more')}}</h4>
                               </div>
                               <div class="modal-body">
                                 <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                   <ul class="list-group">
                                     <li class="list-group-item"><b style="color:#003399">ID:</b> {{$prodet->id}}</li>
                                     <li class="list-group-item"><b style="color:#003399">Rating:</b>
                                       @php $star_1 = App\Newscomment::where('news_id',0)->where('product_id',$prodet->id)->where('verify',1)->get() @endphp
                                      @php($total = 0)
                                      @foreach($star_1 as $st)
                                       @php($total += $st->rating)
                                      @endforeach
                                      @if(count($star_1) != 0)
                                          <b class="gray">{{substr($total/(count($star_1)),0,3)}}</b>
                                           <i class="fa fa-star orange"></i> / {{count($star_1)}}
                                      @else
                                        0 <i class="fa fa-star-o orange"></i>
                                      @endif
                                    </li>
                                    <li class="list-group-item capi"><b class="blue capi">{{__('app.Name')}}: </b>{{$prodet->productname}}</li>
                                    <li class="list-group-item"><b class="blue capi">Link: </b><a href="https://sade.store/p/{{$prodet->id}}" target="_blank">sade.store/p/{{$prodet->id}}</a> </li>
                                     <li class="list-group-item"><b class="blue capi">{{__('app.quantity')}}:</b> {{$prodet->quantity}}</li>
                                     <li class="list-group-item"><b class="blue capi">{{__('app.price')}}:</b> {{($prodet->price) - ($prodet->discount)}}</li>
                                     <li class="list-group-item"><b class="blue capi">{{__('app.date')}}:</b> {{$prodet->created_at->toFormattedDateString()}}</li>
                                     <li class="list-group-item"><b class="blue capi">{{__('app.features')}}:</b> {{$prodet->features}}</li>
                                     <li class="list-group-item"><b class="blue capi">{{__('app.title')}}: </b>{{$prodet->descriptionname}}</li>
                                     <li class="list-group-item"><b class="blue capi">{{__('app.details')}}: </b>{!! $prodet->description !!}</li>
                                   </ul>
                                  </div>
                                  </div>
                               </div>
                               <div class="modal-footer">
                               </div>
                             </div>
                           </div>
                           <!-- more modal end here -->
                          <div class="modal fade" id="productdelete{{$prodet->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
                            <div class="modal-dialog" >
                              <div class="modal-content">
                                <div class="modal-header">{{ trans('app.delete')}}</div>
                                <div class="modal-body">
                                  Are you sure to delete <i class="capi">{{$prodet->productname}}</i>?
                                </div>
                                  <div class="modal-footer">
                                      <button type="reset" class="btn btn-danger" data-dismiss="modal">{{__('app.no')}}</button>
                                      <a href="/deleteproduct/{{ $prodet->id }}"  class="btn btn-primary">{{__('app.yes')}}</a>
                                  </div>
                              </div>
                            </div>
                          </div>
                          <!-- edit modal  -->
                          <div class="modal fade" id="productedit{{$prodet->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
                            <div class="modal-dialog" >
                              <div class="modal-content">
                                <div class="modal-header">{{ trans('app.edit')}}</div>
                                <form action="/edit/productslug/{{$prodet->id}}" method="post">
                                  {{csrf_field()}}
                                  <div class="modal-body">
                                    <input class="form-control" type="text" name="name" value="{{$prodet->productname}}" style="width:100%;" placeholder="Product Name...">
                                    <br><br>
                                    <input class="form-control" type="text" name="slug" value="{{$prodet->slug}}" style="width:100%;" placeholder="Product slug...">
                                  </div>
                                  <div class="modal-footer">
                                      <button type="reset" class="btn btn-danger capi" data-dismiss="modal">{{trans('app.cancel')}}</button>
                                      <a class="btn btn-success capi" href="/productedit/{{$prodet->id}}">{{trans('app.more')}}</a>
                                      <button type="submit" class="btn btn-primary capi">{{ trans('app.edit')}}</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
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
