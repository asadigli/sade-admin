<div class="featured-products-slider">
  <h3 class="products_title">{{ trans('app.featured_products')}}</h3>
  <div class="slider-items-products">
    <div id="featured-products-slider" class="product-flexslider hidden-buttons">
      <div class="slider-items slider-width-col4">
        @php
        $productdetails = App\ProductDetails::orderBy('created_at','desc')->get()
        @endphp
        @foreach($productdetails as $prodet)
        <div class="product-item">
          <div class="item-inner">
            <div class="product-thumbnail">
              @if(!empty($prodet->discount) && ($prodet->discount) != 0)
              <div class="icon-sale-label sale-left">{{substr((($prodet->price)-(($prodet->price)-($prodet->discount)))*100/($prodet->price),0,4)}}%</div>
              @endif
              <div class="btn-quickview"> <a href="/product_details/{{$prodet->productname}}"><span>{{ trans('app.view')}}</span></a></div>
              <div class="add-to-links">
                 <!-- <a href="wishlist.html" class="action add-to-wishlist" title="Add to Wishlist"> <span>Wishlist</span> </a> -->
                <!-- <a href="compare.html" class="action add-to-compare" title="Add to Compare"> <span>Compare</span> </a> -->
             </div>
              <a href="/product_details/{{$prodet->productname}}" class="product-item-photo">
              @if($prodet->photos != 'defaultimage.jpg')
                @if(!empty($prodet->photos))
                  @php
                  $digits = substr($prodet->photos, strpos( $prodet->photos, '/uploads'));
                  @endphp
    							<img class="product-image-photo" src="{{$digits}}"/>
    						@elseif(!empty($prodet->photos2))
                  @php
                  $digits2 = substr($prodet->photos2, strpos( $prodet->photos2, '/uploads'));
                  @endphp
    							<img class="product-image-photo" src="{{$digits2}}"  alt=""/>
    						@elseif(!empty($prodet->photos3))
                  @php
                  $digits3 = substr($prodet->photos3, strpos( $prodet->photos3, '/uploads'));
                  @endphp
    							<img class="product-image-photo" src="{{$digits3}}" alt=""/>
    						@elseif(!empty($prodet->photos4))
                  @php
                  $digits4 = substr($prodet->photos4, strpos( $prodet->photos4, '/uploads'));
                  @endphp
    							<img class="product-image-photo" src="{{$digits4}}" alt=""/>
    						 @endif
                @else
                  <img class="product-image-photo" src="{{ asset('images/defaultimage.jpg')}}" alt=""/>
                @endif
                <!-- <img class="" src="images/products/img16.jpg" alt=""> -->
              </a>
              </div>
            <div class="pro-box-info">
              <div class="item-info">
                <div class="info-inner">
                  <div class="item-title"> <a title="Ipsums Dolors Untra" href="/product_details/{{$prodet->productname}}">{{substr($prodet->productname,0,25)}}
      							@if(strlen($prodet->productname)>25)
      							...
      							@endif </a> </div>
                  <div class="item-content">

                    @php
                     $star_1 = App\Newscomment::where('news_id','=',0)->where('product_id','=',[$prodet->id])->where('verify','=',1)->get()
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


                    <div class="item-price">
                      <div class="price-box"> <span class="regular-price"> <span class="price">
                        @if(empty($prodet->discount))
            							@if(($prodet->currency)==1)
            							 {{$prodet->price}}AZN
            							@elseif(($prodet->currency)==2)
            							${{$prodet->price}}
            							@else(($prodet->currency)==3)
            							{{$prodet->price}}€
            							@endif
            						@else
            							@if(($prodet->currency)==1)
            							 {{($prodet->price)-($prodet->discount)}}AZN
            							@elseif(($prodet->currency)==2)
            							${{($prodet->price)-($prodet->discount)}}
            							@else(($prodet->currency)==3)
            							{{($prodet->price)-($prodet->discount)}}€
            							@endif
            						@endif
                      </span> </span> </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-hover">
                <div class="product-item-actions">
                  <div class="pro-actions">
                    @if (Route::has('login'))
                    @if (Auth::check())
                    <form action="addtowishlist" method="post">
                        {{csrf_field()}}

                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="product_id" value="{{$prodet->id}}">
                        <input type="hidden" name="product_name" value="{{$prodet->productname}}">
                        <input type="hidden" name="product_features" value="{{$prodet->features}}">
                        <input type="hidden" name="product_price" value="{{$prodet->price}}">
                        <input type="hidden" name="product_quantity" value="{{$prodet->quantity}}">
                        <input type="hidden" name="product_discount" value="{{$prodet->discount}}">
                        <input type="hidden" name="product_currency" value="{{$prodet->currency}}">
                        <!-- <button type="submit" name="submit" class="action add-to-cart" title="Add to Cart">
                           <span>Add to Cart</span>
                        </button> -->
                      </form>
                      @endif
                      @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </div>
</div>
