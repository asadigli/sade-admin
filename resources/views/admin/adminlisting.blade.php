@extends('admin.adminmaster')


@section('navbar')
    <!-- /navbar -->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <!--/.span3-->
                <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>
                                    All Users</h3>
                            </div>
                            <div class="module-option clearfix">
                                <form>
                                <div class="input-append pull-left">
                                    <input type="text" class="span3" placeholder="Filter by name...">
                                    <button type="submit" class="btn">
                                        <i class="icon-search"></i>
                                    </button>
                                </div>
                                </form>
                                <div class="btn-group pull-right" data-toggle="buttons-radio">
                                    <button type="button" class="btn">
                                        All</button>
                                    <button type="button" class="btn">
                                        Male</button>
                                    <button type="button" class="btn">
                                        Female</button>
                                </div>
                            </div>
                            <div class="module-body">
                              @php
                              $user = App\User::all()
                              @endphp
                              @foreach($user as $user)
                              @if((($user->role_id)==2))
                                <div class="row-fluid">
                                    <!-- <div class="span6">
                                        <div class="media user">
                                            <a class="media-avatar pull-left" href="#">
                                                <img src="images/user.png">
                                            </a>
                                            <div class="media-body">
                                                <h3 class="media-title">
                                                    John Donga
                                                </h3>
                                                <p>
                                                    <small class="muted">Pakistan</small></p>
                                                <div class="media-option btn-group shaded-icon">
                                                    <button class="btn btn-small">
                                                        <i class="icon-envelope"></i>
                                                    </button>
                                                    <button class="btn btn-small">
                                                        <i class="icon-share-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="span6">
                                        <div class="media user">
                                            <a class="media-avatar pull-left" href="#">
                                                <img src="images/user.jpg">
                                            </a>
                                            <div class="media-body">
                                                <h3 class="media-title">
                                                    {{$user->name}} {{$user->surname}}</h3>
                                                <p>
                                                    <small class="muted">{{$user->country}} / {{$user->role_id}}</small></p>
                                                    <small class="muted">Birthday: {{$user->dob}}</small></p>

                                                <div class="media-option btn-group shaded-icon">
                                                    <button class="btn btn-small">
                                                        <i class="icon-envelope"></i>
                                                    </button>
                                                    <button class="btn btn-small">
                                                        <i class="icon-share-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                @endif
                                @endforeach
                                <div class="pagination pagination-centered">
                                    <ul>
                                        <li><a href="#"><i class="icon-double-angle-left"></i></a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#"><i class="icon-double-angle-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->
  @endsection
