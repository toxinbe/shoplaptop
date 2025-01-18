<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{ asset('') }}">
    <title>@yield('title-ad')</title>

    <!-- Custom styles for this template-->
    <link href="{{ asset('source/assets/dest/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('source/assets/dest/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('source/assets/dest/css/active.css') }}" rel="stylesheet">
    <link href="{{ asset('source/assets/dest/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('source/assets/dest/css/toastr.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('source/assets/frontend/img/faviconShopPv.ico')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.speed.family/main.css" media="screen" title="style (screen)" /> -->
   <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> <i class="material-icons">computer</i>-->


</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('trang-chu-admin')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-dragon"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Administrator</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="@if (Request::url() == route('trang-chu-admin')) nav-item active  @else nav-item @endif">
                <a class="nav-link" href="{{route('trang-chu-admin')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ trans('home_ad.dashboard') }}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="@if (Request::url() == route('quanlysanpham')) nav-item active  @else nav-item @endif">
                <a class="nav-link" href="{{route('quanlysanpham')}}" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-laptop-medical"></i>
                    <span>{{ trans('home_ad.ql_sp') }}</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="@if (Request::url() == route('quanlynsx')) nav-item active  @else nav-item @endif">
                <a class="nav-link"  href="{{route('quanlynsx')}}" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-laptop-code"></i>
                    <span>{{ trans('home_ad.ql_nsx') }}</span>
                </a>

            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li 
                class="
                @if (Request::url() == route('quanlynguoidung') || Request::url() == route('quanlynguoidung_user') || Request::url() == route('quanlynguoidung_ad')) nav-item active  
                @else nav-item 
                @endif">
                <a class="nav-link collapsed" data-toggle="collapse" href="{{route('quanlynguoidung')}}" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
                    <i class="fas fa-users-cog"></i>
                    <span>{{ trans('home_ad.ql_tk') }}</span>
                </a>
                <div 
                    id="collapseUser" 
                    class="
                        @if(Request::url() == route('quanlynguoidung') || Request::url() == route('quanlynguoidung_user') || Request::url() == route('quanlynguoidung_ad')) 
                            collapse show  
                        @else collapse
                        @endif" 
                    aria-labelledby="headingUtilities" 
                    data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">{{ trans('home_ad.ql_tk') }}:</h6>
                    <a 
                        class="
                        @if (Request::url() == route('quanlynguoidung')) collapse-item active  
                        @else collapse-item 
                        @endif" href="{{route('quanlynguoidung')}}"
                        >Tất Cả Tài Khoản
                    </a>
                    <a 
                        class="
                        @if (Request::url() == route('quanlynguoidung_user')) collapse-item active  
                        @else collapse-item 
                        @endif" href="{{route('quanlynguoidung_user')}}"
                    >Tài Khoản Khách Hàng
                    </a>
                    <a 
                        class="
                        @if (Request::url() == route('quanlynguoidung_ad')) collapse-item active  
                        @else collapse-item 
                        @endif" href="{{route('quanlynguoidung_ad')}}">
                    Tài Khoản Admin
                    </a>
                </div>

            </li>



            <!-- Nav Item - Tables -->
            <li 
                class="                
                @if(Request::url() == route('donhang') || Request::url() == route('donhang_chuaduyet') || Request::url() == route('donhang_daduyet') || Request::url() == route('donhang_huy')) nav-item active  
                @else nav-item 
                @endif">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-shopping-cart"></i>
                    <span>{{ trans('home_ad.ql_dh') }}</span>
                </a>
                <div id="collapseUtilities" 
                    class="
                        @if(Request::url() == route('donhang') || Request::url() == route('donhang_chuaduyet') || Request::url() == route('donhang_daduyet') || Request::url() == route('donhang_huy')) collapse show  
                        @else collapse 
                        @endif" 
                    aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">{{ trans('home_ad.ql_dh') }}:</h6>
                    <a class="                        
                        @if (Request::url() == route('donhang')) collapse-item active  
                        @else collapse-item 
                        @endif" href="{{route('donhang')}}">Tất Cả Đơn Hàng
                    </a>
                    <a class="                        
                        @if (Request::url() == route('donhang_chuaduyet')) collapse-item active  
                        @else collapse-item 
                        @endif" href="{{route('donhang_chuaduyet')}}">Đơn Hàng Chưa Duyệt
                    </a>
                    <a class="                        
                        @if (Request::url() == route('donhang_daduyet')) collapse-item active  
                        @else collapse-item 
                        @endif" href="{{route('donhang_daduyet')}}">Đơn Hàng Đã Duyệt
                    </a>
                    <a class="                        
                        @if (Request::url() == route('donhang_huy')) collapse-item active  
                        @else collapse-item 
                        @endif" href="{{route('donhang_huy')}}">Hủy Đơn Hàng
                    </a>
                </div>
            </div>
            </li>
            <!-- Divider -->
            {{-- <hr class="sidebar-divider">

            <li class="@if (Request::url() == route('quanlyslide')) nav-item active  @else nav-item @endif">
                <a class="nav-link" href="{{route('quanlyslide')}}">
                    <i class="fab fa-slideshare"></i>
                    <span>{{ trans('home_ad.ql_slide') }}</span>
                </a>
            </li>

            <li class="@if (Request::url() == route('quanlynn')) nav-item active  @else nav-item @endif">
                <a class="nav-link"  href="{{route('quanlynn')}}">
                    <i class="fas fa-language"></i>
                    <span>{{ trans('home_ad.ql_lang') }}</span>
                </a>
            </li>

            <li class="@if (Request::url() == route('quanlycoupon')) nav-item active  @else nav-item @endif">
                <a class="nav-link"  href="{{route('quanlycoupon')}}">
                    <i class="fab fa-discourse"></i>
                    <span>{{ trans('home_ad.ql_coupon') }}</span>
                </a>
            </li> --}}
                      

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="{{ trans('home.search') }}" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">

                            <!-- Counter - Alerts -->


                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                  Message Center
                </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                    <div class="small text-gray-500">Jae Chun · 1d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">{{$dh_count_chuaduyet + $dh_count_huy}}+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="{{route('donhang_chuaduyet')}}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-info">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">{{$now}}</div>
                                        <span class="font-weight-bold">Bạn có {{$dh_count_chuaduyet}} đơn hàng chưa duyệt!</span>
                                    </div>
                                </a>
                                @if($dh_count_huy)
                                <a class="dropdown-item d-flex align-items-center" href="{{route('donhang_huy')}}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-danger">
                                            <!-- <i class="fas fa-donate text-white"></i> -->
                                            <i class="fas fa-ban text-white"></i>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="small text-gray-500">{{$now}}</div>
                                        Hủy {{$dh_count_huy}} đơn hàng!
                                    </div>
                                </a>
                                @endif
                                
