@extends('admin.adminmaster')

@section('navbar')
<title>{{ trans('app.adminpanel')}}</title>

        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">

                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="/adm/productlist" class="btn-box big span4"><i class="icon-money"></i><b>{{count($productdetails)}}</b>
                                        <p class="text-muted">
                                            {{ trans('app.products')}}</p>
                                    </a><a href="/adm/userlist" class="btn-box big span4"><i class="icon-user"></i><b>{{count($users)}}</b>
                                        <p class="text-muted">
                                            {{ trans('app.users')}}</p>
                                    </a>
                                    <a href="#" class="btn-box big span4"><i class=" icon-random"></i><b> {{ trans('app.posts')}}</b>
                                        <p class="text-muted">
                                            {{count($posts)}}</p>
                                    </a>
                                </div>
                                <div class="btn-box-row row-fluid">
                                    <div class="span8">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="/adm/helpdeskcontrol" class="btn-box small span4"><i class="icon-envelope"></i><b>Helpdesk</b>
                                                  <a href="#" class="btn-box small span4"><i class="icon-save"></i><b>Total Sales</b>
                                                  </a><a href="" class="btn-box small span4"><i class="icon-bullhorn"></i><b>Community</b>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                              <!-- </a><a href="#" class="btn-box small span4"><i class="icon-group"></i><b>Clients</b> -->
                                              <!-- </a><a href="#" class="btn-box small span4"><i class="icon-exchange"></i><b>Expenses</b> -->

                                                <!-- </a><a href="#" class="btn-box small span4"><i class="icon-sort-down"></i><b>Bounce -->
                                                <!-- </b> </a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="widget widget-usage unstyled span4">
                                        <li>
                                            <p>
                                                <strong>{{ trans('app.gender')}}</strong> <span class="pull-right small muted">
                                                  @php
                                                  $user_male = App\User::where('gender',1)->get()
                                                  @endphp
                                                  @php
                                                  $user_female = App\User::where('gender', 2)->get()
                                                  @endphp
                                                  @if(!(count($user_male)+count($user_female))==0)
                                                  {{substr(((count($user_male)/(count($user_male)+count($user_female)))*100),0,4)}}% is male <br>
                                                  {{100-substr(((count($user_male)/(count($user_male)+count($user_female)))*100),0,4)}}% is female
                                                  @endif
                                                </span>
                                            </p><br>
                                            <div class="progress tight" style="height:20px;">
                                              @if(!(count($user_male)+count($user_female))==0)
                                                <div class="bar" style="width: {{(count($user_male)/(count($user_male)+count($user_female)))*100}}%;">
                                                  {{ trans('app.male_users')}}
                                                </div>
                                              @endif
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>{{ trans('app.product_condition')}}</strong> <span class="pull-right small muted">
                                                  @php
                                                  $prodet_new = App\ProductDetails::where('condition',1)->get()
                                                  @endphp
                                                  @php
                                                  $prodet_used = App\ProductDetails::where('condition',2)->get()
                                                  @endphp
                                                  @if(!(count($prodet_new)+count($prodet_used))==0)
                                                  {{substr(((count($prodet_new)/(count($prodet_new)+count($prodet_used)))*100),0,4)}}% {{ trans('app.new')}}<br>
                                                  {{100-substr(((count($prodet_new)/(count($prodet_new)+count($prodet_used)))*100),0,4)}}% {{ trans('app.used')}}
                                                  @endif
                                                </span>
                                            </p><br>
                                            <div class="progress tight" style="height:20px;">
                                                  <i>{{ trans('app.used')}}</i>
                                                  @if(!(count($prodet_new)+count($prodet_used))==0)
                                                <div class="bar bar-success" style="width: {{(count($prodet_new)/(count($prodet_new)+count($prodet_used)))*100}}%;">
                                                  <i>{{ trans('app.new')}}</i>
                                                </div>
                                                @endif
                                            </div>
                                        </li>
                                        <!-- <li>
                                            <p>
                                                <strong>Linux</strong> <span class="pull-right small muted">44%</span>
                                            </p>
                                            <div class="progress tight" style="height:20px;">
                                                <div class="bar bar-warning" style="width: 44%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>iPhone</strong> <span class="pull-right small muted">67%</span>
                                            </p>
                                            <div class="progress tight" style="height:20px;">
                                                <div class="bar bar-danger" style="width: 67%;">
                                                </div>
                                            </div>
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                            <!--/#btn-controls-->


                            <div class="module">
                                <div class="module-head">
                                    <h3>
                                        {{ trans('app.products')}}</h3>
                                </div>
                                <div class="module-body table">
                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    {{ trans('app.productname')}}
                                                </th>

                                                <th>
                                                    {{ trans('app.price')}}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                          $pd = App\ProductDetails::all()
                                          @endphp
                                          @foreach($pd as $pd)
                                            <tr class="odd gradeX">
                                                <td>
                                                    {{ $pd->productname}}
                                                </td>
                                                <td>
                                                    {{ $pd->price}}
                                                </td>
                                                <!-- <td class="center">
                                                    X
                                                </td> -->
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th>
                                                  {{ trans('app.productname')}}
                                              </th>

                                              <th>
                                                  {{ trans('app.price')}}
                                              </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!--/.module-->
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
