@extends('user/layouts/layout')
@section('content')
    <section>
        <style>
            section {
                min-height: 500px;
            }

            form {
                margin-bottom: 24px;
            }

            .input-change {
                position: relative;
                margin-bottom: 8px;
            }

            .btn-change {
                position: absolute;
                bottom: 2px;
                right: -90px;
                padding: 2px;
                border: 1px solid #ccc;
            }

            .form-control {
                border: none !important;
                border-top: none !important;
                border-bottom: 2px solid #000 !important;
                border-radius: 0 !important;
                height: 40px !important;
                font-size: 16px !important;
            }

            .form-control:focus {
                -webkit-box-shadow: none !important;
                box-shadow: none !important;
                border-color: #b42a56 !important;
            }

            label {
                font-size: 17px !important;
            }

            .swal2-popup {
                width: 500px;
            }

            div:where(.swal2-container) .swal2-html-container {
                font-size: 20px;
            }

            .swal2-actions {
                font-size: 14px;
            }

            button.swal2-confirm.swal2-styled {
                padding: 8px 70px;
            }

            .error {
                color: red;
            }

            button a {
                color: #000;
            }
        </style>
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home_page_user') }}">Trang Chủ</a></li>
                    <li class="active">THÔNG TIN TÀI KHOẢN</li>
                </ol>
            </div>

            <form action="{{ route('update-username') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Tên đăng nhập</label>
                        <div class="input-change">
                            <input type="text" class="form-control" name="username" value="{{ $customer->username }}"
                                placeholder="Tên đăng nhập" required>
                            <button class="btn-change change-username">Thay đổi</button>
                        </div>
                        @error('username')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>


        <div class="container">
            <form action="{{ route('update-email') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <div class="input-change">
                            <input type="text" class="form-control" name="email" value="{{ $customer->email }}"
                                placeholder="Email" required>
                            <button class="btn-change change-email">Thay đổi</button>
                        </div>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

        <div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Mật khẩu</label>
                        <div class="input-change">
                            <input type="text" class="form-control" name="password" value="******" placeholder="Mật khẩu"
                                required>
                            <button class="btn-change change-password"><a href="{{ route('form-change-password') }}">Thay đổi</a></button>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('.change-username').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    text: "Bạn có chắc chắn thay đổi tên đăng nhập?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác Nhận',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            $('.change-email').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    text: "Bạn có chắc chắn thay đổi email?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác Nhận',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