<!--                                 <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a> -->
                            </div>
                        </li>

                        <!-- Nav Item - Language -->
                        <li  class="nav-item dropdown no-arrow mx-1">
                            {{-- <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-language"></i>
                            </a> --}}
                            <!-- Dropdown - Language -->
                            <div class="dropdown-menu dropdown-menu-right p-0">
                    
                                <a class="dropdown-item d-flex align-items-center" href="{{URL::asset('')}}language/vi">
                                    <div class="dropdown-list-image mr-3">
                                        <img  src="https://cdn.countryflags.com/thumbs/vietnam/flag-400.png" width="16px" alt="">
                                    </div>
                                    <div>
                                        <div class="text-truncate">{{ trans('home.languagevi') }}</div>
                                    </div>
                                </a>

                                 <a class="dropdown-item d-flex align-items-center" href="{{URL::asset('')}}language/en">
                                    <div class="dropdown-list-image mr-3">
                                        <img  src="https://cdn.countryflags.com/thumbs/united-states-of-america/flag-400.png" width="16px" alt="">
                                    </div>
                                    <div>
                                        <div class="text-truncate">{{ trans('home.languageen') }}</div>
                                    </div>
                                </a>

                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="margin-top: 1%">
                                    @if(Auth::check() && Auth::user()->level == 1)
                                        {{Auth::user()->full_name}}
                                    @endif
                                </span>
                                <img class="img-profile rounded-circle" src="https://i.pinimg.com/originals/9b/69/ac/9b69acfda6b057c79950d8103622b648.jpg">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('trang-chu')}}">
                                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>{{ trans('home.home') }}
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#userUpdate_{{Auth::user()->id}}">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> {{ trans('home_ad.account_information') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ trans('home.logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    @yield('content-ad')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!----------------------------------------------thong tin------sua----------------------------------------------------------->

    <div class="modal fade" id="userUpdate_{{Auth::user()->id}}" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-write">
                    <h4 class="modal-title">{{ trans('home.up_date') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                    </button>
                </div>
                <form action="{{route('userupdate1')}}" method="post">
                    <!-- form delete -->
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="text" hidden class="col-sm-9 form-control" id="idUpdate_{{Auth::user()->id}}" name="idUpdate" value="{{Auth::user()->id}}" />
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('home.fullname') }}*</label>
                            <input type="text" id="e_name_{{Auth::user()->id}}" name="name" class="form-control" value="{{Auth::user()->full_name}}" />

                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('home.ress') }}*</label>
                            <input type="text" id="e_adress_{{Auth::user()->id}}" required name="adress" class="form-control" value="{{Auth::user()->address}}" />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">Email</label>
                            <input type="text" id="e_email_{{Auth::user()->id}}" required name="email" class="form-control" value="{{Auth::user()->email}}" />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('home.phone') }}*</label>
                            <input type="text" id="e_phone_{{Auth::user()->id}}" required name="phone" class="form-control" value="{{Auth::user()->phone}}" />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('home.pass') }}*</label>
                            <input type="password" id="e_password_{{Auth::user()->id}}" required name="password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('home.repassword') }}*</label>
                            <input type="password" id="e_re_password_{{Auth::user()->id}}" required name="re_password" class="form-control" />
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>{{ trans('home.cancel') }}</button>
                        <button type="submit" class="btn btn-primary"><i class="icofont icofont-check-circled"></i>{{ trans('home.up_date') }}</button>
                    </div>
                </form>
                <!-- form delete end -->
            </div>
        </div>
    </div>


    <!-- Logout Modal-->
    @extends('dk-dn-dx/dangxuat') @section('content-dx') @endsection


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <!-- ckeditor -->
    <!-- <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script> -->
    <script src="{{asset('source/assets/dest/ckeditor/ckeditor.js')}}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('source/assets/dest/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('source/assets/dest/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('source/assets/dest/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('source/assets/dest/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <!-- <script src="{{ asset('source/assets/dest/vendor/chart.js/Chart.min.js') }}"></script> -->

    <!-- Page level custom scripts -->
