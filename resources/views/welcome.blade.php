<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Clothing Shop</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">      
    <link rel="shortcut icon" href="{{ asset('frontend/images/new.jpg') }}">
</head>
<body>
	<header id="header">
		<div class="header_top">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactin4">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 097684999</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> eniuu127@gmail.com</a></li>
							</ul>
						</div>
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
		</div><!--/header_top-->
		
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

		<!-- header-middle -->
<div class="header-middle" style="position: relative;">
    <div class="container">
        <div class="row">
            <!-- Logo + Slogan -->
            <div class="col-sm-4">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <!-- Logo -->
                    <a href="{{ URL::to('/') }}">
                        <img src="{{ asset('frontend/images/header/h1.png') }}" alt="Logo" width="100" height="100" />
                    </a>
                    <!-- Slogan -->
                    <p style="
                        font-weight: bold;
                        font-size: 16px;
                        margin: 0;
                        color: #181616;
                    ">

                        Mỗi bước chân là một dải nắng <br>
						Mỗi outfit là một tuyệt tác.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/header-middle-->

	</header>
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">TRANG CHỦ</a></li>
								<li><a href="{{URL::to('san-pham')}}">SẢN PHẨM</a></li>
								<li><a href="{{URL::to('gio-hang')}}">GIỎ HÀNG</a></li>
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">

                        <!-- Slide 1 -->
						<div class="item active d-flex align-items-center" style="min-height: 350px;">
						<!-- Bên trái: nội dung chữ -->
						<div class="col-sm-6 d-flex flex-column justify-content-center">
							<h1 style="font-family: 'Roboto', sans-serif;"><span>Sale off 30%</span></h1>
							<h2>Set đồ đi biển</h2>
							<p>Đừng để chuyến đi biển của bạn thiếu đi một outfit thật "chill"! <br></p>
							<p>Tự tin sải bước giữa nắng gió, dù là dạo biển hay check-in quán cà phê ven biển.</p>
							<button type="button" class="btn btn-default get">Xem ngay</button>
						</div>

						<!-- Bên phải: ảnh váy -->
						<div class="col-sm-6 justify-content-center">
						<img src="{{ asset('frontend/images/slider/of2.png') }}"
							class="img-fluid"
							alt="Set đồ đi biển"
							style="height: 380px; width: 300px; object-fit: contain; margin-right: 100px " />
						</div>
					</div>		
					


                        <!-- Slide 2 -->
                        <div class="item">
                            <div class="col-sm-6">
                                <h1 style="font-family: 'Roboto', sans-serif;"><span>Siêu sale </span></h1>
                                <h2>Bikini cực xinh cho mùa hè</h2>
                                <p>Sẵn sàng bùng cháy dưới nắng hè với những mẫu bikini quyến rũ nhất!</p>
                                <button type="button" class="btn btn-default get">Khám phá</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset('frontend/images/slider/of3.png') }}" class="girl img-responsive" alt="" />
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="item">
                            <div class="col-sm-6">
                                <h1 style="font-family: 'Roboto', sans-serif;"><span>TẶNG NGAY</span> mũ cói</h1>
                                <h2>Khi mua set đồ đi biển / bikini bất kỳ</h2>
                                <p>Mix ngay cùng outfit của bạn để có bộ ảnh sống ảo xịn xò nhé!</p>
                                <button type="button" class="btn btn-default get">Mua ngay</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset('frontend/images/slider/of4.png') }}" class="girl img-responsive" alt="" />
                            </div>
                        </div>

                    </div>


                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
	
</section> <!--/slider-->

		<footer style="background-color: #fef6e4; padding: 40px 0; font-family: Arial, sans-serif;">
			<div style="max-width: 1200px; margin: auto; display: flex; flex-wrap: wrap; justify-content: space-between; color: #333;">
				
				<!-- Giới thiệu -->
				<div style="flex: 1; min-width: 250px; margin-bottom: 20px;">
				<h2 style="color: #e4b03f;">Clothing Shop</h2>
				<p>Shop thời trang cực trendy cho nàng </p>
				<p>Đa dạng mẫu mã trendy - Thời trang hè rực rỡ</p>
				</div>


				<!-- Thông tin liên hệ -->
				<div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
				<h3>Liên hệ</h3>
				<p>Email: eniuu127@gmail.com</p>
				<p>Hotline: 0976814999</p>
				<p>Địa chỉ: Yên Nghĩa - Hà Đông</p>
				</div>

				<!-- Đăng ký nhận ưu đãi -->
				<div style="flex: 1; min-width: 250px; margin-bottom: 20px;">
				<h3>Đăng ký nhận ưu đãi</h3>
				<input type="email" placeholder="Nhập email của bạn" style="padding: 8px; width: 80%; margin-bottom: 10px;">
				<button style="padding: 8px 16px; background-color: #e18523; border: none; color: white; cursor: pointer;">Gửi</button>
				</div>
			</div>

			<div style="text-align: center; padding-top: 20px; color: #888;">
				<p>© 2025. All rights reserved.</p>
				<p>Designed by <span><a target="_blank" href="https://github.com/eniuu127/project_webnangcao">Vũ Yến</a></span></p>
			</div>

		</footer>

	

    <script src="{{ asset('frontend/js/jquery.js')}}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{ asset('frontend/js/price-range.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{ asset('frontend/js/main.js')}}"></script>
</body>
</html> 