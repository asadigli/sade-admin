<div class="block popular-tags-area ">
  <div class="sidebar-bar-title">
    <h4 style="color:white;text-transform:capitalize;">{{ trans('app.most_searched')}}</h4>
  </div>
  <style media="screen">
  .buttonn {
  background-color: #eceeec;
  height: 30px;
  border: none;
  color: gray;
  /* padding: 15px 32px; */
  text-align: center;
  text-decoration: none;
  display: inline-block;
  /* font-size: 16px; */
}
  </style>
  <div class="tag">
    <ul>
      <form action="/searchedproducts/{request}" method="get">
        {{csrf_field()}}
      @php
      $tag = App\Tag::inRandomOrder()->take(10)->get()
      @endphp
      @foreach($tag as $tag)
      <li>
        <input type="hidden" name="search" class="form-control" placeholder="Search..." value="{{$tag->tag_name}}" required>
        <button class="buttonn" type="submit" style="text-transform:capitalize;">
       &nbsp; {{$tag->tag_name}} &nbsp;</button>
      </li>
      @endforeach

    </form>
    </ul>
  </div>
</div>