<!--     <script src="{{ asset('source/assets/dest/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('source/assets/dest/js/demo/chart-pie-demo.js') }}"></script> -->

    <!-- Page level plugins -->
    <script src="{{ asset('source/assets/dest/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('source/assets/dest/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('source/assets/dest/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('source/assets/dest/js/toastr.min.js') }}"></script>

    <!-- datepicker -->
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Slug -->
    <script src="{{ asset('source/assets/dest/js/slug.js') }}"></script>

<!--     <style type="text/css">
        .current_page_item {
              background-color: #C00;
              color: #FFF;
            }
    </style>

   <script type="text/javascript">
        $('#accordionSidebar a').click(function(e) {
            $('#accordionSidebar a').removeClass('current_page_item');
            $(this).addClass('current_page_item');
        });
    </script> -->

    <!-- hien thi anh truoc khi up -->
    <script type="text/javascript">
        function ImageFileUrl(){
            var fileSlected = document.getElementById('e_image').files;
            if (fileSlected.length > 0) {
                var fileToLoad = fileSlected[0];
                var fileReader  = new FileReader();
                fileReader.onload = function(fileLoadEvent){
                    var srcData = fileLoadEvent.target.result;
                    var newImage = document.createElement('img');
                    newImage.src =srcData;
                    document.getElementById('displayimg').innerHTML = newImage.outerHTML;
                }
                fileReader.readAsDataURL(fileToLoad);
            }
        }
    </script>

    <!-- chon hinh thuc don hang -->
    <script type="text/javascript">
        $('.oder_deltail').change(function(){
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();


            //lay so luong
            quantity = [];
            $("input[name='product_quantity_order']").each(function(){
                quantity.push($(this).val());
            });

            //lay product id
            order_product_id = [];
            $("input[name='order_product_id']").each(function(){
                order_product_id.push($(this).val());
            });

            j=0;
            for(i=0; i<order_product_id.length; i++){
                var order_qty = $('.order_qty_' + order_product_id[i]).val();
                var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

                if (parseInt(order_qty)>parseInt(order_qty_storage)) {
                    j += 1;
                    if (j==1) {
                        alert('Số lượng trong kho không đủ');
                    }
                    $('.color_qty_' + order_product_id[i]).css('color','#e74a3b').css('font-weight','bold');
                }

            }
            if(j==0){
                $.ajax({
                    url:"{{url('/update-order-qty')}}",
                    method: "POST",
                    data: {_token:_token, order_status:order_status, order_id:order_id, quantity:quantity, order_product_id:order_product_id },
                    success:function(data){
                        alert('Cập nhật đơn hàng thàng công');
                        location.reload();
                    }
                });
            }
           

        });
    </script>
    @if($url_canonical == route('quanlysanpham'))
    <!-- Ckeditor -->
    <script type="text/javascript">
        $(document).ready(function(){
            update_product_id = [];
            $("input[name='update_product_id']").each(function(){
                update_product_id.push($(this).val());
            });
            for(i=0; i<update_product_id.length; i++){ 
                CKEDITOR.replace('e_descriptionvi_' + update_product_id[i]);
                CKEDITOR.replace('e_descriptionen_' + update_product_id[i]);
            }
            CKEDITOR.replace('e_description1');
            CKEDITOR.replace('e_description2');
        });

        $(document).ready(function(){
            update_product_id = [];
            $("input[name='update_product_id']").each(function(){
                update_product_id.push($(this).val());
            });
            for(i=0; i<update_product_id.length; i++){ 
                $( "#date_sale_product_" + update_product_id[i]).datepicker({
                    dateFormat: "yy/mm/dd"
                });
            }
        });
    </script>
    @endif
    <!-- Datepicker|| Slug -->
    

    
    <script>

      $( function() {

        $( "#datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
        $( "#datepicker1" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
        coupon_product_id = [];
        $("input[name='coupon_product_id']").each(function(){
            coupon_product_id.push($(this).val());
        });
        for(i=0; i<coupon_product_id.length; i++){ 
            // alert(coupon_product_id[i]);
            $( "#coupon_date_start_" + coupon_product_id[i]).datepicker({
                dateFormat: "dd-mm-yy"
            });
            $( "#coupon_date_end_" + coupon_product_id[i]).datepicker({
                dateFormat: "dd-mm-yy"
            });
        }
        $( "#date_sale_product" ).datepicker({
            dateFormat: "yy/mm/dd"
        });
        $( "#coupon_date_start" ).datepicker({
            dateFormat: "dd-mm-yy"
        });
        $( "#coupon_date_end" ).datepicker({
            dateFormat: "dd-mm-yy"
        });
        
        @if($url_canonical == route('quanlynn'))
        post_name_id_post = [];
        $("input[name='post_name_id_post']").each(function(){
            post_name_id_post.push($(this).val());
        });
        for(i=0; i<post_name_id_post.length; i++){ 
        // alert("#sp_vi_" + post_name_id_post[i]);
        CKEDITOR.replace('desvi_' + post_name_id_post[i]);
        CKEDITOR.replace('desen_' + post_name_id_post[i]);

        $( "#sp_vi_" + post_name_id_post[i] ).keyup(function(event)
        {
            var title, slug;
         
            //Lấy text từ thẻ input title 
            title = $(this).val();
         
            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();
         
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            // document.getElementById('slug').value = slug;
            for(i=0; i<post_name_id_post.length; i++){ 
                $("#slug_" + post_name_id_post[i]).val(slug);
            }
        });
        }
        CKEDITOR.replace('desvi');
        CKEDITOR.replace('desen');
        @endif

      } );
    </script>

    @if($url_canonical == route('trang-chu-admin'))
    <script type="text/javascript">
        $(document).ready(function(){

            chart30daysorder();

            var colorDanger = "#FF1744";
            Morris.Donut({
              element: 'donut-chart',
              resize: true,
              colors: [
                '#4e73df',
                '#36b9cc',
                '#1cc88a',
                '#f6c23e',
                '#858796',
                '#5a5c69'
                
              ],

              data: [
                {label:"{{ trans('home_ad.dash_sp') }}", value:<?php echo $sp_count ?>},
                {label:"{{ trans('home_ad.dash_dn') }}", value:<?php echo $dh_count ?>},
                {label:"{{ trans('home_ad.dash_kh') }}", value:<?php echo $nd_count ?>},
                {label:"{{ trans('home_ad.dash_lang') }}", value:2},
                {label:"{{ trans('home_ad.dash_nsx') }}", value:<?php echo $loai_count ?>},
                {label:"Slide", value:<?php echo $slide_count ?>}
              ]
            });


            var chart = new Morris.Bar({
              
                element: 'chart',
                parseTime: false,
                hideHover:'auto',
                barColors: ['#36b9cc', '#4e73df', '#1cc88a', '#e74a3b'],

                xkey: 'period',
                ykeys: ['order', 'sales', 'profit', 'quantity'],
                labels: ['{{ trans('home_ad.dash_dn') }}', '{{ trans('home_ad.doanhso') }}', '{{ trans('home_ad.loinhuan') }}', '{{ trans('home_ad.soluong') }}']
            });

            function chart30daysorder(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/days-order')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: { _token:_token},
                    success:function(data){
                        chart.setData(data);
                    }
                });
            }

            $('.dashboard-filter').change(function(){
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{url('/dashboard-filter')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: {dashboard_value:dashboard_value, _token:_token},
                    success:function(data){
                        chart.setData(data);
                    }
                });

            });

            $('#btn-dashboard').click(function(){
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker1').val();

                $.ajax({
                    url:"{{url('/filter-by-date')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: {from_date:from_date, to_date:to_date, _token:_token},

                    success:function(data){
                        chart.setData(data);
                    }
                });
            });


        });
        
        
    </script>
    @endif
    <script type="text/javascript">
        @if(session('thongbao'))
        
            toastr.success('{{ session('thongbao') }}', '{{trans('home.Notification')}}',{timeOut: 7000});

        @endif 
        @if($errors->any()) 
          @foreach($errors->all() as $err)
            
            toastr.error('{{$err}}', '{{trans('home.Notification')}}',{timeOut: 7000});
            
          @endforeach
        @endif
    </script>

    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>
</body>

</html>