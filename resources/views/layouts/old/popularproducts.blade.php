<div class="single-img-add sidebar-add-slider ">
  <div id="carousel-example-generic" class="carousel ">
    <div class="carousel-inner" role="listbox">
      @php
      $poster = App\Poster::inRandomOrder()->take(1)->get()
      @endphp
      @foreach($poster as $post)
      <div class="">
        @if(!empty($post->product_id) && ($post->product_id != 0))
              @php
                  $prod = App\ProductDetails::where('id','=',[$post->product_id])->get()
              @endphp
              @foreach($prod as $pro)
                  <a href="/product_details/{{$pro->productname}}">
                    <img src="/uploads/productposter/{{$post->poster}}" alt="slide1">
                  </a>
              @endforeach
        @elseif($post->product_id == 0)
              <img src="/uploads/productposter/{{$post->poster}}" alt="slide1">
        @else
              <a href="/news/{{$post->item_id}}">
                <img src="/uploads/productposter/{{$post->poster}}" alt="slide1">
              </a>
        @endif
      </div>
      @endforeach
    </div>
</div>
