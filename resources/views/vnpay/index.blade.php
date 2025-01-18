@extends('Layout')
@section('title')    
Order Cart Online
@endsection
@section('content-layout')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">Home</a></li>
                <li class="active"><a href="">Checkout</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- coupon-area start -->
<div class="coupon-area pt-100 pt-sm-60">
    <div class="container">
        @if(count($errors)>0)
        <div class="alert alert-danger" style="width: 100%">
            @foreach($errors->all() as $err)
            {{$err}}<br>
            @endforeach
        </div>
        @endif
        @if(Session::has('thongbao'))
          <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Thành công!</strong> {{Session::get('thongbao')}}!
          </div>
        @endif
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Thành công!</strong> {{Session::get('message')}}!
            </div>
        @elseif(Session::has('message_err'))
            <div class="alert alert-danger  alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Thất bại!</strong> {{Session::get('message_err')}}!
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="coupon-accordion">
                    <!-- ACCORDION START -->
                    @if(!Session::get('coupon') && Session::has('cart'))
                    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <form method="post" action="{{url('/check-coupon')}}">
                                @csrf
                                <p class="checkout-coupon">
                                    <input type="text" class="code" name="coupon_code" placeholder="Coupon code" />
                                    <input type="submit" name="check_coupon" value="Apply Coupon" />
                                </p>
                            </form>
                        </div>
                    </div>
                    @endif
                    <!-- ACCORDION END -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- coupon-area end -->
