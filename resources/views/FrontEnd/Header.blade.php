<div class="popup_banner">
    <span class="popup_off_banner">×</span>
    <div class="banner_popup_area">
            <img src="{{asset('source/assets/frontend/img/banner/pop-banner.jpg')}}" alt="">
    </div>
</div>
<!-- Banner Popup End -->
<!-- Newsletter Popup Start -->
<div class="popup_wrapper">
    <div class="test">
        <span class="popup_off">Close</span>
        <div class="subscribe_area text-center mt-60">
            <h2>Newsletter</h2>
            <p>Subscribe to the Truemart mailing list to receive updates on new arrivals, special offers and other discount information.</p>
            <div class="subscribe-form-group">
                <form action="#">
                    <input autocomplete="off" type="text" name="message" id="message" placeholder="Enter your email address">
                    <button type="submit">subscribe</button>
                </form>
            </div>
            <div class="subscribe-bottom mt-15">
                <input type="checkbox" id="newsletter-permission">
                <label for="newsletter-permission">Don't show this popup again</label>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter Popup End -->
<!-- Main Header Area Start Here -->
<header>


    @extends('dk-dn-dx/dangxuat')
    @section('content-dx')
    @endsection
    <!-- Header Top Start Here -->
    <div class="header-top-area">
        <div class="container">
            <!-- Header Top Start -->
            <div class="header-top">
                <ul>
                    <li><a href="#">{{trans('home.freeship')}}</a></li>

                    @if(Session('cart'))
                    <li><a href="{{route('shoppingcart')}}">{{trans('home.carttt')}}</a></li>
                    <!-- <li><a href="{{route('dathang')}}">Checkout</a></li> -->
                    @endif
                </ul>
                <ul>                                          
                    <li><span>{{ trans('home.lang_1') }}:</span> <a href="#">
                        @if(config('app.locale') != 'en')
                        <img src="{{asset('source/assets/dest/img/vn.png')}}" width="16px" alt="language-selector">
                        @else
                        <img src="{{asset('source/assets/frontend/img/header/1.jpg')}}" alt="language-selector">
                        @endif
                        <i class="lnr lnr-chevron-down"></i></a>
                        <!-- Dropdown Start -->
                        <ul class="ht-dropdown">
                            <li><a href="{{URL::asset('')}}language/vi"><img src="{{asset('source/assets/dest/img/vn.png')}}" width="16px" alt="language-selector">{{ trans('home.languagevi') }}</a></li>
                            <li><a href="{{URL::asset('')}}language/en"><img src="{{asset('source/assets/frontend/img/header/1.jpg')}}" alt="language-selector">{{ trans('home.languageen') }}</a></li>
                            
                        </ul>
                        <!-- Dropdown End -->
                    </li>
                    @if(Auth::check() || Session::get('user_id_login'))
                    <li>
                        <a href="#"><i class="far fa-id-card"></i> {{ trans('home.hi') }}, 
                            @if(Session::get('user_name_login'))
                            {{Session::get('user_name_login')}}
                            @else
                            {{Auth::user()->full_name}}
                            @endif
                        </a>
                    </li>
                    <li><a href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ trans('home.logout') }}</a></li>
                    @if(Session::get('user_name_login'))

                    @elseif(Auth::user()->level == 1)
                    <li><a href="{{route('trang-chu-admin')}}">Go Admin</a></li>
                    @endif
                    @else
     <!--                <li><a href="#">My Account<i class="lnr lnr-chevron-down"></i></a>
                        
                        <ul class="ht-dropdown">
                            <li><a href="{{route('dangky')}}"><i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>  {{ trans('home.signup') }}</a></li>
                            <li><a href="{{route('dangnhap')}}"><i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ trans('home.signin') }}</a></li>
                        </ul>
                        
                    </li>  -->
                    @endif
                </ul>
            </div>
            <!-- Header Top End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Top End Here -->
    <!-- Header Middle Start Here -->
    <div class="header-middle ptb-15">
        <div class="container">
            <div class="row align-items-center no-gutters">
                <div class="col-lg-3 col-md-12">
                    <div class="logo mb-all-30">
                        <a href="{{route('trang-chu')}}"><img src="{{asset('source/assets/dest/images/logo-laptop.png')}}" style="width: 214px; height: 162px" alt="logo-image"></a>
                    </div>
                </div>
                <!-- Categorie Search Box Start Here -->
                <div class="col-lg-5 col-md-8 ml-auto mr-auto col-10">
                    <div class="categorie-search-box">
                        <form role="search" method="post" id="searchform" action="{{route('timkiem')}}" onsubmit="return validate()" autocomplete="off">
                            @csrf
                            <input id="key" type="text" name="search" placeholder="{{trans('home.search')}}" >
                            <div id="search_ajax"></div>
                            <button type="submit"><i class="lnr lnr-magnifier"></i></button>
                        </form>
                    </div>
                </div>
                <!-- Categorie Search Box End Here -->
                <!-- Cart Box Start Here -->
                <div class="col-lg-4 col-md-12">
                    <div class="cart-box mt-all-30">
                        <ul class="d-flex justify-content-lg-end justify-content-center align-items-center">
                            <li>
                                <a><i class="lnr lnr-cart"></i>
                                <span class="my-cart">
                                    <span class="total-pro">
                                        @if(Session::has('cart'))
                                            @if(Auth::check())
                                            {{Session('cart')->totalQty}} 
                                            @elseif(Session::get('user_name_login'))
                                            {{Session('cart')->totalQty}} 
                                            @endif
                                            
                                        @else 0
                                        @endif
                                    </span>
                                    <span>{{trans('home.carttt')}}</span></span>
                                </a>
                                @if(Auth::check() && Session::has('cart') )
                                <ul class="ht-dropdown cart-box-width">
                                    <li>
                                        @foreach($product_cart as $poroduct)
                                        <!-- Cart Box Start -->
                                        <div class="single-cart-box">
                                            <div class="cart-img">
                                                <a href="#"><img src="source/image/product/{{$poroduct['item']['image']}}" alt="cart-image"></a>
                                                <span class="pro-quantity">{{$poroduct['qty']}}X</span>
                                            </div>
                                            <div class="cart-content">
                                                <h6><a href="product.html">{{$poroduct['item']->$multisp}} </a></h6>
                                                <span class="cart-price">@if($poroduct['item']['promotion_price']==0){{number_format($poroduct['item']['unit_price'])}} VNĐ @else {{number_format($poroduct['item']['promotion_price'])}} VNĐ @endif</span>
                                            </div>
                                            <a class="del-icone" href="{{route('xoagiohang',$poroduct['item']['id'])}}"><i class="ion-close"></i></a>
                                        </div>
                                        <!-- Cart Box End -->
                                        @endforeach
                                        <!-- Cart Footer Inner Start -->
                                        <div class="cart-footer">
                                            <div class="cart-actions text-center">
                                                <a class="cart-checkout" href="{{route('shoppingcart')}}">{{trans('home.chitiet')}}</a>
                                            </div>
                                        </div>
                                        <!-- Cart Footer Inner End -->
                                    </li>
                                </ul>
                                @elseif(Session::get('user_name_login') && Session::has('cart') )
                                <ul class="ht-dropdown cart-box-width">
                                    <li>
                                        @foreach($product_cart as $poroduct)
                                        <!-- Cart Box Start -->
                                        <div class="single-cart-box">
                                            <div class="cart-img">
                                                <a href="#"><img src="source/image/product/{{$poroduct['item']['image']}}" alt="cart-image"></a>
                                                <span class="pro-quantity">{{$poroduct['qty']}}X</span>
                                            </div>
                                            <div class="cart-content">
                                                <h6><a href="product.html">{{$poroduct['item']->$multisp}} </a></h6>
                                                <span class="cart-price">@if($poroduct['item']['promotion_price']==0){{number_format($poroduct['item']['unit_price'])}} VNĐ @else {{number_format($poroduct['item']['promotion_price'])}} VNĐ @endif</span>
                                            </div>
                                            <a class="del-icone" href="{{route('xoagiohang',$poroduct['item']['id'])}}"><i class="ion-close"></i></a>
                                        </div>
                                        <!-- Cart Box End -->
                                        @endforeach
                                        <!-- Cart Footer Inner Start -->
                                        <div class="cart-footer">
                                            <div class="cart-actions text-center">
                                                <a class="cart-checkout" href="{{route('shoppingcart')}}">{{trans('home.chitiet')}}</a>
                                            </div>
                                        </div>
                                        <!-- Cart Footer Inner End -->
                                    </li>
                                </ul>
                                @endif
                            </li>
                            <li>
                                <a href="#wish_top" id="count_wish">

                                </a>
                            </li>
                            @if(Auth::check() || Session::get('user_name_login'))
                            @else
                            <li><a href="{{route('dangnhap')}}"><i class="lnr lnr-user"></i><span class="my-cart"><span> <strong>{{ trans('home.signin') }}</strong> Or</span><span> {{ trans('home.signup') }}</span></span></a>

                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- Cart Box End Here -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Middle End Here -->
    <!-- Header Bottom Start Here -->
    <div class="header-bottom  header-sticky">
        <div class="container">
            <div class="row align-items-center">
                 <div class="col-xl-3 col-lg-4 col-md-6 vertical-menu d-none d-lg-block">
                    <span class="categorie-title">{{trans('home.brand')}}</span>
                </div>                       
                <div class="col-xl-9 col-lg-8 col-md-12 ">
                    <nav class="d-none d-lg-block">
                        <ul class="header-bottom-list d-flex">
                            @if($url_canonical == route('trang-chu'))
                                <li class="active"><a href="{{route('trang-chu')}}">{{ trans('home.home') }}</a>
                                </li>
                            @else
                                <li><a href="{{route('trang-chu')}}">{{ trans('home.home') }}</a>
                                </li>
                            @endif

                            @if($url_canonical == route('allproduct'))
                            <li class="active"><a href="{{route('allproduct')}}">{{ trans('home.producttt') }}<i class="fa fa-angle-down"></i></a>
                                <!-- Home Version Dropdown Start -->
                                <ul class="ht-dropdown dropdown-style-two">
                                    @foreach($loai_sanpham as $lsp)
                                    <li>
                                        <a href="{{route('loaisanpham', $lsp->id)}}">{{$lsp->name_type}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                <!-- Home Version Dropdown End -->
                            </li>
                            @else
                            <li><a href="{{route('allproduct')}}">{{ trans('home.producttt') }}<i class="fa fa-angle-down"></i></a>
                                <!-- Home Version Dropdown Start -->
                                <ul class="ht-dropdown dropdown-style-two">
                                    @foreach($loai_sanpham as $lsp)
                                    <li><a href="{{route('loaisanpham', $lsp->id)}}">{{$lsp->name_type}}</a></li>
                                    @endforeach
                                </ul>
                                <!-- Home Version Dropdown End -->
                            </li>
                            @endif

   
                            @if($url_canonical == route('gioithieu'))
                                <li class="active"><a href="{{route('gioithieu')}}">{{ trans('home.about') }}</a></li>
                            @else
                                <li><a href="{{route('gioithieu')}}">{{ trans('home.about') }}</a></li>
                            @endif
                            @if($url_canonical == route('lienhe'))
                                <li class="active"><a href="{{route('lienhe')}}">{{ trans('home.contact') }}</a></li>
                            @else
                                <li><a href="{{route('lienhe')}}">{{ trans('home.contact') }}</a></li>
                            @endif
                        </ul>
                    </nav>
                    <div class="mobile-menu d-block d-lg-none">
                        <nav>
                            <ul>
                                <li><a href="{{route('trang-chu')}}">home</a>
                                </li>
                                <li><a>{{ trans('home.producttt') }}</a>
                                    <!-- Mobile Menu Dropdown Start -->
                                    <ul>
                                        @foreach($loai_sanpham as $lsp)
                                        <li><a href="{{route('loaisanpham', $lsp->id)}}">{{$lsp->name_type}}</a></li>
                                        @endforeach
                                    </ul>

                                    <!-- Mobile Menu Dropdown End -->
                                </li>


                                <li><a href="{{route('gioithieu')}}">{{ trans('home.about') }}</a></li>
                                <li><a href="{{route('lienhe')}}">{{ trans('home.contact') }}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Bottom End Here -->
    <!-- Mobile Vertical Menu Start Here -->
    <div class="container d-block d-lg-none">
        <div class="vertical-menu mt-30">
            <span class="categorie-title mobile-categorei-menu">{{trans('home.brand')}}</span>
            <nav>  
                <div id="cate-mobile-toggle" class="category-menu sidebar-menu sidbar-style mobile-categorei-menu-list menu-hidden ">
                    <ul>
                        @foreach($loai_sanpham as $sl)
                        <li class="has-sub"><a href="{{route('loaisanpham',$sl->id)}}">Laptop {{$sl->name_type}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- category-menu-end -->
            </nav>
        </div>
    </div>
    <!-- Mobile Vertical Menu Start End -->
</header>
<!-- Main Header Area End Here -->