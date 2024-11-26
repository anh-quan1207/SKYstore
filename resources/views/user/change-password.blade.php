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

            .input-item {
                margin-bottom: 24px;
            }

            .active a {
                background: #fff !important;
                color: #000 !important;
                padding: 0 !important;
            }

            .form-control  {
                margin-bottom: 8px;
            }
        </style>

        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home_page_user') }}">Trang Chủ</a></li>
                    <li class="active"><a href="{{ route('account-infor') }}">THÔNG TIN TÀI KHOẢN
                        </a>
                    </li>
                    <span class="active"> <i style="padding: 0 6px;" class="fa-solid fa-angle-right"></i> </span>
                    <li class="landing">THAY ĐỔI MẬT KHẨU</li>
                </ol>
            </div>

            <form action="{{ route('update-password') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row input-item">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Mật khẩu cũ</label>
                        <input type="password" class="form-control" name="current_password" placeholder="Mật khẩu hiện tại" required>
                        @error('current_password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row input-item">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Mật khẩu mới</label>
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới" required>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row input-item">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Xác nhận mật khẩu mới</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Xác nhận mật khẩu mới" required>
                        @error('password_confirmation')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                          <button class="btn change-password">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('.change-password').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    text: "Bạn có chắc chắn thay đổi mật khẩu?",
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
