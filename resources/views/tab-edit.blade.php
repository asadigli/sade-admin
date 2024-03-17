@extends('layouts.master')

@section('css')
<title>Tab Edit</title>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/datatables.bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('adm/css/plugins/animate.min.css')}}"/>
@endsection
@section('body')
  <div id="content">
    <div class="panel box-shadow-none content-header">
      <div class="panel-body">
        <div class="col-md-12">
          <h3 class="animated fadeInLeft">Tab Edit</h3>
          <p class="animated fadeInDown">
            List <span class="fa-angle-right fa"></span> Tabs
          </p>
        </div>
      </div>
    </div>
    @include('layouts.alerts')
    <div class="col-md-12 top-20 padding-0">
      <div class="col-md-12">
          <div class="panel form-element-padding">
            <div class="panel-heading capi">
             <h4>{{ trans('app.add_tab')}}</h4>
            </div>
             <div class="panel-body" style="padding-bottom:30px;">
              <div class="col-md-12">
                  <form class="form-horizontal row-fluid" action="/edit/tab/{{$tab->id}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                      <label class="col-sm-2 control-label text-right" for="news_body">Page</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="page_id" required>
                            @php
                            $page = App\Page::where('id','=',[$tab->page_id])->get()
                            @endphp
                            @foreach($page as $pg)
                            <option class="capi" value="{{$pg->id}}" selected>{{$pg->title}}</option>
                            @endforeach
                          <option class="capi" value="0">{{trans('app.none')}}</option>
                          @php
                          $pages = App\Page::all()
                          @endphp
                          @foreach($pages as $page)
                          <option class="capi" value="{{$page->id}}">{{$page->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label text-right" for="question">Question</label>
                      <div class="col-sm-10">
                        <input class="form-control" name="question" placeholder="Question..." value="{{$tab->question}}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label text-right" for="status">Status</label>
                      <div class="col-sm-10">
                        <input type="radio" name="status" value="1" {{ ($tab->status == 1) ? "checked" : "" }}/>
                        <span class="outer">
                        <span class="inner"></span></span> Active
                        <input type="radio" name="status" value="0"  {{ ($tab->status == 0) ? "checked" : "" }}/>
                        <span class="outer">
                        <span class="inner"></span></span> Not Active
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label text-right" for="news_body">Answer</label>
                      <div class="col-sm-10">
                        <textarea name="answer" placeholder="Answer...">{{$tab->answer}}</textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label text-right"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-success pull-right capi">{{ trans('app.edit')}}</button>
                      </div>
                    </div>
                    </form>
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
