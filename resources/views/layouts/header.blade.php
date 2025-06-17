<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
        }

        .header_top {
            background: #ffedc3;
            padding: 0;
            color: #000;
            font-size: 13px;
        }

        .header_top a {
            color: #000 !important;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <!-- ==== HEADER ==== -->
    <header id="header">

        <!-- Top -->
        <div class="header_top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> 097684999</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> eniuu127@gmail.com</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Đăng nhập / Đăng xuất -->
        <div style="position: absolute; top: 75px; right: 200px; z-index: 999;">
            <div class="shop-menu">
                <ul class="nav navbar-nav">
                    <?php $customer_id = Session::get('customer_id'); ?>
                    @if($customer_id != NULL)
                        <li><a href="{{ URL::to('logout-checkout') }}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                    @else
                        <li><a href="{{ URL::to('login-checkout') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Middle -->
        <div class="header-middle" style="position: relative;">
            <div class="container">
                <div class="row">
                    <!-- Logo + Slogan -->
                    <div class="col-sm-4">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <a href="{{ URL::to('/') }}">
                                <img src="{{ asset('frontend/images/header/h1.png') }}" alt="Logo" width="100" height="100" />
                            </a>
                            <p style="font-weight: bold; font-size: 16px; margin: 0; color: #181616;">
                                Mỗi bước chân là một dải nắng <br>
                                Mỗi outfit là một tuyệt tác.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ URL::to('/trang-chu') }}" class="active" style="color: #696763;">TRANG CHỦ</a></li>
                                <li><a href="{{ URL::to('san-pham') }}" class="active" style="color: #ef844e;">SẢN PHẨM</a></li>
                                <li><a href="{{ URL::to('gio-hang') }}">GIỎ HÀNG</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <!-- ==== CONTENT ==== -->
    <div class="container mt-4">
        @yield('content')
    </div>

</body>
</html>
