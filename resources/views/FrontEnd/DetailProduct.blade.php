@extends('Layout')
@section('title')    
    {{ trans('home.producttt') }}
@endsection
@section('content-layout')

<meta property="og:image" content="{{$image_og}}" />

<meta name="description" content="{!! $meta_desc !!}">
<meta name="title" content="{{$sanpham->$multisp}}" />
<meta property="og:title" content="{{$sanpham->$multisp}}" />

<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">{{ trans('home.home') }}</a></li>
                <li><a href="san-pham">{{ trans('home.producttt') }}</a></li>
                <li class="active"><a href="{{$url_canonical}}">{{$sanpham->$multisp}}</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Product Thumbnail Start -->
<div class="main-product-thumbnail ptb-100 ptb-sm-60">
    <div class="container">
        <div class="thumb-bg">
            <div class="row">
                <a href="{{route('sosanh')}}" id="pagesosanh{{$sanpham->id}}" style="visibility: hidden;"></a>
                <input type="hidden" id="wishList_product_name{{$sanpham->id}}" value="{{$sanpham->$multisp}}" >
                <input type="hidden" id="wishList_price{{$sanpham->id}}" value="@if($sanpham->promotion_price == 0)
                {{number_format($sanpham->unit_price,0,',','.')}} VNĐ
                @else
                {{number_format($sanpham->promotion_price,0,',','.')}} VNĐ
                @endif" >
                
                <input type="hidden" id="instock{{$sanpham->id}}" value="
                 @if($sanpham->product_quantity>0)
                 {{ trans('home.INSTOCK') }}
                 @else
                 {{ trans('home.OUTSTOCK') }}
                 @endif
                 ">
                 <input type="hidden" id="mota{{$sanpham->id}}" value="{!! $sanpham->$multi_description !!}">

                <!-- Main Thumbnail Image Start -->
                <div class="col-lg-5 mb-all-40">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content">
                        <div id="thumb1" class="tab-pane fade show active">
                            <a id="wishList_producturl{{$sanpham->id}}" data-fancybox="images" href="source/image/product/{{$sanpham->image}}"><img  id="wishList_image{{$sanpham->id}}" src="source/image/product/{{$sanpham->image}}" alt="product-view" height="452.5px" width="452.5px"></a>
                        </div>
                    </div>
                    <!-- Thumbnail Large Image End -->
                    <!-- Thumbnail Image End -->
                    <div class="product-thumbnail mt-15">
                        <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                            <a class="active" data-toggle="tab" href="#thumb1"><img src="source/image/product/{{$sanpham->image}}" alt="product-thumbnail" height="138.83px" width="138.82px"></a>
                        </div>
                    </div>
                    <!-- Thumbnail image end -->
                </div>
                <!-- Main Thumbnail Image End -->
                <!-- Thumbnail Description Start -->
                <div class="col-lg-7">
                    <div class="thubnail-desc fix">
                        <h3 class="product-header">{{$sanpham->$multisp}}</h3>
                        <div class="rating-summary fix mtb-10">
                            @foreach($sanpham_id as $key => $value)
                            <div class="rating">
                            @for($count=1; $count<=5; $count++)
                                @php
                                    if($count<=$rating){
                                        $styte_star = 'fa-star';
                                        $color = 'color:#F39C11;';
                                    }
                                    else {
                                        $styte_star = 'fa-star-o';
                                        $color = 'color:#F39C11;';
                                    }
                                
                                @endphp
                                <!-- Single Review List Start -->
                                <i 
                                    title="star_rating" 
                                    class="fa {{$styte_star}} rating"
                                    style="cursor:pointer; {{$color}}  font-size:14px; ">
                                </i>
                                <!-- Single Review List End -->
                            @endfor
                            </ul>
                            @endforeach
                            <div class="rating-feedback" role="tablist">
                                <a  href="{{$url_canonical}}/#dtail">(<span class="fb-comments-count" data-href="{{$url_canonical}}"></span> {{ trans('home.commenttrans') }})</a>
                                <a  href="{{$url_canonical}}/#dtail">{{ trans('home.add') }} {{ trans('home.commenttrans') }}</a>
                            </div>
                        </div>
                        <div class="pro-price mtb-30">
                            <p class="d-flex align-items-center">
                            	
                            	@if($sanpham->promotion_price == 0)
                            	<span class="price">{{number_format($sanpham->unit_price,0,',','.')}} VNĐ</span>
                            	@else
                            	<span class="prev-price">{{number_format($sanpham->unit_price,0,',','.')}} VNĐ</span>
                            	<span class="price">{{number_format($sanpham->promotion_price,0,',','.')}} VNĐ</span><span class="saving-price">save {{number_format(100-($sanpham->promotion_price/$sanpham->unit_price)*100)}} %</span>
                            	@endif
                            </p>
                        </div>
   <!--                      <div class="color clearfix mb-20">
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
                        <div class="box-quantity d-flex hot-product2">
                            <div class="pro-actions">
                                <div class="actions-primary">
                                	@if($sanpham->product_quantity>0)
                                    <a id="addcart{{$sanpham->id}}" 
                                        <?php 
                                            if(Auth::check() || Session::get('user_name_login')){
                                                $addnewcart = route('themgiohang',$sanpham->id);
                                            }else{
                                                $addnewcart = route('dangnhap');
                                            }
                                        ?> 
                                        href="{{$addnewcart}}" 
                                        title="" data-original-title="{{ trans('home.addcart') }}"> + {{ trans('home.addcart') }}</a>
                                	@else
                                    <a id="addcart{{$sanpham->id}}" class="disabled-link"> + {{ trans('home.addcart') }}</a>
	                            	@endif
                                </div>
                                <div class="actions-secondary">
                                    <a style="cursor: pointer;" id="{{$sanpham->id}}" onclick="add_Compare(this.id)" title="{{ trans('home.addcompare') }}"><i class="lnr lnr-sync"></i> <span>{{ trans('home.addcompare') }}</span></a>
                                    <a href="wishlist.html" title="" data-original-title="{{ trans('home.addwishlist') }}"><i class="lnr lnr-heart"></i> <span>{{ trans('home.addwishlist') }}</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="pro-ref mt-20">
                            <p>
                            	@if($sanpham->product_quantity>0)
                            	<span class="in-stock"><i class="ion-checkmark-round"></i> {{ trans('home.INSTOCK') }}</span>
                            	@else
                            	<span class="out-stock"><i class="ion-close"></i> {{ trans('home.OUTSTOCK') }}</span>
                            	@endif
                            </p>
                        </div>
                        <div class="socila-sharing mt-25">
                            <ul class="d-flex">
                                <li>Share</li>
                                <li><a class="share" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse"><i class="fa fa-facebook " aria-hidden="true"></i></a></li>
                                <li><a class="share" href="http://twitter.com/share?url={{$url_canonical}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a class="share" href="https://plus.google.com/share?url={{$url_canonical}}"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
                                <li><a class="share" href="http://pinterest.com/pin/create/button/?url={{$url_canonical}}&description={{$sanpham->$multi_description}}&media={{$image_og}}"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Thumbnail Description End -->
            </div>
            <!-- Row End -->
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Product Thumbnail End -->
<!-- Product Thumbnail Description Start -->
<div class="thumnail-desc pb-100 pb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="main-thumb-desc nav tabs-area" role="tablist">
                    <li><a class="active" data-toggle="tab" href="#dtail">{{ trans('home.deption') }}</a></li>
                    <li>
                        <a data-toggle="tab" href="#review">
                            {{ trans('home.commenttrans') }} (<span class="fb-comments-count" data-href="{{$url_canonical}}">0</span>)
                        </a>
                    </li>
                </ul>

                <!-- Product Thumbnail Tab Content Start -->
                <div class="tab-content thumb-content border-default">
                    <div id="dtail" class="tab-pane fade show active">
                        <p>{!! $sanpham->$multi_description !!}</p>
                    </div>
                    <div id="review" class="tab-pane fade">
                        <!-- Reviews Start -->

                        <!-- Reviews End -->
                        <!-- Reviews Start -->
                        <div class="review border-default universal-padding mt-30">
                            <!-- <h2 class="review-title mb-30">You're reviewing: <br><span>Faded Short Sleeves T-shirt</span></h2> -->
                            <form>
                                 @csrf
                                <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$sanpham->id}}">
                                 <div id="comment_show"></div>
                            
                            </form>
                            <p class="review-mini-title"><b>{{ trans('home.reviewtrans') }}</b></p>
                            @foreach($sanpham_id as $key => $value)
                            <ul class="review-list">
                            @for($count=1; $count<=5; $count++)
                                @php
                                    if($count<=$rating){
                                        $styte_star = 'fa-star';
                                        $color = 'color:#F39C11;';
                                    }
                                    else {
                                        $styte_star = 'fa-star-o';
                                        $color = 'color:#F39C11;';
                                    }
                                
                                @endphp
                                <!-- Single Review List Start -->
                                <li 
                                    title="star_rating" 
                                    id="{{$value->id}}-{{$count}}" 
                                    data-index="{{$count}}"  
                                    data-product_id="{{$value->id}}" 
                                    data-rating="{{$rating}}" 
                                    class="fa {{$styte_star}} rating"
                                    style="cursor:pointer; {{$color}}  font-size:30px; ">
                                </li>
                                <!-- Single Review List End -->
                            @endfor
                            </ul>
                            @endforeach
                            <!-- Reviews Field Start -->
                            <div class="riview-field mt-40">
                                <form autocomplete="off" action="#">
                                	<div class="fb-comments" data-href="{{$url_canonical}}" data-width="750" data-numposts="10" data-lazy="false"></div>
                                </form>

                            </div>
                            <!-- Reviews Field Start -->
                        </div>
                        <!-- Reviews End -->
                    </div>
                </div>
                <!-- Product Thumbnail Tab Content End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>

