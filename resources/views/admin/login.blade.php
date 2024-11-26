<!DOCTYPE html>

<head>
    <title>Admin | Đăng nhập</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('admin/css/login.css') }}" rel='stylesheet' type='text/css' />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}" type="text/css" />
    <link href="{{ asset('admin/css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
</head>

<body>
    <div class="login">
        <div class="login-main">
            <h2>ĐĂNG NHẬP TÀI KHOẢN</h2>
            <form action="{{ route('admin-login') }}" method="post">
                @csrf
                <input type="text" class="ggg" name="username" placeholder="Tên đăng nhập..." required=""
                    value="{{ old('username') }}">
                @error('username')
                    <span class="error">{{ $message }}</span>
                @enderror
                <input type="password" class="ggg" name="password" placeholder="Mật khẩu..." required="">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
                <span class="remember-password"><input type="checkbox" /> Nhớ mật khẩu</span>
                <h6><a href="#" class="forget-password">Quên mật khẩu?</a></h6>
                <div class="clearfix"></div>
                <input type="submit" value="Đăng nhập" name="login">
            </form>
            <p>Nếu bạn chưa có tài khoản ?<a href="registration.html">Tạo tài khoản</a></p>
        </div>
    </div>
</body>

</html>
