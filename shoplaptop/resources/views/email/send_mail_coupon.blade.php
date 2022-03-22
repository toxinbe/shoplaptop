<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mã Khuyến mãi</title>
	<style type="text/css">
		body{
			font-family: Arial;
		}
		.coupon{
			border: 5px dotted #bbb;
			width: 80%;
			border-radius: 15px;
			margin: 0 auto;
			max-width: 600px;
		}
		.container{
			padding: 2px 16px;
			background-color: #f1f1f1;
		}
		.promo{
			background: #ccc;
			padding: 3px;
		}
		.expire{
			color: red;
		}
		p.code{
			text-align: center;
			font-size: 20px;
		}
		p.expire{
			text-align: center;
		}
		h2.note{
			text-align: center;
			font-size: large;
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<div class="coupon">
		<div class="container">
			<h3>Mã khuyến mãi từ shop <a href="{{ route('trang-chu') }}" target="_blank">ShopPv.vn</a></h3>
		</div>
		<div class="container" style="background: #fff">
			<h2 class="note"><b><i>Giảm @if($coupon_array['coupon_send_new']['coupon_condition'] == 0)
				{{$coupon_array['coupon_send_new']['coupon_number']}} %
			@else
				{{number_format($coupon_array['coupon_send_new']['coupon_number'],0,',','.')}} VNĐ
			@endif cho tổng đơn hàng trên 2 triệu</i></b></h2>
			<p>Quý khách đã từng mua hàng tại shop <a href="{{ route('trang-chu') }}" target="_blank">ShopPv.vn</a> nếu đã có tài khoản xin vui lòng <a href="{{ route('dangnhap') }}" target="_blank" style="color: red">Đăng Nhập</a> vào tài khoản để mua hàng và nhập mã code phía dưới để được giảm giá mua hàng, xin cảm ơn quý khách. Chúc quý khách thật nhiều sức khỏe và bình an trong cuộc sống.  </p>
			
		</div>
		<div class="container">
			<p class="code">Sừ dụng Code sau: <span class="promo">{{$coupon_array['coupon_send_new']['coupon_code']}}</span></p>
			<p class="expire">Ngày hết hạn code: {{$coupon_array['coupon_send_new']['coupon_date_end']}}</p>
		</div>
	</div>
</body>
</html>