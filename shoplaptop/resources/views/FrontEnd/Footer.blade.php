<!-- Support Area Start Here -->
<div class="support-area bdr-top">
    <div class="container">
        <div class="d-flex flex-wrap text-center">
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-gift"></i>
                </div>
                <div class="support-desc">
                    <h6>{{ trans('home.GreatValue') }}</h6>
                    <!-- <span>Nunc id ante quis tellus faucibus dictum in eget.</span> -->
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-rocket"></i>
                </div>
                <div class="support-desc">
                    <h6>{{ trans('home.WorlwideDelivery') }}</h6>
                    <!-- <span>Quisque posuere enim augue, in rhoncus diam dictum non</span> -->
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-lock"></i>
                </div>
                <div class="support-desc">
                    <h6>{{ trans('home.SafePayment') }}</h6>
                    <!-- <span>Duis suscipit elit sem, sed mattis tellus accumsan.</span> -->
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-enter-down"></i>
                </div>
                <div class="support-desc">
                    <h6>{{ trans('home.ShopConfidence') }}</h6>
                    <!-- <span>Faucibus dictum suscipit eget metus. Duis  elit sem, sed.</span> -->
                </div>
            </div>
            <div class="single-support">
                <div class="support-icon">
                    <i class="lnr lnr-users"></i>
                </div>
                <div class="support-desc">
                    <h6>{{ trans('home.24/7HelpCenter') }}</h6>
                    <!-- <span>Quisque posuere enim augue, in rhoncus diam dictum non.</span> -->
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Support Area End Here -->
<!-- them so sanh -->
<div class="modal" id="sosanhsp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">

                    <table class="table table-hover" id="row_compare">
                        <thead>
                            <tr style="text-align: center;">
                                <th>{{ trans('home.nameproduct') }}</th>
                                <th>{{ trans('home.hinhanh') }}</th>
                                <th>{{ trans('home.del') }}</th>
                                <th>{{ trans('home.chitiet') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- them yeu thich -->
<div class="modal" id="yeuthichsp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">

                    <table class="table table-hover" id="row_yeuthich">
                        <thead>
                            <tr style="text-align: center;">
                                <th>{{ trans('home.nameproduct') }}</th>
                                <th>{{ trans('home.hinhanh') }}</th>
                                <th>{{ trans('home.del') }}</th>
                                <th>{{ trans('home.chitiet') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="{{ route('wishlist') }}" class="btn btn-danger">{{ trans('home.chitiet') }}</a>
            </div>

        </div>
    </div>
</div>
<!-- Footer Area Start Here -->
<footer class="off-white-bg2 pt-95 bdr-top pt-sm-55 ">
    <!-- Footer Top Start -->
    <div class="footer-top">
        <div class="container">
            <!-- Signup Newsletter Start -->
            <div class="row mb-60">
                <div class="col-xl-7 col-lg-7 ml-auto mr-auto col-md-8">
                    <div class="news-desc text-center mb-30">
                        <h3>Sign Up For Newsletters</h3>
                        <p>Be the First to Know. Sign up for newsletter today</p>
                    </div>
                    <div class="newsletter-box">
                        <form action="#">
                            <input class="subscribe" placeholder="your email address" name="email" id="subscribe"
                                type="text">
                            <button type="submit" class="submit">subscribe!</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Signup-Newsletter End -->
            <div class="row">
                <!-- Single Footer Start -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Information</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="{{ route('gioithieu') }}">{{ trans('home.about') }}</a></li>
                                <li><a href="#">Delivery Information</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="lien-he">Terms & Conditions</a></li>
                                <li><a href="{{ route('dangnhap') }}">FAQs</a></li>
                                <li><a href="{{ route('dangnhap') }}">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Customer Service</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="lien-he">Contact Us</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Order History</a></li>
                                <li><a href="{{ route('wishlist') }}">{{ trans('home.addwishlist') }}</a></li>
                                <li><a href="#">Site Map</a></li>
                                <li><a href="#">Gift Certificates</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">Extras</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="#">Newsletter</a></li>
                                <li><a href="#">Brands</a></li>
                                <li><a href="#">Gift Certificates</a></li>
                                <li><a href="#">Affiliate</a></li>
                                <li><a href="#">Specials</a></li>
                                <li><a href="#">Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">My Account</h3>
                        <div class="footer-content">
                            <ul class="footer-list">
                                <li><a href="{{ route('lienhe') }}">Contact Us</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">Order History</a></li>
                                <li><a href="{{ route('wishlist') }}">{{ trans('home.addwishlist') }}</a></li>
                                <li><a href="#">Newsletter</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
                <!-- Single Footer Start -->
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-footer mb-sm-40">
                        <h3 class="footer-title">My Account</h3>
                        <div class="footer-content">
                            <ul class="footer-list address-content">
                                <li><i class="lnr lnr-map-marker"></i> Address: 180 Cao lỗ, Phường 4, Quận 8,
                                    TpHCM</li>
                                <li><i class="lnr lnr-envelope"></i><a href="mailto:npn020899@gmail.com"> mail Us:
                                        Support@ShopPV.com </a></li>
                                <li>
                                    <i class="lnr lnr-phone-handset"></i><a href="tel:+84773654031"> Phone:(+84)
                                        123456789) </a>
                                </li>
                            </ul>
                            <div class="payment mt-25 bdr-top pt-30">
                                <a href="#"><img class="img"
                                        src="{{ asset('source/assets/frontend/img/payment/1.png') }}"
                                        alt="payment-image"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Footer Start -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Top End -->
    <!-- Footer Middle Start -->
    <div class="footer-middle text-center">
        <div class="container">
            <div class="footer-middle-content pt-20 pb-30">
                <ul class="social-footer">
                    <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                    <!--                         <li><a href="#"><img src="{{ asset('source/assets/frontend/img/icon/social-img1.png') }}" alt="google play"></a></li>
                        <li><a href="#"><img src="{{ asset('source/assets/frontend/img/icon/social-img2.png') }}" alt="app store"></a></li> -->
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Middle End -->
    <!-- Footer Bottom Start -->
    <div class="footer-bottom pb-30">
        <div class="container">

            <div class="copyright-text text-center">
                <p>Copyright © 2022 <a target="_blank" href="#">ShopPV</a> All Rights Reserved.</p>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Bottom End -->
</footer>
<!-- Footer Area End Here -->
<!-- Quick View Content Start -->
<div class="main-product-thumbnail quick-thumb-content">
    <div class="container">
        <!-- The Modal -->
        @foreach ($all_product as $all)
            <div class="modal fade" id="myModal_{{ $all->id }}">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <!-- Main Thumbnail Image Start -->
                                <div class="col-lg-5 col-md-6 col-sm-5">
                                    <!-- Thumbnail Large Image start -->
                                    <div class="tab-content">
                                        <div id="thumb1_{{ $all->id }}" class="tab-pane fade show active">
                                            <a data-fancybox="images"
                                                href="source/image/product/{{ $all->image }}"><img
                                                    src="source/image/product/{{ $all->image }}" alt="product-view"
                                                    height="331.66px" width="331.66px"></a>
                                        </div>
                                    </div>
                                    <!-- Thumbnail Large Image End -->
                                    <!-- Thumbnail Image End -->
                                    <div class="product-thumbnail mt-20">
                                        <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                                            <a class="active" data-toggle="tab"
                                                href="#thumb1_{{ $all->id }}"><img
                                                    src="source/image/product/{{ $all->image }}"
                                                    alt="product-thumbnail" height="98.55px" width="98.55px"></a>
                                        </div>
                                    </div>
                                    <!-- Thumbnail image end -->
                                </div>
                                <!-- Main Thumbnail Image End -->
                                <!-- Thumbnail Description Start -->
                                <div class="col-lg-7 col-md-6 col-sm-7">
                                    <div class="thubnail-desc fix mt-sm-40">
                                        <h3 class="product-header">{{ $all->$multisp }}</h3>
                                        <div class="pro-price mtb-30">
                                            <p class="d-flex align-items-center">
                                                @if ($all->promotion_price != 0)
                                                    <span
                                                        class="prev-price">{{ number_format($all->unit_price, 0, ',', '.') }}
                                                        VNĐ</span>
                                                    <span
                                                        class="price">{{ number_format($all->promotion_price, 0, ',', '.') }}
                                                        VNĐ</span>
                                                    <span class="saving-price">sale
                                                        {{ number_format(100 - ($all->promotion_price / $all->unit_price) * 100) }}%</span>
                                                @else
                                                    <span
                                                        class="price">{{ number_format($all->unit_price, 0, ',', '.') }}
                                                        VNĐ</span>
                                                @endif
                                            </p>
                                        </div>
                                        <p class="mb-20 pro-desc-details">{!! $all->$multi_description !!}</p>
                                        <!--                                     <div class="color mb-20">
                                        <label>color</label>
                                        <ul class="color-list">
                                            <li>
                                                <a class="orange active" href="#"></a>
                                            </li>
                                            <li>
                                                <a class="paste" href="#"></a>
                                            </li>
                                        </ul>
                                    </div> -->
                                        <div class="box-quantity d-flex">
                                            <form action="#">
                                                <input class="quantity mr-40" type="number" min="1" value="1">
                                            </form>
                                            @if ($all->product_quantity > 0)
                                                <a class="add-cart" <?php
if (Auth::check() || Session::get('user_name_login')) {
    $addnewcart = route('themgiohang', $all->id);
} else {
    $addnewcart = route('dangnhap');
}
?>
                                                    href="{{ $addnewcart }}" title="{{ trans('home.addcart') }}">+
                                                    {{ trans('home.addcart') }}</a>
                                            @else
                                                <a class="add-cart disabled-link"> + {{ trans('home.addcart') }}</a>
                                            @endif
                                        </div>
                                        <div class="pro-ref mt-15">
                                            <p>
                                                @if ($all->product_quantity > 0)
                                                    <span class="in-stock"><i class="ion-checkmark-round"></i>
                                                        {{ trans('home.INSTOCK') }}</span>
                                                @else
                                                    <span class="out-stock"><i class="ion-close"></i>
                                                        {{ trans('home.OUTSTOCK') }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Thumbnail Description End -->
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="custom-footer">
                            <div class="socila-sharing">
                                <ul class="d-flex">
                                    <li>share</li>
                                    <li><a class="share"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}&amp;src=sdkpreparse"><i
                                                class="fa fa-facebook " aria-hidden="true"></i></a></li>
                                    <li><a class="share"
                                            href="http://twitter.com/share?url={{ $url_canonical }}"><i
                                                class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a class="share"
                                            href="https://plus.google.com/share?url={{ $url_canonical }}"><i
                                                class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
                                    <li><a class="share"
                                            href="http://pinterest.com/pin/create/button/?url={{ $url_canonical }}&description={{ $all->$multi_description }}&media={{ $image_og }}"><i
                                                class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Quick View Content End -->
<!-- Your Chat Plugin code -->
<div class="fb-customerchat" attribution="setup_tool" page_id="100286602132094" theme_color="#0A7CFF">
</div>
