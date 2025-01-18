@extends('Layout')
@section('title')    
{{ trans('home.signin') }}
@endsection
@section('content-layout')

<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">{{trans('home.home')}}</a></li>
                <li class="active"><a href="{{route('dangnhap')}}">{{trans('home.signin')}}</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- LogIn Page Start -->
<div class="log-in ptb-100 ptb-sm-60">

    <div class="container">
        <div class="row">
            <!-- New Customer Start -->
            <div class="col-md-6">
                <div class="well mb-sm-30">
                    <div class="new-customer">
                        <h3 class="custom-title">{{trans('home.signup')}}</h3>
                        <p class="mtb-10"><strong></strong></p>
                        <p>{{trans('home.signup_nd')}}</p>
                        <a class="customer-btn" href="{{route('dangky')}}">{{trans('home.continue')}}</a>
                    </div>
                </div>
            </div>
            <!-- New Customer End -->
            <!-- Returning Customer Start -->
            <div class="col-md-6">
                <div class="well">
                    <div class="return-customer">
                        <h3 class="mb-10 custom-title">{{trans('home.signin')}}</h3>
                        <p class="mtb-10"><strong></strong></p>
                        <form id="loginForm" method="POST" action="{{route('dangnhap')}}" novalidate="novalidate" >
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" placeholder="abc@gmail.com" id="input-email" class="form-control">
                            </div>
                            <div class="form-group" id="show_hide_password">
                                <label>{{trans('home.pass')}}</label>
                                <input type="password" name="password" placeholder="******" id="input-password" class="form-control" style="width: 92%;">
                                <button style="float: right; padding-right: 2%; height: 34.8px; margin-top: -6.5%; border: 1px solid #ced4da; background: #e9ecef" class="btn btn-outline-secondary" type="button" id="btnPassword">
                                <span  id="icon_span" class="fas fa-eye-slash"></span></button>
                                <!-- <i style="float: right; padding-right: 2%; margin-top: -5%;" class="fa fa-eye-slash" aria-hidden="true"></i> -->
                            </div>
                            <p class="lost-password"><a href="{{url('/quen-mat-khau')}}">{{ trans('home.forgot') }}</a></p>

                            <input type="submit" value="{{trans('home.signin')}}" class="return-customer-btn" style="width: 100%;height: 45px;">
                            {{-- <p style="text-align: center;margin-top: 10px; margin-bottom: -7px;">Or</p> --}}
                            {{-- s --}}

                        </form>
                        <style type="text/css">
                            .google{
                                width: 100%;
                                height: 45px;
                                background: #fff;
                                border: 1px solid #222222;
                            }
                            .google a{
                                color: #000;
                            }
                            .google a:hover{
                                color: #fff;
                            }
                        </style>
                    </div>
                </div>
            </div>
            <!-- Returning Customer End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- LogIn Page End -->
<script type="text/javascript">
    let showPassword = false

    const ipnElement = document.querySelector('#input-password')
    const btnElement = document.querySelector('#btnPassword')
    const iconElement = document.querySelector('#icon_span')

    btnElement.addEventListener('click', function() {
      if (showPassword) {
        // Đang hiện password
        // Chuyển sang ẩn password
        iconElement.setAttribute('class', 'fas fa-eye-slash')
        ipnElement.setAttribute('type', 'password')
        showPassword = false
      } else {
        // Đang ẩn password
        // Chuyển sang hiện password
        iconElement.setAttribute('class', 'fas fa-eye')
        ipnElement.setAttribute('type', 'text')
        showPassword = true
      }
    })
</script>
@endsection