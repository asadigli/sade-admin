<div id="latest-news" class="news">
  <div class="page-header">
    <h2 style="text-transform:capitalize;"> {{ trans('app.latest_news')}} <small><a href="/allnews" style="text-transform:capitalize;">{{ trans('app.all_news')}}</a></small> </h2>
  </div>
  <div class="slider-items-products">
    <div id="latest-news-slider" class="product-flexslider hidden-buttons">
      <div class="slider-items slider-width-col6">
        @php
        $news = App\News::orderBy('created_at','desc')->get()
        @endphp
        @foreach($news as $news)
        <div class="item">
          <div class="jtv-blog">
            <div class="blog-img"> <a href="/news/{{$news->id}}"> <img class="primary-img" src="/uploads/news/{{$news->news_image_1}}" alt=""></a> <span class="moretag"></span> </div>
            <div class="blog-content-jtv">
              <h2><a href="/news/{{$news->id}}">{{substr(($news->news_title),0,55)}}
              @if(strlen($news->news_title) > 55)
              ...
              @endif
              </a></h2>
              <span><i class="fa fa-calendar"></i>{{$news->created_at->toFormattedDateString()}}</span>
              <!-- <span class="blog-likes"><i class="fa fa-thumbs-up"></i>149</span> -->
              <span class="blog-comments"><i class="fa fa-comment"></i>
                @php
                $nsc = App\Newscomment::where('news_id','=',[$news->id])->where('verify','=',1)->get()
                @endphp
                {{count($nsc)}}
              </span>
              <p>{{substr(($news->news_body),0,100)}}
                @if(strlen($news->news_body) > 100)
                ...
                @endif
              </p>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </div>
</div>
