<style media="screen">
/* .wrapper {
    padding: 20px;
    margin: 100px auto;
    width: 400px;
    min-height: 200px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,.1);
    background-color: #fff;
} */
.ratingg{
    overflow: hidden;
    vertical-align: bottom;
    display: inline-block;
    width: auto;
    height: 40px;
    /* margin-top: px; */
    margin-left: -80px;
}
.ratingg > input{
    opacity: 0;
    margin-right: -100%;
}
.ratingg > label{
    position: relative;
    display: block;
    float: right;
    background: url('{{ asset('images/star-off-big.png')}}') repeat-x 0 0;
    background-size: 30px 30px;
}
.ratingg > label:before{
    display: block;
    opacity: 0;
    content: '';
    width: 30px;
    height: 30px;
    background: url('{{ asset('images/star-on-big.png')}}') repeat-x 0 0;
    background-size: 30px 30px;
    transition: opacity 0.2s linear;
}
.ratingg > label:hover:before,
.ratingg > label:hover ~ label:before,
.ratingg:not(:hover) > :checked ~ label:before{
    opacity: 1;
}

</style>
                  <div class="tab-pane fade" id="custom_tabs">
                      <div class="product-tabs-content-inner clearfix">
                        <div class="single-box">
                          <h2 class="">{{ trans('app.comments')}}</h2>
                          <div class="comment-list">
                            <ul>
                              @php
                              $newscomment = App\Newscomment::where('verify','=','1')->where('news_id','=',0)->where('product_id','=',[$productdetails->id])->orderBy('created_at','desc')->get()
                              @endphp
                              @if(count($newscomment) == 0)
                              <br>
                              <center><i style="color:gray;text-transform:capitalize;">{{ trans('app.no_comment_here')}}</i></center>
                              <br>
                              @endif
                              @foreach($newscomment as $nc)
                              <li>
                                <div class="avartar"> <img src="{{ asset('images/main_avatar.png')}}" alt="Avatar" style="opacity:0.6;"> </div>
                                <div class="comment-body">
                                  <div class="comment-meta"> <span class="author"><a href="mailto:{{$nc->email}}">{{$nc->name}} {{$nc->surname}}</a></span>
                                    <span> <i style="color:gray;"> - {{$nc->rating}}</i> <i class="fa fa-star" style="color:orange;"></i></span>
                                    <span class="date"><i><small>{{$nc->created_at->diffForHumans()}}</small> </i> </span>
                                  </div>
                                  <div class="comment">
                                    {!! nl2br(e($nc->message)) !!}
                                  </div>
                                </div>
                              </li>
                              @endforeach
                              <!-- <li>
                                <ul>
                                  <li>
                                    <div class="avartar"> <img src="images/avatar.png" alt="Avatar"> </div>
                                    <div class="comment-body">
                                      <div class="comment-meta"> <span class="author"><a href="#">Admin</a></span> <span class="date">2015-04-01</span> </div>
                                      <div class="comment"> Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. </div>
                                    </div>
                                  </li>
                                </ul>
                              </li> -->

                            </ul>
                          </div>
                        </div>
                        <div class="single-box comment-box">
                          <h2>{{trans('app.leave_a_comment')}}</h2>
                          <div class="coment-form">
                            <p>{{ trans('app.here_you_can_say_your_opinion_about_the_news')}}</p>

                            <form  action="/addnewscomment" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="news_id" value="0">
                              <input type="hidden" name="product_id" value="{{$productdetails->id}}">
                              <div class="row">
                                <div class="col-sm-6">
                                  <label for="name" style="text-transform:capitalize;">{{ trans('app.name')}}</label>
                                  <input id="name" name="name" type="text" minlength="2" maxlength="50" class="form-control" placeholder="type your name here..." required>
                                </div>
                                <div class="col-sm-6">
                                  <label for="email" style="text-transform:capitalize;">{{ trans('app.surname')}}</label>
                                  <input id="email" name="surname" type="text" minlength="2" maxlength="50" class="form-control" placeholder="type your surname here..." required>
                                </div>
                                <div class="col-sm-12">
                                  <label for="website" style="text-transform:capitalize;">{{ trans('app.email')}}</label>
                                  <input id="website" name="email" type="email" minlength="2" maxlength="70" class="form-control" placeholder="type your email here..." required>
                                </div>

                                <div class="col-sm-6">
                                  <label for="rating" style="text-transform:capitalize;">{{ trans('app.rating')}}</label><br>
                                    <span class="ratingg">
                                        <input id="rating5" type="radio" name="rating" value="5">
                                        <label for="rating5">5</label>
                                        <input id="rating4" type="radio" name="rating" value="4" checked>
                                        <label for="rating4">4</label>
                                        <input id="rating3" type="radio" name="rating" value="3">
                                        <label for="rating3">3</label>
                                        <input id="rating2" type="radio" name="rating" value="2" >
                                        <label for="rating2">2</label>
                                        <input id="rating1" type="radio" name="rating" value="1">
                                        <label for="rating1">1</label><br>
                                    </span>
                                </div>
                                <br>
                                <div class="col-sm-12">
                                  <label for="message" style="text-transform:capitalize;">{{ trans('app.message')}}</label>
                                  <textarea name="message" name="message" id="message" minlength="5" maxlength="500" rows="8" class="form-control" placeholder="your opinion..." required></textarea>
                                </div>
                              </div>
                              <button class="button" type="submit"><span>{{ trans('app.post')}}</span></button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
