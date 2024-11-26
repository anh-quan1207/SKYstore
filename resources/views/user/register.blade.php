<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    body {
        font-family: "Roboto", sans-serif;
    }

    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }

    .form-control-lg {
        font-size: 1rem !important;
    }

    .fs-16 {
        font-size: 16px !important;
    }

    .btn-login {
        padding-left: 1rem;
        padding-right: 1rem;
        font-size: 16px;
        font-weight: 500;
    }

    .error {
        font-size: 14px;
        color: red;
        margin-top: 4px;
        display: inline-block;
    }
</style>

<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="{{ asset('frontend/images/login.jpg') }}" class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="{{ route('user-register') }}" method="POST">
                    @csrf
                    <h3 class="mb-4">ĐĂNG KÝ TÀI KHOẢN</h3>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input required type="text" id="form3Example3" class="form-control form-control-lg"
                            placeholder="Username" name="username" value="{{ old('username') }}" />
                        @error('username')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <input required type="email" id="form3Example3" class="form-control form-control-lg"
                            placeholder="Email" name="email" value="{{ old('email') }}" />
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div data-mdb-input-init class="form-outline mb-3">
                        <input required type="password" id="form3Example4" class="form-control form-control-lg"
                            placeholder="Password" name="password" />
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div data-mdb-input-init class="form-outline mb-3">
                        <input required type="password" id="form3Example4" class="form-control form-control-lg"
                            placeholder="Confirm Password" name="password_confirmation" />
                        @error('password_confirmation')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div data-mdb-input-init class="form-outline mb-3">
                        <input required type="date" id="form3Example4" class="form-control form-control-lg"
                            name="birthday" />
                        @error('birthday')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-primary btn-lg btn-login">Đăng ký</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0 fs-16">Bạn đã có tài khoản? <a
                                href="{{ route('user-form-login') }}" class="link-danger">Đăng nhập</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
