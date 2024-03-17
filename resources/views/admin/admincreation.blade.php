@extends('admin.adminmaster')

@section('navbar')
<title>{{ trans('app.registernewadmin')}}</title>

        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <h3 style="text-transform:capitalize;"> {{ trans('app.registernewadmin')}}  </h3>
                                </div>
                                <div class="module-body table">
                                    @if(Session::has('success'))
                                      <div class="col-md-4">
                                        <div class="alert alert-success">
                                          {{Session::get('success')}}
                                        </div>
                                      </div>
                                    @endif
                                    		<form class="form-horizontal" role="form" method="POST" action="/adm/assignadmin/{{{$user->id}}}/edit">
                                    				{{ csrf_field() }}

                                    				<div class="form-group control-group">
                                              <label for="role_id"  class="col-md-4 control-label"> Vəzifə </label>
                                    						<div class="col-md-6 controls">
                                    								<!-- <input id="role_id" type="hidden" class="form-control" name="role_id" value="2" required=""> -->
                                                    <select id="role_id" name="role_id" required="">
                                                      <option value="{{$user->role_id}}" name="role_id">
                                                        @if($user->role_id == 1)
                                                          Sadə İstifadəçi
                                                        @elseif($user->role_id == 2)
                                                          3-cü Dərəcəli
                                                        @elseif($user->role_id == 3)
                                                          2-ci Dərəcəli
                                                        @else
                                                          1-ci Dərəcəli
                                                        @endif
                                                      </option>
                                                      <option value="1" name="role_id" id="role_id">Sadə İstifadəçi</option>
                                                      <option value="2" name="role_id" id="role_id">3-cü Dərəcəli</option>
                                            					<option value="3" name="role_id" id="role_id">2-ci Dərəcəli</option>
                                                      <option value="4" name="role_id" id="role_id">1-ci Dərəcəli</option>
                                                    </select>
                                    						</div>
                                    				</div>

                                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} control-group">
                                              <label for="email" class="col-md-4 control-label">E-Mail Address<sup>*</sup></label>

                                              <div class="col-md-6 controls">
                                                  <input id="email" value="{{$user->email}}" type="email" class="form-control" name="email" placeholder="Email" required>

                                                  @if ($errors->has('email'))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first('email') }}</strong>
                                                      </span>
                                                  @endif
                                              </div>
                                          </div><br><br>

                                          <div class="form-group">
                                              <div class="col-md-6 col-md-offset-4">

                                                  <button type="submit" class="btn btn-primary" style="margin-left:60%;">
                                                      Update
                                                  </button>
                                              </div>
                                          </div>
                                      </form>
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
        </div><script>
        $(function() {

            //populate our years select box
            for (i = new Date().getFullYear(); i > 1900; i--){
                $('#years').append($('<option />').val(i).html(i));
            }
            //populate our months select box
            for (i = 1; i < 13; i++){
                $('#months').append($('<option />').val(i).html(i));
            }
            //populate our Days select box
            updateNumberOfDays();

            //"listen" for change events
            $('#years, #months').change(function(){
                updateNumberOfDays();
            });

        });

        //function to update the days based on the current values of month and year
        function updateNumberOfDays(){
            $('#days').html('');
            month = $('#months').val();
            year = $('#years').val();
            days = daysInMonth(month, year);

            for(i=1; i < days+1 ; i++){
                    $('#days').append($('<option />').val(i).html(i));
            }
        }

        //helper function
        function daysInMonth(month, year) {
            return new Date(year, month, 0).getDate();
        }
        </script>
        <!--/.wrapper-->
    @endsection
