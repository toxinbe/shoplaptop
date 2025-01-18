<!doctype html>
<html class="no-js" lang="vi">

<head>
    <title>{{ trans('home.home') }} || ShopPv</title>
    @include('FrontEnd.Style.Link')
</head>

<body>
    <!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

    <!-- Main Wrapper Start Here -->
    <div class="wrapper">
        <!-- Banner Popup Start -->
        @include('FrontEnd.Header')
        <!-- Main Header Area End Here -->
        <!-- Categorie Menu & Slider Area Start Here -->
        <div class="main-page-banner pb-50 off-white-bg">
            <div class="container">
                <div class="row">
                    <!-- Vertical Menu Start Here -->
                    @include('FrontEnd.Menu')
                    <!-- Vertical Menu End Here -->
                    <!-- Slider Area Start Here -->
                    @include('FrontEnd.Slider')
                    <!-- Slider Area End Here -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Categorie Menu & Slider Area End Here -->
        <!-- Brand Banner Area Start Here -->
        <div class="image-banner pb-50 off-white-bg">
            <div class="container">
                <div class="col-img">
                    <a href="#"><img src="{{asset('source/assets/frontend/img/banner/h1-banner.jpg')}}" alt="image banner"></a>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Brand Banner Area End Here -->
        <!-- Hot Deal Products Start Here -->
        <div class="hot-deal-products off-white-bg pb-90 pb-sm-50">
            <div class="container">
               <!-- Product Title Start -->
               <div class="post-title pb-30">
                   <h2>{{ trans('home.hotdeals') }}</h2>
               </div>
               <!-- Product Title End -->
                <!-- Hot Deal Product Activation Start -->
                <div class="hot-deal-active owl-carousel">
                    <!-- Single Product Start -->
                    @foreach($sanpham_khuyenmai as $product_km)

                    <div class="single-product">
                        <a href="{{route('sosanh')}}" id="pagesosanh{{$product_km->id}}" style="visibility: hidden;"></a>
                        <input type="hidden" id="wishList_product_name{{$product_km->id}}" value="{{$product_km->$multisp}}" >
                        <input type="hidden" id="wishList_price{{$product_km->id}}" value="@if($product_km->promotion_price == 0)
                        {{number_format($product_km->unit_price,0,',','.')}} VNĐ
                        @else
                        {{number_format($product_km->promotion_price,0,',','.')}} VNĐ
                        @endif" >
                        
                        <input type="hidden" id="instock{{$product_km->id}}" value="
                         @if($product_km->product_quantity>0)
                         {{ trans('home.INSTOCK') }}
                         @else
                         {{ trans('home.OUTSTOCK') }}
                         @endif
                         ">
                         <input type="hidden" id="mota{{$product_km->id}}" value="{!! $product_km->$multi_description !!}">

                        <!-- Product Image Start -->
                        <div class="pro-img">
                            <a id="wishList_producturl{{$product_km->id}}" href="{{ route( 'chitietsanpham',['id'=> $product_km->id, 'product_slug'=>$product_km->product_slug]) }}">
                                <img id="wishList_image{{$product_km->id}}" class="primary-img" src="source/image/product/{{$product_km->image}}" alt="single-product" height="226px" width="226px">
                                <img class="secondary-img" src="source/image/product/{{$product_km->image}}" alt="single-product" height="226px" width="226px">
                            </a>
                            
                            <div class="countdown" data-countdown="{{ $product_km->date_sale}} {{ $product_km->hours_sale}}"></div>
                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$product_km->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                            <div class="pro-info">
                                <h4><a href="{{ route( 'chitietsanpham',['id'=> $product_km->id, 'product_slug'=>$product_km->product_slug]) }}">{{$product_km->$multisp}}</a></h4>
                                <p><span class="price">{{number_format($product_km->promotion_price,0,',','.')}} VNĐ</span><del class="prev-price">{{number_format($product_km->unit_price,0,',','.')}} VNĐ</del></p>
                                <div class="label-product l_sale">{{number_format(100-($product_km->promotion_price/$product_km->unit_price)*100)}}<span class="symbol-percent">%</span></div>
                            </div>
                            <div class="pro-actions">
                                <div class="actions-primary">
                                     @if($product_km->product_quantity>0)
                                    <!-- <a id="addcart{{$product_km->id}}" 
                                    @if(Auth::check()) href="{{route('themgiohang',$product_km->id)}}" 
                                    @else href="{{route('dangnhap')}}" 
                                    @endif title="{{ trans('home.addcart') }}"> + {{ trans('home.addcart') }}</a> -->
                                    <a id="addcart{{$product_km->id}}" 
                                        <?php 
                                        if(Auth::check() || Session::get('user_name_login')){
                                            $addnewcart = route('themgiohang',$product_km->id);
                                        }else{
                                            $addnewcart = route('dangnhap');
                                        }


                                         ?>
                                    href="{{$addnewcart }}" 
                                    title="{{ trans('home.addcart') }}"> + {{ trans('home.addcart') }}</a>

                                    @else
                                    <a id="addcart{{$product_km->id}}" class="disabled-link"> + {{ trans('home.addcart') }}</a>
                                    @endif
                                </div>
                                <div class="actions-secondary">
                                    <a style="cursor: pointer;" id="{{$product_km->id}}" onclick="add_Compare(this.id)" title="{{ trans('home.addcompare') }}"><i class="lnr lnr-sync"></i> <span>{{ trans('home.addcompare') }}</span></a>
                                    <a style="cursor: pointer;" id="{{$product_km->id}}" onclick="add_wishList(this.id)" title="{{ trans('home.addwishlist') }}"><i class="lnr lnr-heart"></i> <span>{{ trans('home.addwishlist') }}</span></a>
                                </div>




                            </div>
                        </div>
                        <!-- Product Content End -->
                    </div>
                    @endforeach
                    <!-- Single Product End -->
                </div>
                <!-- Hot Deal Product Active End -->

            </div>
            <!-- Container End -->
        </div>
        <!-- Hot Deal Products End Here -->
        <!-- Hot Deal Products End Here -->
    


        <!-- Big Banner Start Here -->
        <div class="big-banner mt-100 pb-85 mt-sm-60 pb-sm-45">
            <div class="container banner-2">
                <div class="banner-box">
                    <div class="col-img" style="width: 224px; height: 174.44px">
                        <a href="#"><img width="224px" height="174.44px" src="{{asset('source/assets/frontend/img/banner/9.jpg')}}" alt="banner 3"></a>
                    </div>
                    <div class="col-img" style="width: 224px; height: 174.44px">
                        <a href="#"><img width="224px" height="174.44px" src="{{asset('source/assets/frontend/img/banner/8.jpg')}}" alt="banner 3"></a>
                    </div>
                </div>
                <div class="banner-box">
                    <div class="col-img" style="width: 224px; height: 359.79px">
                        <a href="#"><img width="224px" height="359.79px" src="{{asset('source/assets/frontend/img/banner/10.jpg')}}" alt="banner 3"></a>
                    </div>
                </div>
                <div class="banner-box">
                    <div class="col-img" style="width: 224px; height: 174.44px">
                        <a href="#"><img width="224px" height="174.44px" src="{{asset('source/assets/frontend/img/banner/12.jpg')}}" alt="banner 3"></a>
                    </div>
                    <div class="col-img" style="width: 224px; height: 174.44px">
                        <a href="#"><img width="224px" height="174.44px" src="{{asset('source/assets/frontend/img/banner/7.jpg')}}" alt="banner 3"></a>
                    </div>
                </div>
                <div class="banner-box">
                    <div class="col-img" style="width: 224px; height: 359.79px">
                        <a href="#"><img width="224px" height="359.79px" src="{{asset('source/assets/frontend/img/banner/11.jpg')}}" alt="banner 3"></a>
                    </div>
                </div>
                <div class="banner-box">
                    <div class="col-img" style="width: 224px; height: 174.44px">
                        <a href="#"><img width="224px" height="174.44px" src="{{asset('source/assets/frontend/img/banner/13.jpg')}}" alt="banner 3"></a>
                    </div>
                    <div class="col-img" style="width: 224px; height: 174.44px">
                        <a href="#"><img width="224px" height="174.44px" src="{{asset('source/assets/frontend/img/banner/14.jpg')}}" alt="banner 3"></a>
                    </div>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Big Banner End Here -->
        <!-- Arrivals Products Area Start Here -->
        <div class="arrivals-product pb-85 pb-sm-45">
            <div class="container">
                <div class="main-product-tab-area">
                    <div class="tab-menu mb-25">
                        <div class="section-ttitle">
                            <h2>{{ trans('home.newproduct') }}</h2>
                       </div>
                        <!-- Nav tabs -->
                        <ul class="nav tabs-area" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#laptop">{{trans('home.new')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#topLaptop-1">{{trans('home.top')}}</a>
                            </li>
                        </ul>                       

                    </div> 

                    <!-- Tab Contetn Start -->
                    <div class="tab-content">
                        
                        <div id="laptop" class="tab-pane fade show active">
                            <!-- Arrivals Product Activation Start Here -->
                            <div class="electronics-pro-active owl-carousel">
                                @foreach($new_product as $new)
                                <!-- Double Product Start -->
                                <div class="double-product">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <a href="{{route('sosanh')}}" id="pagesosanh{{$new->id}}" style="visibility: hidden;"></a>
                                        <input type="hidden" id="wishList_product_name{{$new->id}}" value="{{$new->$multisp}}" >
                                        <input type="hidden" id="wishList_price{{$new->id}}" value="@if($new->promotion_price == 0)
                                        {{number_format($new->unit_price,0,',','.')}} VNĐ
                                        @else
                                        {{number_format($new->promotion_price,0,',','.')}} VNĐ
                                        @endif" >

                                       <input type="hidden" id="instock{{$new->id}}" value="
                                         @if($new->product_quantity>0)
                                         {{ trans('home.INSTOCK') }}
                                         @else
                                         {{ trans('home.OUTSTOCK') }}
                                         @endif
                                         ">
                                        <input type="hidden" id="mota{{$new->id}}" value="{!! $new->$multi_description !!}">


                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a id="wishList_producturl{{$new->id}}" href="{{ route( 'chitietsanpham',['id'=> $new->id, 'product_slug'=>$new->product_slug]) }}">
                                                <img id="wishList_image{{$new->id}}" class="primary-img" src="source/image/product/{{$new->image}}" alt="single-product" height="276.45px">
                                                <img class="secondary-img" src="source/image/product/{{$new->image}}" alt="single-product" height="276.45px">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$new->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="{{ route( 'chitietsanpham',['id'=> $new->id, 'product_slug'=>$new->product_slug]) }}">{{$new->$multisp}}</a></h4>
                                                <p>
                                                    @if($new->promotion_price == 0)
                                                    <span class="price">{{number_format($new->unit_price,0,',','.')}} VNĐ</span>
                                                    @else
                                                    <span class="price">{{number_format($new->promotion_price,0,',','.')}} VNĐ</span>
                                                    <del class="prev-price">{{number_format($new->unit_price,0,',','.')}} VNĐ</del>
                                                    @endif
                                                </p>
                                                @if($new->promotion_price != 0)
                                                <div class="label-product l_sale">{{number_format(100-($new->promotion_price/$new->unit_price)*100)}}<span class="symbol-percent">%</span></div>
                                                @endif
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    @if($new->product_quantity>0)
                                                    <a id="addcart{{$new->id}}" 
                                                        <?php 
                                                            if(Auth::check() || Session::get('user_name_login')){
                                                                $addnewcart = route('themgiohang',$new->id);
                                                            }else{
                                                                $addnewcart = route('dangnhap');
                                                            }
                                                         ?>
                         
                                                        href="{{$addnewcart}}" 
                                                        
                                                        title="{{ trans('home.addcart') }}"> + {{ trans('home.addcart') }}</a>
                                                    @else
                                                    <a id="addcart{{$new->id}}" class="disabled-link"> + {{ trans('home.addcart') }}</a>
                                                    @endif
                                                </div>
                                                <div class="actions-secondary">
                                                    <a style="cursor: pointer;" id="{{$new->id}}" onclick="add_Compare(this.id)" title="{{ trans('home.addcompare') }}"><i class="lnr lnr-sync"></i> <span>{{ trans('home.addcompare') }}</span></a>
                                                    <a style="cursor: pointer;" id="{{$new->id}}" onclick="add_wishList(this.id)" title="{{ trans('home.addwishlist') }}"><i class="lnr lnr-heart"></i> <span>{{ trans('home.addwishlist') }}</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                        @if($new->promotion_price != 0)
                                        <span class="sticker-new">{{ trans('home.sale') }}</span>
                                        @endif
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                @endforeach
                                <!-- Double Product End -->
                            </div>
                            <!-- Arrivals Product Activation End Here -->
                        </div>
                        <!-- #newLaptop End Here -->
                        <!-- #topLaptop-1 Start Here -->
                        <div id="topLaptop-1" class="tab-pane fade">
                            <!-- Arrivals Product Activation Start Here -->
                            <div class="electronics-pro-active owl-carousel">
                                @foreach($top_product as $top)
                                <!-- Double Product Start -->
                                <div class="double-product">
                                    <a href="{{route('sosanh')}}" id="pagesosanh{{$top->id}}" style="visibility: hidden;"></a>
                                    <input type="hidden" id="wishList_product_name{{$top->id}}" value="{{$top->$multisp}}" >
                                    <input type="hidden" id="wishList_price{{$top->id}}" value="@if($top->promotion_price == 0)
                                    {{number_format($top->unit_price,0,',','.')}} VNĐ
                                    @else
                                    {{number_format($top->promotion_price,0,',','.')}} VNĐ
                                    @endif" >
                                   <input type="hidden" id="instock{{$top->id}}" value="
                                         @if($top->product_quantity>0)
                                         {{ trans('home.INSTOCK') }}
                                         @else
                                         {{ trans('home.OUTSTOCK') }}
                                         @endif
                                         ">
                                    <input type="hidden" id="mota{{$top->id}}" value="{!! $top->$multi_description !!}">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a id="wishList_producturl{{$top->id}}" href="{{ route( 'chitietsanpham',['id'=> $top->id, 'product_slug'=>$top->product_slug]) }}">
                                                <img id="wishList_image{{$top->id}}" class="primary-img" src="source/image/product/{{$top->image}}" alt="single-product" height="276.45px">
                                                <img class="secondary-img" src="source/image/product/{{$top->image}}" alt="single-product" height="276.45px">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$top->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="{{ route( 'chitietsanpham',['id'=> $top->id, 'product_slug'=>$top->product_slug]) }}">{{$top->$multisp}}</a></h4>
                                                <p>
                                                    @if($top->promotion_price == 0)
                                                    <span class="price">{{number_format($top->unit_price,0,',','.')}} VNĐ</span>
                                                    @else
                                                    <span class="price">{{number_format($top->promotion_price,0,',','.')}} VNĐ</span>
                                                    <del class="prev-price">{{number_format($top->unit_price,0,',','.')}} VNĐ</del>
                                                    @endif
                                                </p>
                                                @if($top->promotion_price != 0)
                                                <div class="label-product l_sale">{{number_format(100-($top->promotion_price/$top->unit_price)*100)}}<span class="symbol-percent"></span>%</div>
                                                @endif
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    @if($top->product_quantity>0)
                                                    <a id="addcart{{$top->id}}" 
                                                        <?php 
                                                            if(Auth::check() || Session::get('user_name_login')){
                                                                $addnewcart = route('themgiohang',$top->id);
                                                            }else{
                                                                $addnewcart = route('dangnhap');
                                                            }
                                                        ?>
                                                         href="{{$addnewcart}}"
                                                         title="{{ trans('home.addcart') }}"> + {{ trans('home.addcart') }}</a>
                                                    @else
                                                    <a id="addcart{{$top->id}}" class="disabled-link"> + {{ trans('home.addcart') }}</a>
                                                    @endif
                                                </div>
                                                <div class="actions-secondary">
                                                    <a style="cursor: pointer;" id="{{$top->id}}" onclick="add_Compare(this.id)" title="{{ trans('home.addcompare') }}"><i class="lnr lnr-sync"></i> <span>{{ trans('home.addcompare') }}</span></a>
                                                    <a style="cursor: pointer;" id="{{$top->id}}" onclick="add_wishList(this.id)" title="Wish List"><i class="lnr lnr-heart"></i> <span>{{ trans('home.addwishlist') }}</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                        @if($top->promotion_price != 0)
                                        <span class="sticker-new">{{ trans('home.sale') }}</span>
                                        @endif
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                @endforeach
                                <!-- Double Product End -->
                            </div>
                            <!-- Arrivals Product Activation End Here -->
                        </div>
                    </div>
                    <!-- Tab Content End -->
                </div>
                <!-- main-product-tab-area-->
            </div>
            <!-- Container End -->
        </div>
        <!-- Arrivals Products Area End Here -->
        <!-- Arrivals Products Area Start Here -->
        <div class="second-arrivals-product pb-45 pb-sm-5">
            <div class="container">
                <div class="main-product-tab-area">
                    <div class="tab-menu mb-25">
                        <div class="section-ttitle">
                            <h2>{{ trans('home.topproduct') }}</h2>
                       </div>
                        <!-- Nav tabs -->
                        <ul class="nav tabs-area" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#topLaptop">{{trans('home.top')}} </a>
                            </li>
                        </ul>                       

                    </div> 

                    <!-- Tab Contetn Start -->
                    <div class="tab-content">
                        <div id="topLaptop" class="tab-pane fade show active">
                            <!-- Arrivals Product Activation Start Here -->
                            <div class="best-seller-pro-active owl-carousel">
                                <!-- Single Product Start -->
                                @foreach($top_product as $top_pr)
                                <div class="single-product">
                                    <a href="{{route('sosanh')}}" id="pagesosanh{{$top_pr->id}}" style="visibility: hidden;"></a>
                                    <input type="hidden" id="wishList_product_name{{$top_pr->id}}" value="{{$top_pr->$multisp}}" >
                                    <input type="hidden" id="wishList_price{{$top_pr->id}}" value="@if($top_pr->promotion_price == 0)
                                    {{number_format($top_pr->unit_price,0,',','.')}} VNĐ
                                    @else
                                    {{number_format($top_pr->promotion_price,0,',','.')}} VNĐ
                                    @endif" >
                                   <input type="hidden" id="instock{{$top_pr->id}}" value="
                                         @if($top_pr->product_quantity>0)
                                         {{ trans('home.INSTOCK') }}
                                         @else
                                         {{ trans('home.OUTSTOCK') }}
                                         @endif
                                         ">
                                    <input type="hidden" id="mota{{$top_pr->id}}" value="{!! $top_pr->$multi_description !!}">
                                    <!-- Product Image Start -->
                                    <div class="pro-img">
                                        <a id="wishList_producturl{{$top_pr->id}}" href="{{ route( 'chitietsanpham',['id'=> $top_pr->id, 'product_slug'=>$top_pr->product_slug]) }}">
                                            <img id="wishList_image{{$top_pr->id}}" class="primary-img" src="source/image/product/{{$top_pr->image}}" alt="single-product" height="154.8px">
                                            <img class="secondary-img" src="source/image/product/{{$top_pr->image}}" alt="single-product" height="154.8px">
                                        </a>
                                        <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$top_pr->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                    </div>
                                    <!-- Product Image End -->
                                    <!-- Product Content Start -->
                                    <div class="pro-content">
                                        <div class="pro-info">
                                            <h4><a href="{{ route( 'chitietsanpham',['id'=> $top_pr->id, 'product_slug'=>$top_pr->product_slug]) }}">{{$top_pr->$multisp}}</a></h4>
                                            <p>
                                                @if($top_pr->promotion_price == 0)
                                                <span class="price">{{number_format($top_pr->unit_price,0,',','.')}} VNĐ</span>
                                                @else
                                                <span class="price">{{number_format($top_pr->promotion_price,0,',','.')}} VNĐ</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="pro-actions">
                                            <div class="actions-primary">
                                                @if($top_pr->product_quantity>0)
                                                <a id="addcart{{$top_pr->id}}" 
                                                    <?php 
                                                        if(Auth::check() || Session::get('user_name_login')){
                                                            $addnewcart = route('themgiohang',$top_pr->id);
                                                        }else{
                                                            $addnewcart = route('dangnhap');
                                                        }
                                                    ?>
                                                    href="{{$addnewcart}}" 
                                                   
                                                    title="{{ trans('home.addcart') }}"> + {{ trans('home.addcart') }}</a>
                                                @else
                                                <a id="addcart{{$top_pr->id}}" class="disabled-link"> + {{ trans('home.addcart') }}</a>
                                                @endif
                                            </div>
                                            <div class="actions-secondary">
                                                <a style="cursor: pointer;" id="{{$top_pr->id}}" onclick="add_Compare(this.id)" title="{{ trans('home.addcompare') }}"><i class="lnr lnr-sync"></i> <span>{{ trans('home.addcompare') }}</span></a>
                                                <a style="cursor: pointer;" id="{{$top_pr->id}}" onclick="add_wishList(this.id)" title="{{ trans('home.addwishlist') }}"><i class="lnr lnr-heart"></i> <span>{{ trans('home.addwishlist') }}</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product Content End -->
                                </div>
                                @endforeach
                                <!-- Single Product End -->
                            </div>
                            <!-- Arrivals Product Activation End Here -->
                        </div>
                        <!-- #electronics End Here -->
                    </div>
                    <!-- Tab Content End -->
                </div>
                <!-- main-product-tab-area-->
            </div>
            <!-- Container End -->
        </div>
        <!-- Arrivals Products Area End Here -->
        <!-- Like Products Area Start Here -->
        <style type="text/css">
            #scrolllike {
                margin-left: 15%; 
                height: 330px; 
                overflow: scroll;
            }
            #scrolllike::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                background-color: #F5F5F5;
            }

            #scrolllike::-webkit-scrollbar {
                width: 6px;
                height: 0px;
                background-color: #F5F5F5;
            }

            #scrolllike::-webkit-scrollbar-thumb {
                background-color: #E62E04;
            }
        </style>
        <div id="maylike">
            
        </div>
        <!-- Lile Products Area End Here -->
        <!-- Brand Banner Area Start Here -->
        <div class="main-brand-banner pt-95 pb-100 pt-sm-55 pb-sm-60">
            <div class="container">
                <div class="section-ttitle mb-20">
                    <h2>{{ trans('home.goodbrand') }}</h2>
               </div>
                <div class="row no-gutters">
                    <div class="col-lg-3">
                        <div class="col-img" style="width: 292.5px; height: 326.74px">
                            <img width="292.5px" height="326.74px" src="{{asset('source/assets/frontend/img/banner/banner003.jpg')}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Brand Banner Start -->
                        <div class="brand-banner owl-carousel">
                            <div class="single-brand">
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" class="img" src="{{asset('source/assets/frontend/img/brand/4.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" class="img" src="{{asset('source/assets/frontend/img/brand/6.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" class="img" src="{{asset('source/assets/frontend/img/brand/2.jpg')}}" alt="brand-image"></a>
                            </div>
                            <div class="single-brand">
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" class="img" src="{{asset('source/assets/frontend/img/brand/5.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/2.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/5.jpg')}}" alt="brand-image"></a>
                            </div>
                            <div class="single-brand">
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/1.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/5.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/3.jpg')}}" alt="brand-image"></a>

                            </div>
                            <div class="single-brand">
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/5.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/3.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/4.jpg')}}" alt="brand-image"></a>
                            </div>
                            <div class="single-brand">
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/3.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/2.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/5.jpg')}}" alt="brand-image"></a>
                            </div>
                            <div class="single-brand">
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/2.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/3.jpg')}}" alt="brand-image"></a>
                                <a style="width: 194.33px; height: 108.33px" href="#"><img width="173.33px" height="82.53px" src="{{asset('source/assets/frontend/img/brand/4.jpg')}}" alt="brand-image"></a>
                            </div>
                        </div>
                        <!-- Brand Banner End -->                        

                    </div>
                    <div class="col-lg-3">
                        <div class="col-img" style="width: 292.5px; height: 326.74px">
                            <img width="292.5px" height="326.74px" src="{{asset('source/assets/frontend/img/banner/banner005.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Brand Banner Area End Here -->
        <div class="big-banner pb-100 pb-sm-60">
            <div class="container big-banner-box">
                <div class="col-img" style="width: 580px; height: 189px">
                    <a href="#">
                    <img width="580px" height="189px" src="{{asset('source/assets/frontend/img/banner/banner-n05.jpg')}}" alt="">
                    </a>
                </div>
                <div class="col-img" style="width: 580px; height: 189px">
                    <a href="#">
                    <img src="{{asset('source/assets/frontend/img/banner/h1-banner3.jpg')}}" alt="">
                    </a>
                </div>
            </div>
            <!-- Container End -->
        </div>
        @include('FrontEnd.Footer')
    </div>
    <!-- Main Wrapper End Here -->

    @include('FrontEnd.Style.Script')

</body>

</html>