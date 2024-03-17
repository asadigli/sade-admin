<div class="best-sale-product">
  <div class="sidebar-bar-title">
    <h3 style="text-transform:capitalize;">{{ trans('app.products_of_week')}}</h3>
  </div>
  <div class="block-content">
    <div class="slider-items-products">
      <div id="best-sale-slider" class="product-flexslider hidden-buttons">
        <div class="slider-items slider-width-col4">
          <div class="product-item">
            @php
              $prods = App\ProductDetails::inRandomOrder()->take(3)->get()
            @endphp
            @foreach($prods as $prod)
            <div class="best-sale-item">
              <div class="products-block-left"> <a href="/product_details/{{$prod->productname}}" title="Sample Product" class="product-image">
                @if($prod->photos != 'defaultimage.jpg')
                  @if(!empty($prod->photos))
                      @php
                      $digits = substr($prod->photos, strpos( $prod->photos, '/uploads'));
                      @endphp
                      <img src="{{$digits}}"/>
                    @elseif(!empty($prod->photos2))
                      @php
                      $digits2 = substr($prod->photos2, strpos( $prod->photos2, '/uploads'));
                      @endphp
                     <img src="{{ $digits2}}"  alt=""/>
                    @elseif(!empty($prod->photos3))
                      @php
                      $digits3 = substr($prod->photos3, strpos( $prod->photos3, '/uploads'));
                      @endphp
                      <img  src="{{ $digits3}}" alt=""/>
                    @elseif(!empty($prod->photos4))
                      @php
                      $digits4 = substr($prod->photos4, strpos( $prod->photos4, '/uploads'));
                      @endphp
                     <img  src="{{ $digits4}}" alt=""/>
                    @endif
                  @else
                    <img  src="{{ asset('images/defaultimage.jpg')}}" alt=""/>
                  @endif
              </a></div>
              <div class="products-block-right">
                <p class="product-name"> <a href="/product_details/{{$prod->productname}}">{{substr($prod->productname,0,80)}}
                @if(strlen($prod->productname>80))
                ...
                @endif</a> </p>
                <span class="price">
                  @if(empty($prod->discount))
                    @if(($prod->currency)==1)
                      {{$prod->price}}AZN
                    @elseif(($prod->currency)==2)
                      ${{$prod->price}}
                    @else(($prod->currency)==3)
                      {{$prod->price}}€
                    @endif
                  @else
                    @if(($prod->currency)==1)
                      {{($prod->price)-($prod->discount)}}AZN
                    @elseif(($prod->currency)==2)
                      ${{($prod->price)-($prod->discount)}}
                    @else(($prod->currency)==3)
                      {{($prod->price)-($prod->discount)}}€
                    @endif
                  @endif
                </span>
                <div class="rating">
                  @php
                   $star_1 = App\Newscomment::where('news_id','=',0)->where('product_id','=',[$prod->id])->where('verify','=',1)->get()
                  @endphp
                  @php($total = 0)
                  @foreach($star_1 as $st)
                   @php($total += $st->rating)
                  @endforeach
                  @if(count($star_1) != 0)
                    @if(substr($total/(count($star_1)),0,3) <= 1)
                      <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                    @elseif(substr($total/(count($star_1)),0,3) > 1 && substr($total/(count($star_1)),0,3) <= 2)
                      <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                    @elseif(substr($total/(count($star_1)),0,3) > 2 && substr($total/(count($star_1)),0,3) <= 3)
                      <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                    @elseif(substr($total/(count($star_1)),0,3) > 3 && substr($total/(count($star_1)),0,3) <= 4)
                      <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                    @elseif(substr($total/(count($star_1)),0,3) > 4 && substr($total/(count($star_1)),0,3) <= 5)
                    <div class="rating">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    @endif
                    @else
                    <div class="rating">
                      <i class="fa fa-star-o"></i>
                      <i class="fa fa-star-o"></i>
                      <i class="fa fa-star-o"></i>
                      <i class="fa fa-star-o"></i>
                      <i class="fa fa-star-o"></i>
                    </div>
                  @endif
                 </div>
              </div>
            </div>
            @endforeach

          </div>
          <div class="product-item">

             <!-- SECOND PART  -->


            @php
              $producttt = App\ProductDetails::inRandomOrder()->take(3)->get()
            @endphp
            @foreach($producttt as $prod2)
            <div class="best-sale-item">
              <div class="products-block-left"> <a href="" class="product-image">
                @if($prod2->photos != 'defaultimage.jpg')
                  @if(!empty($prod2->photos))
                    @php
                    $digits20 = substr($prod2->photos, strpos( $prod2->photos, '/uploads'));
                    @endphp
                    <img src="{{ $digits20}}"/>
                  @elseif(!empty($prod2->photos2))
                    @php
                    $digits22 = substr($prod2->photos, strpos( $prod2->photos2, '/uploads'));
                    @endphp
                   <img src="{{$digits22}}"  alt=""/>
                  @elseif(!empty($prod2->photos3))
                    @php
                    $digits23 = substr($prod2->photos, strpos( $prod2->photos3, '/uploads'));
                    @endphp
                    <img  src="{{$digits23}}" alt=""/>
                  @elseif(!empty($prod2->photos4))
                    @php
                    $digits24 = substr($prod2->photos, strpos( $prod2->photos4, '/uploads'));
                    @endphp
                   <img  src="{{$digits24}}" alt=""/>
                  @endif
                @else
                  <img  src="{{ asset('images/defaultimage.jpg')}}" alt=""/>
                @endif
              </a></div>
              <div class="products-block-right">
                <p class="product-name"> <a href="/product_details/{{$prod2->id}}">
                  {{substr($prod2->productname,0,80)}}
                  @if(strlen($prod2->productname>80))
                  ...
                  @endif
                </a> </p>
                <span class="price">
                    @if(empty($prod2->discount))
                      @if(($prod2->currency)==1)
                        {{$prod2->price}}AZN
                      @elseif(($prod2->currency)==2)
                        ${{$prod2->price}}
                      @else(($prod2->currency)==3)
                        {{$prod2->price}}€
                      @endif
                    @else
                      @if(($prod2->currency)==1)
                        {{($prod2->price)-($prod2->discount)}}AZN
                      @elseif(($prod2->currency)==2)
                        ${{($prod2->price)-($prod2->discount)}}
                      @else(($prod2->currency)==3)
                        {{($prod2->price)-($prod2->discount)}}€
                      @endif
                    @endif
                </span>
                <div class="rating">
                  @php
                   $star_1 = App\Newscomment::where('news_id','=',0)->where('product_id','=',[$prod2->id])->where('verify','=',1)->get()
                  @endphp
                  @php($total = 0)
                  @foreach($star_1 as $st)
                   @php($total += $st->rating)
                  @endforeach
                  @if(count($star_1) != 0)
                    @if(substr($total/(count($star_1)),0,3) <= 1)
                      <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                    @elseif(substr($total/(count($star_1)),0,3) > 1 && substr($total/(count($star_1)),0,3) <= 2)
                      <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                    @elseif(substr($total/(count($star_1)),0,3) > 2 && substr($total/(count($star_1)),0,3) <= 3)
                      <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                    @elseif(substr($total/(count($star_1)),0,3) > 3 && substr($total/(count($star_1)),0,3) <= 4)
                      <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                      </div>
                    @elseif(substr($total/(count($star_1)),0,3) > 4 && substr($total/(count($star_1)),0,3) <= 5)
                    <div class="rating">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    @endif
                    @else
                    <div class="rating">
                      <i class="fa fa-star-o"></i>
                      <i class="fa fa-star-o"></i>
                      <i class="fa fa-star-o"></i>
                      <i class="fa fa-star-o"></i>
                      <i class="fa fa-star-o"></i>
                    </div>
                  @endif
                 </div>
              </div>
            </div>
            @endforeach


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
