@extends('layouts.master')
@section('css')
<title>{{ ucwords(trans('app.Most_viewed_products'))}}</title>
@endsection
@section('body')
<div id="content">
  <div class="panel box-shadow-none content-header">
    <div class="panel-body">
      <div class="col-md-12">
      <h3 class="animated fadeInLeft capi">{{ trans('app.Most_viewed_products')}}</h3>
      <p class="animated fadeInDown">{{__('app.List')}} <span class="fa-angle-right fa"></span> {{__('app.Products')}}</p>
      </div>
    </div>
  </div>
  @include('layouts.alerts')
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading capi"><h3>{{ trans('app.Most_viewed_products')}}
                    </h3>
                    </div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table >
                      <thead>
    										<tr class="capi">
    											<th style="width:10%;">{{ trans('app.productid')}}</th>
    											<th>{{ trans('app.product')}}</th>
                          <th>{{ trans('app.price')}}</th>
                          <th>{{ trans('app.views')}}</th>
    											<th><center>X</center></th>
    										</tr>
                      </thead>
                      <tbody>
                        @foreach($pros as $prodet)
    										<tr class="odd gradeX" style="font-size:11px;">
    											<td>{{$prodet->main_id}}</td>
    												<td><u><a href="//sade.store/p/{{$prodet->id}}" target="_blank">{{$prodet->productname}}</a></u></td>
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
                          <td>{{trans('app.Views_count',['count' => $prodet->view])}}</td>
    											<td>
                            <a href="#" class="btn btn-primary capi"  data-toggle="modal" data-target="#more{{$prodet->id}}" title="{{__('app.details')}}"><i class="fa fa-eye"></i> </a>
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
<script src="{{ asset('adm/js/plugins/jquery.nicescroll.js')}}"></script>
<script src="{{ asset('adm/js/main.js')}}"></script>
@endsection
