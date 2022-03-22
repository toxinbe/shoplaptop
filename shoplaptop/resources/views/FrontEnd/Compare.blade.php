@extends('Layout')
@section('title')    
	Compare
@endsection
@section('content-layout')

<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">{{ trans('home.home') }}</a></li>
                <li class="active"><a href="{{route('sosanh')}}">Compare Product</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->       
 <!-- Compare Page Start -->
<div class="compare-product ptb-100 ptb-sm-60">
    <div class="container">
        <div class="table-responsive-sm">
            <table class="table text-center compare-content" id="compare-tr">
                <tbody>
                    <tr id="td1">
                        <td class="product-title">{{ trans('home.producttt') }}</td>

                    </tr>
                    <tr id="td2">
                        <td class="product-title">{{ trans('home.deption') }}</td>

                    </tr>
                    <tr id="td3">
                        <td class="product-title">{{ trans('home.gia') }}</td>
                        
                    </tr>
                    <tr id="td4">
                        <td class="product-title">{{ trans('home.status') }}</td>
                        
                    </tr>
                    <tr id="td5">
                        <td class="product-title">{{ trans('home.addcart') }}</td>

                    </tr>
                    <tr id="td6">
                        <td class="product-title">{{ trans('home.del') }}</td>
                        
                    </tr>
                    <tr id="td7">
                        <td class="product-title">{{ trans('home.sosao') }}</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Compare Page End -->

@endsection