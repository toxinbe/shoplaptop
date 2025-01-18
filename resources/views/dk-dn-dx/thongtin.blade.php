
@yield('content-tt')
<!----------------------------------------------thong tin----------------------------------------------------------------->

    <div class="modal fade" id="userUpdate" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-write">
                    <h4 class="modal-title">{{ trans('home.up_date') }}</h4>
<!--                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="margin-bottom: 100%" aria-hidden="true"></span>
                    </button> -->

                <button class="btn btn-link closebtntt" type="button" data-dismiss="modal" >X</button>
                </div>
                <form action="{{route('userupdate1')}}" method="post"><!-- form delete -->
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <!--   <input type = "text" hidden class="col-sm-9 form-control"id ="idUpdate" name ="idUpdate" value="" /> -->
    		       @if(count($errors)>0)
						<div class="alert alert-danger">
							@foreach($errors->all() as $err)
							{{$err}}<br>
							@endforeach
						</div>
					@endif

                    <div class="modal-body">
                    	@if(Auth::check())
						<div class="form-group">
							<label for="your_last_name">{{ trans('home.fullname') }}*</label>
							<input type="text" name="name"  value="{{Auth::user()->full_name}}" >
						</div>

						<div class="form-group">
							<label for="adress">{{ trans('home.ress') }}*</label>
							<input type="text" name="adress"  value="{{Auth::user()->address}}">
						</div>
	                    <div class="form-group">
							<label for="email">Email*</label>
							<input type="email" name="email"  value="{{Auth::user()->email}}">
						</div>
						<div class="form-group">
							<label for="phone">{{ trans('home.phone') }}*</label>
							<input type="text" name="phone"  value="{{Auth::user()->phone}}">
						</div>
						<div class="form-group">
							<label for="phone">{{ trans('home.pass') }}*</label>
							<input type="password" name="password" >
						</div>
						<div class="form-group">
							<label for="phone">{{ trans('home.repassword') }}*</label>
							<input type="password" name="re_password">
						</div>
						@endif



                    </div>
                    <div class="modal-footer">
<!-- 	                        <button type="submit" class="btn btn-success" data-dismiss="modal"><i class="icofont icofont-check-circled"></i>{{ trans('home.cancel') }}</button> -->
	                        <button type="submit"  class="btn btn-primary"><i class="icofont icofont-check-circled"></i>{{ trans('home.up_date') }}</button>
	                        @if(Auth::check() && Auth::user()->level == 1)
			                	<a  class="btn btn-info" href="{{route('trang-chu-admin')}}">Go Admin</a>
			            	@endif
                    </div>
                </form>

            </div>
        </div>
    </div>