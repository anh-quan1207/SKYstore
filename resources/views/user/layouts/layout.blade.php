<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | ROMAN-STORE</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ 'frontend/images/ico/favicon.ico' }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ 'frontend/images/ico/apple-touch-icon-144-precomposed.png' }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ 'frontend/images/ico/apple-touch-icon-114-precomposed.png' }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ 'frontend/images/ico/apple-touch-icon-72-precomposed.png' }}">
    <link rel="apple-touch-icon-precomposed" href="{{ 'frontend/images/ico/apple-touch-icon-57-precomposed.png' }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://esgoo.net/scripts/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <style>
        #footer {
            margin-top: 32px;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: white;
        }

        body {
            padding-top: 208px;
        }

        .search_box {
            position: relative;
        }

        .search_box input {
            width: 100%;
            background-image: none !important;
            border: 1px solid #ccc;
            border-radius: 25px;
            padding-left: 24px;
        }

        .search_box button {
            border: none;
            background: #ccc;
            height: 35px;
            position: absolute;
            right: 0;
            padding: 0 12px;
            border-top-right-radius: 25px;
            /* Góc trên bên phải */
            border-bottom-right-radius: 25px;
        }
    </style>
</head><!--/head-->

<body>
    @include('toast')
    @php
        use Illuminate\Support\Facades\Auth;
    @endphp
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-twitter"></i></li>
                                <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="{{ asset('frontend/images/home/logo3.png') }}"
                                    alt="" style="width:139px;height:40px" /></a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        @if (isset($displaySearch))
                            <div class="search_box">
                                @if (isset($parent_catgory_id_search))
                                    <form
                                        action="{{ route('products-by-parent-category', ['parent_category' => $parentCategoryParam]) }}">
                                        <input type="text" placeholder="Nhập tên sản phẩm" name="product_name"
                                            value="{{ request()->input('product_name', old('product_name')) }}" />
                                        <button>
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </form>
                                @else
                                    <form
                                        action=""{{ route('products-by-category', ['id' => $category_id_search]) }}"">
                                        <input type="text" placeholder="Nhập tên sản phẩm" name="product_name" />
                                        <button>
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                @if (Auth::check())
                                    <li><a href="{{ route('user-cart') }}"><i class="fa fa-shopping-cart"></i> Giỏ
                                            hàng</a></li>
                                    <li>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button"
                                                id="menu1" data-toggle="dropdown"><i class="fa fa-user"></i>
                                                {{ Auth::user()->username }}
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                        href="{{ route('account-infor') }}"><i
                                                            class="fa-solid fa-pen-to-square"></i> Thông
                                                        tin tài khoản</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                        href="{{ route('order-history') }}"><i
                                                            class="fa-solid fa-cart-shopping"></i> Lịch sử
                                                        mua hàng</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                        href="{{ route('user-logout') }}"><i
                                                            class="fa-solid fa-arrow-right-from-bracket"></i> Đăng
                                                        xuất</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @else
                                    <li><a href="{{ route('user-form-login') }}"><i class="fa fa-lock"></i> Đăng
                                            nhập</a></li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ route('home_page_user') }}">TRANG CHỦ</a></li>
                                <li>
                                    <a
                                        href="{{ route('products-by-parent-category', ['parent_category' => 'men']) }}">THỜI
                                        TRANG NAM<i class="fa fa-angle-down"></i></a>
                                </li>
                                <li><a
                                        href="{{ route('products-by-parent-category', ['parent_category' => 'women']) }}">THỜI
                                        TRANG NỮ<i class="fa fa-angle-down"></i></a>
                                </li>
                                <li><a
                                        href="{{ route('products-by-parent-category', ['parent_category' => 'sport']) }}">ĐỒ
                                        THỂ THAO<i class="fa fa-angle-down"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

    {{--  CONTENT  --}}
    @yield('content')
    {{--  END-CONTENT  --}}

    <footer id="footer"><!--Footer-->
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i
                                        class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>

    </footer><!--/Footer-->

    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>
