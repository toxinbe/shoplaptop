<!doctype html>
<html class="no-js" lang="zxx">

<head>

    <title>@yield('title') || ShopPv</title>
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
        <!-- Categorie Menu & Slider Area Start Here -->
        <div class="main-page-banner home-3">
            <div class="container">
                <div class="row">
                    <!-- Vertical Menu Start Here -->
                    @include('FrontEnd.Menu')
                    <!-- Vertical Menu End Here -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->           
        </div>
        <!-- Categorie Menu & Slider Area End Here -->
        @yield('content-layout')
        <!-- Support Area Start Here -->
        @include('FrontEnd.Footer')


    </div>
    <!-- Main Wrapper End Here -->

   @include('FrontEnd.Style.Script')

</body>

</html>