@extends('Layout')
@section('title')    
{{ trans('home.signup') }}
@endsection
@section('content-layout')

<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">{{trans('home.home')}}</a></li>
                <li class="active"><a href="{{route('dangky')}}">{{trans('home.signup')}}</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Register Account Start -->
<div class="register-account ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="register-title">
                    <h3 class="mb-10">{{trans('home.signup')}} {{trans('home.account')}}</h3>
                    <p class="mb-10">{{trans('home.signup_nd1')}}</p>
                </div>
            </div>
        </div>
        <!-- Row End -->
        <div class="row">
            <div class="col-sm-12">
                <form class="form-register" method="POST" action="{{route('dangky')}}" novalidate="novalidate">
                    @csrf
                    <fieldset>
                        <legend>{{trans('home.signup_nd2')}}</legend>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="f-name"><span class="require">*</span>{{trans('home.fullname')}}</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="{{trans('home.fullname')}}">
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="email"><span class="require">*</span>Email</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="abc@gmail.com">
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="number"><span class="require">*</span>{{trans('home.phone')}}</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" id="phone" name="phone" placeholder="{{trans('home.phone')}}">
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="number"><span class="require">*</span>{{trans('home.ress')}}</label>
                            <div class="col-md-10">
                                <textarea class="form-control" placeholder="{{trans('home.ress')}}" id="adress" name="adress"></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>{{trans('home.signup_nd3')}}</legend>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="pwd"><span class="require">*</span>{{trans('home.pass')}}:</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="******">
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="pwd-confirm"><span class="require">*</span>{{trans('home.repassword')}}</label>
                            <div class="col-md-10">
                                <input type="password" class="form-control" id="re_password" name="re_password" placeholder="{{trans('home.repassword')}}">
                            </div>
                        </div>
                    </fieldset>
                   
                    <div class="terms">
                        <div class="float-md-right">
                            <input type="submit" value="{{trans('home.continue')}}" class="return-customer-btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Register Account End -->
@endsection