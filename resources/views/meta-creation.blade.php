@extends('layouts.master')

@section('css')
  <title>{{$metatitle}}</title>
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
        <h3 class="animated fadeInLeft capi">{{$metatitle}}</h3>
        <p class="animated fadeInDown">
          SEO Control <span class="fa-angle-right fa"></span> {{$metatitle}}
        </p>
      </div>
    </div>
  </div>
  @include('layouts.alerts')
  <div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading capi"><h3>{{$metatitle}}
            @if($metatitle == 'Meta Desc')
              <small><a class="capi" href="/metadescriptions">Back</a> </small>
            @elseif($metatitle == 'Meta Tag')
              <small><a class="capi" href="/metatags">Back</a> </small>
            @else
              <small style="display: {{ Request::path() == 'metatags' ? 'none' : '' }}"><a class="capi" href="/metatags"> M.Tag |</a> </small>
              <small style="display: {{ Request::path() == 'metadescriptions' ? 'none' : '' }}"><a class="capi" href="/metadescriptions"> M.Desc </a></small>
              <small style="display: {{ Request::path() == 'metatag-creation' ? 'none' : '' }}"><a class="capi" href="/metatag-creation">| Add M.Tag</a></small>
              <small style="display: {{ Request::path() == 'metadesc-creation' ? 'none' : '' }}"><a class="capi" href="/metadesc-creation">| Add M.Desc</a> </small>
            @endif
            </h3>
        </div>
        <div class="panel-body">
          @if(Request::path() == 'metatags')
          <div class="responsive-table">
              <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr class="capi">
  									<th>Type</th>
                    <th>Name</th>
                    <th>Tag</th>
                    <th>X</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($seotag as $st)
  								   <tr class="odd gradeX">
                       <td>
                         @if($st->product_id == 0 && $st->news_id == 0 && $st->subcategory_id == 0 && $st->category_id == 0 && $st->page_id != 0)
                         Page
                         @elseif($st->product_id == 0 && $st->news_id == 0 && $st->subcategory_id == 0 && $st->category_id != 0)
                         Category
                         @elseif($st->product_id == 0 && $st->news_id == 0 && $st->subcategory_id != 0)
                         Subcategory
                         @elseif($st->product_id == 0 && $st->news_id != 0)
                         News
                         @elseif($st->product_id != 0)
                         Product
                         @endif
                       </td>
                       <td>
                           @if($st->product_id == 0 && $st->news_id == 0 && $st->subcategory_id == 0 && $st->category_id == 0 && $st->page_id != 0)
                             @php
                             $page = App\Page::where('id','=',[$st->page_id])->get()
                             @endphp
                             @foreach($page as $pg)
                              <a href="/metatag/{{$st->id}}">{{$pg->shortname}}</a>
                             @endforeach
                           @elseif($st->product_id == 0 && $st->news_id == 0 && $st->subcategory_id == 0 && $st->category_id != 0)
                             @php
                             $cats = App\Category::where('id','=',[$st->category_id])->get()
                             @endphp
                             @foreach($cats as $cat)
                              <a href="/metatag/{{$st->id}}">{{$cat->name}}</a>
                             @endforeach
                           @elseif($st->product_id == 0 && $st->news_id == 0 && $st->subcategory_id != 0)
                             @php
                             $subs = App\Subcat::where('id','=',[$st->subcategory_id])->get()
                             @endphp
                             @foreach($subs as $sub)
                              <a href="/metatag/{{$st->id}}">{{$sub->name}}</a>
                             @endforeach
                           @elseif($st->product_id == 0 && $st->news_id != 0)
                             @php
                             $news = App\News::where('id','=',[$st->news_id])->get()
                             @endphp
                             @foreach($news as $news)
                              <a href="/metatag/{{$st->id}}">{{$news->news_title}}</a>
                             @endforeach
                           @elseif($st->product_id != 0)
                             @php
                             $prods = App\ProductDetails::where('id','=',[$st->product_id])->get()
                             @endphp
                             @foreach($prods as $prod)
                              <a href="/metatag/{{$st->id}}">{{$prod->productname}}</a>
                             @endforeach
                           @endif
                         </td>
                       <td>{{$st->tag}}</td>
  											<td>
  												<button class="btn btn-danger capi" data-toggle="modal" data-target="#active-delete{{$st->id}}">{{trans('app.delete')}}</button>
                            <div class="modal fade" id="active-delete{{$st->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
  													<div class="modal-dialog" >
  														<div class="modal-content">
  															<div class="modal-header capi">{{ trans('app.delete')}}</div>
                                <div class="modal-body">
  																{{trans('app.are_you_sure_to_delete')}} <i class="capi">{{$st->tag}}</i>?
                                </div>
  																<div class="modal-footer">
  																		<button type="reset" class="btn btn-primary" data-dismiss="modal">{{trans('app.no')}}</button>
  																		<a href="/deletetag/{{$st->id}}" class="btn btn-danger capi">{{trans('app.yes')}}</a>
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
                  @elseif(Request::path() == 'metadescriptions')
                  <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <thead>
                          <tr class="capi">
          									<th>Type</th>
                            <th>Name</th>
                            <th>Tag</th>
                            <th>X</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($seodesc as $sd)
          								   <tr class="odd gradeX">
                               <td>
                                 @if($sd->product_id == 0 && $sd->news_id == 0 && $sd->subcategory_id == 0 && $sd->category_id == 0 && $sd->page_id != 0)
                                 Page
                                 @elseif($sd->product_id == 0 && $sd->news_id == 0 && $sd->subcategory_id == 0 && $sd->category_id != 0)
                                 Category
                                 @elseif($sd->product_id == 0 && $sd->news_id == 0 && $sd->subcategory_id != 0)
                                 Subcategory
                                 @elseif($sd->product_id == 0 && $sd->news_id != 0)
                                 News
                                 @elseif($sd->product_id != 0)
                                 Product
                                 @endif
                               </td>
                               <td>
                                   @if($sd->product_id == 0 && $sd->news_id == 0 && $sd->subcategory_id == 0 && $sd->category_id == 0 && $sd->page_id != 0)
                                     @php
                                     $page = App\Page::where('id','=',[$sd->page_id])->get()
                                     @endphp
                                     @foreach($page as $pg)
                                      <a href="/metadesc/{{$sd->id}}">{{$pg->shortname}}</a>
                                     @endforeach
                                   @elseif($sd->product_id == 0 && $sd->news_id == 0 && $sd->subcategory_id == 0 && $sd->category_id != 0)
                                     @php
                                     $cats = App\Category::where('id','=',[$sd->category_id])->get()
                                     @endphp
                                     @foreach($cats as $cat)
                                      <a href="/metadesc/{{$sd->id}}">{{$cat->name}}</a>
                                     @endforeach
                                   @elseif($sd->product_id == 0 && $sd->news_id == 0 && $sd->subcategory_id != 0)
                                     @php
                                     $subs = App\Subcat::where('id','=',[$sd->subcategory_id])->get()
                                     @endphp
                                     @foreach($subs as $sub)
                                      <a href="/metadesc/{{$sd->id}}">{{$sub->name}}</a>
                                     @endforeach
                                   @elseif($sd->product_id == 0 && $sd->news_id != 0)
                                     @php
                                     $news = App\News::where('id','=',[$sd->news_id])->get()
                                     @endphp
                                     @foreach($news as $news)
                                      <a href="/metadesc/{{$sd->id}}">{{$news->news_title}}</a>
                                     @endforeach
                                   @elseif($sd->product_id != 0)
                                     @php
                                     $prods = App\ProductDetails::where('id','=',[$sd->product_id])->get()
                                     @endphp
                                     @foreach($prods as $prod)
                                      <a href="/metadesc/{{$sd->id}}">{{$prod->productname}}</a>
                                     @endforeach
                                   @endif
                                 </td>
                               <td>{{$sd->description}}</td>
          											<td>
          												<button class="btn btn-danger capi" data-toggle="modal" data-target="#active-deletedesc{{$sd->id}}">{{trans('app.delete')}}</button>
                                    <div class="modal fade" id="active-deletedesc{{$sd->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:0%;">
          													<div class="modal-dialog" >
          														<div class="modal-content">
          															<div class="modal-header capi">{{ trans('app.delete')}}</div>
                                        <div class="modal-body">
          																{{trans('app.are_you_sure_to_delete')}} <i class="capi">{{$sd->tag}}</i>?
                                        </div>
          																<div class="modal-footer">
          																		<button type="reset" class="btn btn-primary" data-dismiss="modal">{{trans('app.no')}}</button>
          																		<a href="/deletedesc/{{$sd->id}}" class="btn btn-danger capi">{{trans('app.yes')}}</a>
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
                  @elseif(Request::path() == 'metatag-creation')
                        <form action="/addnewtag" method="post">
                          {{ csrf_field()}}
                            <div class="form-group">
                              <select class="form-control selectpicker" name="product_id" data-show-subtext="true" data-live-search="true">
                                <option value="0" selected>Product</option>
                                @php
                                $prods = App\ProductDetails::all()
                                @endphp
                                @foreach($prods as $pr)
                                <option value="{{$pr->id}}">{{$pr->productname}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control selectpicker" name="news_id" data-show-subtext="true" data-live-search="true">
                                <option value="0" selected>News</option>
                                @php
                                $news = App\News::all()
                                @endphp
                                @foreach($news as $ns)
                                <option value="{{$ns->id}}">{{$ns->news_title}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control selectpicker" name="subcategory_id" data-show-subtext="true" data-live-search="true">
                                <option value="0" selected>Subcategory</option>
                                @php
                                $subcats = App\Subcat::all()
                                @endphp
                                @foreach($subcats as $sc)
                                <option value="{{$sc->id}}">{{$sc->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control selectpicker" name="category_id" data-show-subtext="true" data-live-search="true">
                                <option value="0" selected>Category</option>
                                @php
                                $cats = App\Category::all()
                                @endphp
                                @foreach($cats as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control selectpicker" name="page_id"  data-show-subtext="true" data-live-search="true">
                                <option value="0" selected>Page</option>
                                @php
                                $pages = App\Page::all()
                                @endphp
                                @foreach($pages as $page)
                                <option value="{{$page->id}}">{{$page->shortname}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name="tag" placeholder="metatag name..." required>
                            </div>
                            <div class="form-group">
                              <button type="submit" name="submit" class="btn btn-success ">Add Tag</button>
                            </div>
                        </form>
                    @elseif(Request::path() == 'metadesc-creation')
                        <form  action="/addnewdescription" method="post">
                          {{ csrf_field()}}
                            <div class="form-group">
                              <select class="form-control selectpicker" name="product_id" data-show-subtext="true" data-live-search="true">
                                <option value="0" selected>Product</option>
                                @php
                                $prods = App\ProductDetails::all()
                                @endphp
                                @foreach($prods as $pr)
                                <option value="{{$pr->id}}">{{$pr->productname}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control selectpicker" name="news_id" data-show-subtext="true" data-live-search="true">
                                <option value="0" selected>News</option>
                                @php
                                $news = App\News::all()
                                @endphp
                                @foreach($news as $ns)
                                <option value="{{$ns->id}}">{{$ns->news_title}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control selectpicker" name="subcategory_id" data-show-subtext="true" data-live-search="true">
                                <option value="0" selected>Subcategory</option>
                                @php
                                $subcats = App\Subcat::all()
                                @endphp
                                @foreach($subcats as $sc)
                                <option value="{{$sc->id}}">{{$sc->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control selectpicker" name="category_id" data-show-subtext="true" data-live-search="true">
                                <option value="0" selected>Category</option>
                                @php
                                $cats = App\Category::all()
                                @endphp
                                @foreach($cats as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <select class="form-control selectpicker" name="page_id"  data-show-subtext="true" data-live-search="true">
                                <option value="0" selected>Page</option>
                                @php
                                $pages = App\Page::all()
                                @endphp
                                @foreach($pages as $page)
                                <option value="{{$page->id}}">{{$page->shortname}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name="description" placeholder="meta description..." required>
                            </div>
                            <div class="form-group">
                              <button type="submit" name="submit" class="btn btn-success ">Add Description</button>
                            </div>
                        </form>
                    @else
                      @if($metatitle == 'Meta Desc')
                        <div class="center-meta" style="text-align:center;">
                          <b>
                            @if($seod->product_id == 0 && $seod->news_id == 0 && $seod->subcategory_id == 0 && $seod->category_id == 0 && $seod->page_id != 0)
                            Page
                            @elseif($seod->product_id == 0 && $seod->news_id == 0 && $seod->subcategory_id == 0 && $seod->category_id != 0)
                            Category
                            @elseif($seod->product_id == 0 && $seod->news_id == 0 && $seod->subcategory_id != 0)
                            Subcategory
                            @elseif($seod->product_id == 0 && $seod->news_id != 0)
                            News
                            @elseif($seod->product_id != 0)
                            Product
                            @endif
                          :</b> <i>
                            @if($seod->product_id == 0 && $seod->news_id == 0 && $seod->subcategory_id == 0 && $seod->category_id == 0 && $seod->page_id != 0)
                              @php
                              $page = App\Page::where('id','=',[$seod->page_id])->get()
                              @endphp
                              @foreach($page as $pg)
                               <a href="//sade.store/store/{{$pg->slug}}" target="_blank">{{$pg->shortname}}</a>
                              @endforeach
                            @elseif($seod->product_id == 0 && $seod->news_id == 0 && $seod->subcategory_id == 0 && $seod->category_id != 0)
                              @php
                              $cats = App\Category::where('id','=',[$seod->category_id])->get()
                              @endphp
                              @foreach($cats as $cat)
                               <a href="//sade.store/category/{{$cat->slug}}" target="_blank">{{$cat->name}}</a>
                              @endforeach
                            @elseif($seod->product_id == 0 && $seod->news_id == 0 && $seod->subcategory_id != 0)
                              @php
                              $subs = App\Subcat::where('id','=',[$seod->subcategory_id])->get()
                              @endphp
                              @foreach($subs as $sub)
                               <a href="//sade.store/subcategory/{{$sub->slug}}" target="_blank">{{$sub->name}}</a>
                              @endforeach
                            @elseif($seod->product_id == 0 && $seod->news_id != 0)
                              @php
                              $news = App\News::where('id','=',[$seod->news_id])->get()
                              @endphp
                              @foreach($news as $news)
                               <a href="//sade.store/news/{{$news->slug}}" target="_blank">{{$news->news_title}}</a>
                              @endforeach
                            @elseif($seod->product_id != 0)
                              @php
                              $prods = App\ProductDetails::where('id','=',[$seod->product_id])->get()
                              @endphp
                              @foreach($prods as $prod)
                               <a href="//sade.store/product-details/{{$prod->slug}}" target="_blank">{{$prod->productname}}</a>
                              @endforeach
                            @endif</i>
                        </div>
                      <form class="" action="/editmetadesc/{{$seod->id}}" method="post">{{csrf_field()}}
                        <div class="form-group">
                          <textarea name="description" class="form-control" placeholder="{{ trans('app.edit_description_text')}}..." rows="8" cols="80">{{$seod->description}}</textarea>
                        </div>
                        <div class="form-group">
                          <button type="submit" name="submit" class="btn btn-success capi pull-right">{{trans('app.change')}}</button>
                        </div>
                      </form>
                      @elseif($metatitle == 'Meta Tag')
                      <table class="table">
                        <thead>
                          <tr>
                            <h4><center class="capi">
                              @if($seot->product_id == 0 && $seot->news_id == 0 && $seot->subcategory_id == 0 && $seot->category_id == 0 && $seot->page_id != 0)
                              <a href="#" class="red">{{$seot->tag}}</a>
                              @elseif($seot->product_id == 0 && $seot->news_id == 0 && $seot->subcategory_id == 0 && $seot->category_id != 0)
                              <a href="#" class="blue">{{$seot->tag}}</a>
                              @elseif($seot->product_id == 0 && $seot->news_id == 0 && $seot->subcategory_id != 0)
                              <a href="#" class="orange">{{$seot->tag}}</a>
                              @elseif($seot->product_id == 0 && $seot->news_id != 0)
                              <a href="#" class="gray">{{$seot->tag}}</a>
                              @elseif($seot->product_id != 0)
                              <a href="#" class="green">{{$seot->tag}}</a>
                              @endif
                            </center></h4>
                          </tr>
                          <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Tag</th>
                            <th scope="col"><center>#</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              @if($seot->product_id == 0 && $seot->news_id == 0 && $seot->subcategory_id == 0 && $seot->category_id == 0 && $seot->page_id != 0)
                                Page
                              @elseif($seot->product_id == 0 && $seot->news_id == 0 && $seot->subcategory_id == 0 && $seot->category_id != 0)
                                Category
                              @elseif($seot->product_id == 0 && $seot->news_id == 0 && $seot->subcategory_id != 0)
                                Subcategory
                              @elseif($seot->product_id == 0 && $seot->news_id != 0)
                                News
                              @elseif($seot->product_id != 0)
                                Product
                              @endif
                           </td>
                            <td>Mark</td>
                            <td>
                              <a href="/deletetag/{{$seot->id}}" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      @endif
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
