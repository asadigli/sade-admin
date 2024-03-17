<div class="testimonials">
  <div class="slider-items-products">
    <div id="testimonials-slider" class="product-flexslider hidden-buttons home-testimonials">
      <div class="slider-items slider-width-col4 ">
        @php
        $vp = App\VipComments::all()
        @endphp
        @foreach($vp as $vp)
        <div class="holder">
          <p>{{ $vp->message}} </p>
          <div class="thumb">
            <img src="{{ asset('images/main_avatar.png')}}" alt="testimonials img">
          </div>
          <div class="author"> <strong class="name">{{$vp->name}} {{$vp->surname}}</strong>
            <strong class="designation">{{$vp->rating}} <i class="fa fa-star" style="color:orange"></i> </strong>
          </div>
        </div>
        @endforeach



      </div>
    </div>
  </div>
</div>
