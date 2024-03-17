@if (Route::has('login'))
			@if (Auth::check())
			<div class="modal fade" id="Modalstar" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:14%;">
				<div class="modal-dialog" >
					<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
						<form  action="/givestar" method="post">
              {{csrf_field()}}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

              </div>
							<div class="modal-body" style="background-color:white;">
								<div class="star-rating">
									<center>
									<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
									<input type="hidden" name="product_id" value="{{$productdetails->id}}">
									<fieldset class="star-rating star-5">
								    <input type="radio" name="stars" value="1" />
										<input type="radio" name="stars" value="2" />
										<input type="radio" name="stars" value="3" />
										<input type="radio" name="stars" value="4" />
										<input type="radio" name="stars" value="5" />
										<input type="hidden" name="_token" value="{{ csrf_token() }}">

								  </fieldset>
								</center>
								</div>
							</div>
							<div class="modal-footer">
								<button type="reset" class="btn btn-success" data-dismiss="modal">{{ trans('app.close') }}</button>
								<button type="submit" class="btn btn-primary">{{ trans('app.ok') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			@endif
			@endif
			@if (Route::has('login'))
			@if (Auth::check())
			@php
			$fivestar = App\Star::all()
			@endphp
			@if(!count($fivestar)==0)
			<div class="modal fade" id="Modalstarchange" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:14%;">
				<div class="modal-dialog" >
					<div class="modal-content" style="box-shadow:10px 1px 40px 1px gray;">
						<form  action="/changestar/{{Auth::user()->id}}" method="post">
              {{csrf_field()}}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

              </div>
							<div class="modal-body" style="background-color:white;">
								<div class="star-rating">
									<center>
									<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
									Sizin verdiyiniz dəyər:  <i class="icon-star" style="color:orange;"></i>
									<fieldset class="star-rating star-5">
								    <input type="radio" name="stars" value="1" />
										<input type="radio" name="stars" value="2" />
										<input type="radio" name="stars" value="3" />
										<input type="radio" name="stars" value="4" />
										<input type="radio" name="stars" value="5" />
								  </fieldset>
								</center>
								</div>
							</div>
							<div class="modal-footer">
								<button type="reset" class="btn btn-success" data-dismiss="modal">{{ trans('app.close') }}</button>
								<button type="submit" class="btn btn-primary">{{ trans('app.ok')}}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			@endif
			@endif
			@endif