<!-- Product Thumbnail Description End -->
<!-- Realted Products Start Here -->
<div class="hot-deal-products off-white-bg pt-100 pb-90 pt-sm-60 pb-sm-50">
    <div class="container">
       <!-- Product Title Start -->
       <div class="post-title pb-30">
           <h2>{{ trans('home.otherproduct') }}</h2>
       </div>
       <!-- Product Title End -->
        <!-- Hot Deal Product Activation Start -->
        <div class="hot-deal-active owl-carousel">
            <!-- Single Product Start -->
            @foreach($tuongtu as $sptt)
            <div class="single-product">
                <a href="{{route('sosanh')}}" id="pagesosanh{{$sptt->id}}" style="visibility: hidden;"></a>
                <input type="hidden" id="wishList_product_name{{$sptt->id}}" value="{{$sptt->$multisp}}" >
                <input type="hidden" id="wishList_price{{$sptt->id}}" value="@if($sptt->promotion_price == 0)
                {{number_format($sptt->unit_price,0,',','.')}} VNĐ
                @else
                {{number_format($sptt->promotion_price,0,',','.')}} VNĐ
                @endif" >
                
                <input type="hidden" id="instock{{$sptt->id}}" value="
                 @if($sptt->product_quantity>0)
                 {{ trans('home.INSTOCK') }}
                 @else
                 {{ trans('home.OUTSTOCK') }}
                 @endif
                 ">
                 <input type="hidden" id="mota{{$sptt->id}}" value="{!! $sptt->$multi_description !!}">
                <!-- Product Image Start -->
                <div class="pro-img">
                    <a id="wishList_producturl{{$sptt->id}}" href="{{route('chitietsanpham',['id'=> $sptt->id, 'product_slug'=>$sptt->product_slug])}}">
                        <img id="wishList_image{{$sptt->id}}" class="primary-img" src="source/image/product/{{$sptt->image}}" alt="single-product" height="226px" width="226px">
                        <img id="wishList_image{{$sptt->id}}" class="secondary-img" src="source/image/product/{{$sptt->image}}" alt="single-product" height="226px" width="226px">
                    </a>
                    <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$sptt->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                </div>
                <!-- Product Image End -->
                <!-- Product Content Start -->
                <div class="pro-content">
                    <div class="pro-info">
                        <h4><a href="product.html">{{$sptt->$multisp}}</a></h4>
                        @if($sptt->promotion_price == 0)
                        <p><span class="price">{{number_format($sptt->unit_price,0,',','.')}} VNĐ</span></p>
                        @else
                        <p><span class="price">{{number_format($sptt->promotion_price,0,',','.')}} VNĐ</span></p>
                        @endif
                    </div>
                    <div class="pro-actions">
                        <div class="actions-primary">
                            @if($sptt->product_quantity>0)
                            <a id="addcart{{$sptt->id}}" 
                                <?php 
                                    if(Auth::check() || Session::get('user_name_login')){
                                        $addnewcart = route('themgiohang',$sptt->id);
                                    }else{
                                        $addnewcart = route('dangnhap');
                                    }
                                ?> 
                                href="{{$addnewcart}}" 
                                
                                title="{{ trans('home.addcart') }}"> + {{ trans('home.addcart') }}</a>
                            @else
                            <a id="addcart{{$sptt->id}}" class="disabled-link"> + {{ trans('home.addcart') }}</a>
                            @endif
                        </div>
                        <div class="actions-secondary">
                            <a style="cursor: pointer;" id="{{$sptt->id}}" onclick="add_Compare(this.id)" title="{{ trans('home.addcompare') }}"><i class="lnr lnr-sync"></i> <span>{{ trans('home.addcompare') }}</span></a>
                            <a href="wishlist.html" title="{{ trans('home.addwishlist') }}"><i class="lnr lnr-heart"></i> <span>{{ trans('home.addwishlist') }}</span></a>
                        </div>
                    </div>
                </div>
                <!-- Product Content End -->
                @if($sptt->promotion_price != 0)
                <span class="sticker-new">{{ trans('home.sale') }}</span>
                @endif
            </div>
            @endforeach
            <!-- Single Product End -->                        
        </div>                
        <!-- Hot Deal Product Active End -->

    </div>
    <!-- Container End -->
</div>
<!-- Realated Products End Here -->
@endsection
@section('js')
    <!-- plugin facebook -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="3Gf0BF4H"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
             $('.share').click(function() {
                 var NWin = window.open($(this).prop('href'), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
                 if (window.focus)
             {
             NWin.focus();
             }
             return false;
             });
        });
    </script>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v10.0'
        });
      };

      (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection