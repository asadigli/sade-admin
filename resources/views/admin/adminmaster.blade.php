<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link type="text/css" href="{{ asset('/Admin/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('/Admin/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('/Admin/theme.css')}}" rel="stylesheet">
        <link type="text/css" href="{{ asset('/images/icons/css/font-awesome.css')}}" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700' rel='stylesheet' type='text/css'>

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo-dark.png')}}" />
            <style media="screen">
            .modal  {
                padding-right: 0px;
                background-color: rgba(4, 4, 4, 0.8);
                }
                .modal-dialog {
                        top: 20%;
                            width: 100%;
                position: absolute;
                    }
                    .modal-content {
                            border-radius: 0px;
                            border: none;
                top: 40%;
                        }
                        .modal-body {
                                background-color: #0f8845;
                color: white;
                            }

            </style>
            <style media="screen">
            .modal{
              display:none; /* I added this to see the modal, you don't need this */
            }
            .modal-dialog{
              overflow-y: initial !important
            }
            .modal-body{
              height: 300px;
              overflow-y: auto;
            }
            </style>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <div class="modal-body" style="background-color:gray;">

                  <H2>Opps!</H2>
                  <h4 style="color:white;"><i>This part will be added later.</i></h4>

                  </div>
                </div>
              </div>
            </div>

    </head>
    <body>
      @include('layouts.admin.header')
        <!-- /navbar -->
        <div class="span3"><br>
            <div class="sidebar"  id="myGroup">
                <ul class="widget widget-menu unstyled">
                    <li class="active"><a href="/adm/" style="text-transform:capitalize;"><i class="menu-icon icon-dashboard"></i>{{ trans('app.admin_home')}}
                    </a></li>
                    <!-- <li class="active"><a href="/community"><i class="menu-icon icon-user"></i>E-Mall Community
                      <b class="label orange pull-right">

                        </b>
                    </a></li> -->
                    <!-- <li class="active"><a href="/adm/newproducts"><i class="menu-icon icon-dashboard"></i>New Products
                      <b class="label green pull-right">

                        </b>
                      </a></li> -->
                    <li class="active"><a href="/adm/helpdeskcontrol" style="text-transform:capitalize;"><i class="menu-icon icon-medkit"></i> {{trans('app.contacts')}}
                      <b class="label orange pull-right">
                        @php
                        $ct = App\Contact::all()
                        @endphp
                        {{count($ct)}}
                      </b>
                    </a></li>
                    <li class="active"><a href="/adm/unverified" style="text-transform:capitalize;"><i class="menu-icon icon-medkit"></i>
                      <b class="label orange pull-right">
                        @php
                        $newscomment = App\Newscomment::where('verify','=',0)->get()
                        @endphp
                        {{count($newscomment)}}

                      </b>
                    </a></li>
                    <li>
                      <a class="collapsed" data-toggle="collapse" href="#togglePa" style="text-transform:capitalize;"><i class="menu-icon icon-cog">
                    </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                    </i>{{ trans('app.lists')}}</a>
                        <ul id="togglePa" class="collapse unstyled">
                          <li><a href="/adm/productlist" style="text-transform:capitalize;"><i class="menu-icon icon-bullhorn"></i>{{ trans('app.product_list')}}
                              <b class="label green pull-right">
                                @php
                            $productdetails_unconfirmed = App\ProductDetails::where('confirmed','0')->get()
                            @endphp
                            {{count($productdetails_unconfirmed)}}
                          </b></a>
                          </li>
                          <li><a href="/adm/catlists" style="text-transform:capitalize;"><i class="menu-icon icon-bullhorn"></i>{{ trans('app.category_list')}}
                            <b class="label green pull-right">
                              @php
                              $cat = App\Category::all()
                              @endphp
                              {{count($cat)}}
                            </b>
                            </a></li>
                          <li><a href="/adm/vipcomments" style="text-transform:capitalize;"><i class="menu-icon icon-tasks"></i>{{ trans('app.vip_comment_list')}}
                            @php
                            $vp = App\VipComments::all()
                            @endphp
                              <b class="label orange pull-right">
                                {{count($vp)}}
                              </b>
                          </a> </li>
                          @if(Auth::user()->role_id == 4)
                            <li><a href="/adm/userlist" style="text-transform:capitalize;"><i class="menu-icon icon-tasks"></i>{{ trans('app.user_list')}} </a></li>
                          @endif
                        </ul>
                    </li>
                    </li>

                </ul>
                <ul class="widget widget-menu unstyled">
                  <li><a class="collapsed" data-toggle="collapse" href="#toggleP" style="text-transform:capitalize;"><i class="menu-icon icon-cog">
                  </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                  </i>{{ trans('app.create')}}</a>
                      <ul id="toggleP" class="collapse unstyled">
                        <li><a href="/adm/sellproduct" style="text-transform:capitalize;"><i class="menu-icon icon-inbox"></i>{{ trans('app.addproduct')}} </a></li>
                        <!-- <li><a href="/adm/location"><i class="menu-icon icon-inbox"></i>Add Location  </a></li> -->
                        @if(Auth::user()->role_id == 4 | Auth::user()->role_id == 3)
                        <li><a href="/adm/catcreation" style="text-transform:capitalize;"><i class="menu-icon icon-inbox"></i>{{ trans('app.addcategory')}}  </a></li>
                        @endif
                        <li><a href="/adm/addnews" style="text-transform:capitalize;"><i class="menu-icon icon-inbox"></i>{{ trans('app.addnews')}} </a></li>
                        <li><a href="/adm/boostedlist" style="text-transform:capitalize;"><i class="menu-icon icon-inbox"></i>{{ trans('app.addposter')}} </a> </li>
                        @if(Auth::user()->role_id == 4)
                        <li><a href="/adm/usercreation" style="text-transform:capitalize;"><i class="menu-icon icon-inbox"></i>{{ trans('app.createuser')}} </a> </li>
                        @endif
                      </ul>
                  </li>
                </ul>
                <ul class="widget widget-menu unstyled">
                    <li>
                      <!-- <a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                    </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                    </i>Admin Control </a> -->
                        <ul id="togglePages" class="collapse unstyled">
                            <!-- <li><a href="registeradm"><i class="menu-icon icon-tasks"></i>Register new adm  </a></li> -->
                            <li><a href="#"><i class="menu-icon icon-tasks"></i>All Admin  </a></li>
                            <!-- <li><a href="/adm/boostedlist"><i class="menu-icon icon-signout"></i>Boosted Products -->
                              <b class="label green pull-right">
                                    @php
                                    $boostedproducts = App\BoostedProducts::all()
                                    @endphp
                                    {{count($boostedproducts)}}
                                </b>
                            </a>
                            </li>
                            <!-- <li><a href="/adm/about"><i class="menu-icon icon-signout"></i>Edit Website Description
                            </a></li> -->
                        </ul>
                    </li>

                    <li><a href="/" style="text-transform:capitalize;"><i class="menu-icon icon-signout"></i>{{ trans('app.go_to_store')}} </a></li>
                    <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="menu-icon icon-signout"></i>{{ trans('app.logout')}} </a></li>
                </ul>
            </div>
        </div>
        @section('navbar')

        @show
        <div class="footer">
            <div class="container">
                <p class="pull-right">{{date('Y')}} &copy; SadeStore</p>
            </div>
        </div>
        <script src="{{ asset('/scripts/jquery-1.9.1.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/scripts/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/Admin/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/scripts/flot/jquery.flot.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/scripts/flot/jquery.flot.resize.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/scripts/datatables/jquery.dataTables.js')}}" type="text/javascript"></script>
        <script src="{{ asset('/scripts/common.js')}}" type="text/javascript"></script>
        <script type="text/javascript">
        $(function() {
            for (i = new Date().getFullYear(); i > 1900; i--){
                $('#years').append($('<option />').val(i).html(i));
            }
            for (i = 1; i < 13; i++){
                $('#months').append($('<option />').val(i).html(i));
            }
            updateNumberOfDays();
            $('#years, #months').change(function(){
                updateNumberOfDays();
            });
        });
        function updateNumberOfDays(){
            $('#days').html('');
            month = $('#months').val();
            year = $('#years').val();
            days = daysInMonth(month, year);
            for(i=1; i < days+1 ; i++){
                    $('#days').append($('<option />').val(i).html(i));
            }
        }
        function daysInMonth(month, year) {
            return new Date(year, month, 0).getDate();
        }
        var $myGroup = $('#myGroup');
		$myGroup.on('show.bs.collapse','.collapse', function() {
		    $myGroup.find('.collapse.in').collapse('hide');
		});
        </script>

    </body>
</html>
