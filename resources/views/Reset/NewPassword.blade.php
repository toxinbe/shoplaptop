@extends('Layout')
@section('title')    
{{ trans('home.forgot') }}
@endsection
@section('content-layout')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">Home</a></li>
                <li><a href="{{route('dangky')}}">account</a></li>
                <li class="active"><a href="{{$url_canonical}}">New Password</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Register Account Start -->
<div class="Lost-pass ptb-100 ptb-sm-60">
    <div class="container">
        <div class="register-title">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {!! session()->get('message') !!}
                </div>
            @elseif(session()->has('error'))
                 <div class="alert alert-danger">
                    {!! session()->get('error') !!}
                </div>
            @endif
            @php
                $token = $_GET['token'];
                $email = $_GET['email'];
            @endphp
            <h3 class="mb-10 custom-title">New Password</h3>
            <form class="password-forgot clearfix" action="{{route('updatenewpass')}}" method="POST">
            	<input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="email" value="{{$email}}">
                <input type="hidden" name="token" value="{{$token}}">
                <fieldset>
                    <legend>Your Personal Details</legend>
                    <div class="form-group d-md-flex">
                        <label class="control-label col-md-2" for="email"><span class="require">*</span>New Password</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password_account" id="password_account" placeholder="Enter you password here...">
                        </div>
                    </div>
                </fieldset>
                <div class="buttons newsletter-input">
                    <div class="float-left float-sm-left">
                        <a class="customer-btn mr-20" href="{{url('/quen-mat-khau')}}">Back</a>
                    </div>
                    <div class="float-right float-sm-right">
                        <input type="submit" value="Continue" class="return-customer-btn">
                    </div>
                </div>
            </form>
    </div>
    <!-- Container End -->
</div>
<!-- Register Account End -->
@endsection