<!-- checkout-area start -->
<div class="checkout-area pb-100 pt-15 pb-sm-60">
    <div class="container">
        <form action="{{route('vnpayonline')}}" method="post" class="beta-form-checkout" id="create_form">
        <div class="row">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form mb-sm-40">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Họ và tên <span class="required">*</span></label>
                                    <input type="text" name="name23131" placeholder="Họ tên" required value="{{$user_dh->full_name}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Giới Tính <span class="required">*</span></label>
                                    <input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                                    <input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="order-notes">
                                <div class="checkout-form-list">
                                    <label>Address <span class="required">*</span></label>
                                    <textarea  name="address11223" id="address11223" placeholder="Street Address"rows="4" cols="50">{{$user_dh->address}}</textarea>
                                </div>
                            </div>
                            </div><br><br><br><br><br><br><br>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Email Address <span class="required">*</span></label>
                                    <input type="email" id="email" name="email" required value="{{$user_dh->email}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list mb-30">
                                    <label>Phone  <span class="required">*</span></label>
                                    <input type="text" id="phone" name="phone" required value="{{$user_dh->phone}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label for="bank_code">Ngân hàng  <span class="required">*</span></label>
                                    <select name="bank_code" id="bank_code" required="">
                                        <option value="">Không chọn</option>
                                        <option value="NCB"> Ngan hang NCB</option>
                                        <option value="AGRIBANK"> Ngan hang Agribank</option>
                                        <option value="SCB"> Ngan hang SCB</option>
                                        <option value="SACOMBANK">Ngan hang SacomBank</option>
                                        <option value="EXIMBANK"> Ngan hang EximBank</option>
                                        <option value="MSBANK"> Ngan hang MSBANK</option>
                                        <option value="NAMABANK"> Ngan hang NamABank</option>
                                        <option value="VNMART"> Vi dien tu VnMart</option>
                                        <option value="VIETINBANK">Ngan hang Vietinbank</option>
                                        <option value="VIETCOMBANK"> Ngan hang VCB</option>
                                        <option value="HDBANK">Ngan hang HDBank</option>
                                        <option value="DONGABANK"> Ngan hang Dong A</option>
                                        <option value="TPBANK"> Ngân hàng TPBank</option>
                                        <option value="OJB"> Ngân hàng OceanBank</option>
                                        <option value="BIDV"> Ngân hàng BIDV</option>
                                        <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                                        <option value="VPBANK"> Ngan hang VPBank</option>
                                        <option value="MBBANK"> Ngan hang MBBank</option>
                                        <option value="ACB"> Ngan hang ACB</option>
                                        <option value="OCB"> Ngan hang OCB</option>
                                        <option value="IVB"> Ngan hang IVB</option>
                                        <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                                    </select>
                    
                                </div>
                            </div>

                        </div>


                        <div class="different-address">
                            <div class="order-notes">
                                <div class="checkout-form-list">
                                    <label>Order Notes</label>
                                    <textarea id="notes" name="notes" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="your-order">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(Session::has('cart'))
                                    @foreach($product_cart as $cart)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{$cart['item']->$multisp}} <span class="product-quantity"> × {{$cart['qty']}}</span>
                                        </td>
                                        <td class="product-total">

                                            <span class="amount">{{number_format($cart['price'],0,',','.')}} VNĐ</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    @if(!Session::get('coupon'))
                                    <tr class="cart-subtotal">
                                        <th>Cart Total</th>
                                        <td>
                                            <span class="amount">
                                                @if(Auth::check() && Session('cart'))
                                                    {{number_format($totalPrice,0,',','.')}} VNĐ
                                                @else
                                                    0 VNĐ
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    @else
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td>
                                            <span class="amount" id="Amount" name="Amount">
                                                @if(Auth::check() && Session('cart'))
                                                    {{number_format($totalPrice,0,',','.')}} VNĐ
                                                @else
                                                    0 VNĐ
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Cart Total</th>
                                        <td>
                                            <span class="amount">
                                                @foreach(Session::get('coupon') as $key => $coun)
                                                    @if(Session::get('coupon') && $coun['coupon_condition']==0)
                                                    @php
                                                        $total_coupon = ($totalPrice*$coun['coupon_number'])/100;
                                                        $total_pre = $totalPrice-$total_coupon;
                                                        $totalPrice = $total_pre;
                                                    @endphp
                                                        {{number_format($totalPrice,0,',','.')}} VNĐ
                                                    @elseif(Session::get('coupon') && $coun['coupon_condition']==1)
                                                        @php
                                                            $total_coupon = $totalPrice-$coun['coupon_number'];
                                                            $totalPrice = $total_coupon;
                                                        @endphp
                                                        {{number_format($totalPrice,0,',','.')}} VNĐ
                                                    @endif
                                                @endforeach
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingthree">
                                        <h5 class="mb-0">
                                            <a class="btn btn-link collapsed">
                                              Thanh toán online
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse show" aria-labelledby="headingthree" data-parent="#accordion">
                                        <div class="card-body">
                                             <p>Online</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="payment_method" name="payment_method" value="ATM">
                    <div class="card-body" >
                        @if(Session::has('cart'))
                            <div class="buttons-cart" style="text-align: center; width: 100%;">
                                <button type="submit" name="paymentoder" id="btnPopup" value="2"><span>Thanh toán Online</span></button>
                            </div>
                        @else
                            <div class="buttons-cart" style="text-align: center; width: 100%;">
                                <a href="{{route('trang-chu')}}"><i class="fa fa-angle-left movleft"></i> Tiếp tục mua sắm</a>
                            </div>
                        @endif
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
<!-- checkout-area end -->
    <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
    <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
    <script type="text/javascript">
        $("#btnPopup").click(function () {
            var postData = $("#create_form").serialize();
            var submitUrl = $("#create_form").attr("action");
            $.ajax({
                type: "POST",
                url: submitUrl,
                data: postData,
                dataType: 'JSON',
                success: function (x) {
                    if (x.code === '00') {
                        if (window.vnpay) {
                            vnpay.open({width: 768, height: 600, url: x.data});
                        } else {
                            location.href = x.data;
                        }
                        return false;
                    } else {
                        alert(x.Message);
                    }
                }
            });
            return false;
        });
    </script>
<style type="text/css">
    .nice-select{
        display: none;
    }
    .checkout-form-list select{
        display: flex !important;
        background: #ffffff none repeat scroll 0 0;
        border: 1px solid #ebebeb;
        border-radius: 0;
        -webkit-box-shadow: 0 0px 2px rgba(0, 0, 0, 0.075);
        box-shadow: 0 0px 2px rgba(0, 0, 0, 0.075);
        height: 34px;
        padding: 0 0 0 10px;
        width: 100%;
    }
</style>
@endsection