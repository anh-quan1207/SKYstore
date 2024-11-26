@extends('user/layouts/layout')
@section('content')
    <script src="https://esgoo.net/scripts/jquery.js"></script>
    <link href="{{ asset('frontend/css/pay.css') }}" rel="stylesheet" />
    <style>
        .notify-row {
            display: inline-flex;
            position: absolute;
            height: 34px;
            width: 35px;
            right: 0;
            background: #ccc;
            color: black;
            justify-content: center;
            align-items: center;
        }

        .notify-row a:hover {
            color: #000 !important;
        }

        .notify-row i {
            color: #000;
            font-size: 18px;
        }

        .dropdown-menu a {
            cursor: default;
        }

        .dropdown-menu.extended {
            min-width: 160px !important;
            top: 42px;
            width: 450px !important;
            padding: 0 10px;
            box-shadow: 0 0px 5px rgba(0, 0, 0, 0.1) !important;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            background: #f1f2f7;
            border: none;
            left: -10px;
            min-height: 50px;
            max-height: 320px;
            overflow-y: auto;
            padding: 24px 8px;
        }

        .dropdown-menu.extended.tasks-bar li a {
            background: #fff;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            float: left;
            width: 100%;
        }

        .dropdown-menu.extended li a {
            font-size: 12px;
            list-style: none;
        }

        .dropdown-menu.tasks-bar .task-info .desc {
            font-size: 13px;
            font-weight: normal;
            float: left;
            padding: 0;
        }

        .task-info img {
            width: 100%;
        }

        .pull-left p {
            margin: 0;
        }

        .pull-left .title-voucher {
            font-weight: 700;
        }

        .pull-left .value-voucher {
            font-size: 16px;
        }

        .pull-left .date-voucher,
        .pull-left .date-voucher i {
            font-size: 12px;
            color: #9f9393;
        }

        .align-items-center {
            display: flex;
            align-items: center;
        }

        .disabled .btn-use {
            background-color: #ccc;
        }

        .btn-use {
            font-size: 14px;
            border-radius: 5px;
            padding: 8px 12px;
            background: #26AA99;
            color: #fff;
            outline: none;
        }

        .btn-use:hover {
            cursor: pointer;
        }

        .disabled {
            pointer-events: none;
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
    @php
        use Carbon\Carbon;
    @endphp
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home_page_user') }}">Trang Chủ</a></li>
                    <li class="active">THANH TOÁN</li>
                </ol>
            </div><!--/breadcrums-->



            <div class="review-payment">
                <h2 style="font-weight: 700">SẢN PHẨM</h2>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">HÌNH ẢNH</td>
                            <td class="description">TÊN SẢN PHẨM</td>
                            <td class="price">GIÁ (VND)</td>
                            <td class="quantity">SỐ LƯỢNG</td>
                            <td class="total">TỔNG TIỀN (VND)</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($productVariant))
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img style="width: 80px; height: 80px;"
                                            src="{{ asset('/image/' . $productVariant->image_path) }}" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $productVariant->product->name }}</a></h4>
                                    <p>{{ $productVariant->color . ', ' . renderSize($productVariant->size) }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ priceFormat(priceDiscount($productVariant->product->price, $productVariant->product->discount)) }}đ
                                    </p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        {{ $buyQuantity }}
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        {{ priceFormat(priceDiscount($productVariant->product->price, $productVariant->product->discount) * $buyQuantity) }}
                                    </p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <form action="{{ route('create-pay', ['type' => 2]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Họ và tên</label>
                        <input type="text" class="form-control" id="inputEmail4" name="customer_name"
                            value="{{ old('customer_name') }}" placeholder="Họ và tên" required>
                        @error('customer_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Số điện thoại</label>
                        <input type="text" class="form-control" id="inputPassword4" name="customer_phone"
                            value="{{ old('customer_phone') }}" placeholder="Số điện thoại" required>
                        @error('customer_phone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <label for="inputPassword4">Địa chỉ nhận hàng</label>
                <div class="row">
                    <div class="form-group col-md-4">
                        <select class="css_select" id="province" name="province" title="--Chọn Tỉnh Thành--"
                            class="form-control" required>
                            <option value="0">Tỉnh Thành</option>
                        </select>
                        @error('province')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <select class="css_select" id="district" name="district" title="--Chọn Quận Huyện--"
                            class="form-control" required>
                            <option value="0">--Quận Huyện--</option>
                        </select>
                        @error('district')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <select class="css_select" id="ward" name="ward" title="--Chọn Phường Xã-- "
                            class="form-control" required>
                            <option value="0">--Phường Xã--</option>
                        </select>
                        @error('ward')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="inputEmail4" name="address_detail"
                            placeholder="Địa chỉ cụ thể" required value="{{ old('address_detail') }}">
                        @error('address_detail')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="inputState">Hình thức thanh toán</label>
                        <select name="payments" id="paymentSelect" class="form-control" required>
                            <option value="1">Thanh Toán Khi Nhận Hàng</option>
                            <option value="2">Thanh Toán Trực Tuyến</option>
                        </select>
                        @error('payments')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputZip">Mã giảm giá</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Mã giảm giá" name="voucher"
                                id="voucher" value="{{ old('voucher') }}" readonly>
                            <li class="dropdown notify-row">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa-solid fa-ticket"></i>
                                </a>
                                <ul class="dropdown-menu extended tasks-bar">
                                    @if (isset($vouchers))
                                        @foreach ($vouchers as $voucher)
                                            @php
                                                $isDisabled = Carbon::parse($voucher->start_date)->isFuture();
                                            @endphp
                                            <li>
                                                <a href="#" data-id="{{ $voucher->id }}"
                                                    class="{{ $isDisabled ? 'disabled' : '' }}">
                                                    <div class="task-info clearfix row align-items-center">
                                                        <div class="col-sm-3">
                                                            <img src="{{ asset('/frontend/images/home/logo-voucher.jpg') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-8 desc pull-left">
                                                                    <h5 class="title-voucher" style="margin: 0">
                                                                        {{ $voucher->title }}
                                                                    </h5>
                                                                    <p class="value-voucher">Giảm <span
                                                                            style="color: #e70b0b;font-weight: 600;">{{ $voucher->value }}%</span>
                                                                        giá trị đơn hàng
                                                                    </p>
                                                                    <p class="date-voucher"><i
                                                                            class="fa-solid fa-clock"></i>
                                                                        Ngày
                                                                        áp dụng: {{ formatDate($voucher->start_date) }}</p>
                                                                    <p class="date-voucher"><i
                                                                            class="fa-solid fa-clock"></i>
                                                                        Ngày
                                                                        hết hạn: {{ formatDate($voucher->end_date) }}</p>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <span class="btn-use"
                                                                        data-id="{{ $voucher->id }}">Sử Dụng</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                    @endif
                                </ul>
                            </li>
                            @error('voucher')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row online-payment"></div>
                <div class="row">
                    <div class="col-md-8">

                    </div>
                    <div class="col-md-4">
                        <table class="table table-condensed total-result">
                            <tr>
                                <td>Số loại sản phẩm</td>
                                <td><strong>1</strong></td>
                            </tr>
                            <tr>
                                <td>Giảm giá</td>
                                <td><strong style="color: #9f9f9f"><span class="voucher-value">0</span> VND</strong></td>
                            </tr>
                            <tr>
                                @php
                                    $totalPayment =
                                        priceDiscount(
                                            $productVariant->product->price,
                                            $productVariant->product->discount,
                                        ) * $buyQuantity;
                                @endphp
                                <td>Tồng tiền cần thanh toán</td>
                                <td><strong style="color: "><span class="total-payment"
                                            data-total_payment="{{ $totalPayment }}">{{ priceFormat($totalPayment) }}</span>
                                        VND</strong></td>
                                <input type="hidden" name="total_payment" value="{{ $totalPayment }}">
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-8"></div>
                    <div class="form-group col-md-4 text-center">
                        <button type="submit" class="btn btn-payment">ĐẶT HÀNG</button>
                    </div>
                </div>
            </form>
        </div>


        <script>
            $(document).ready(function() {
                let vouchers = @json($vouchers);
                if (!Array.isArray(vouchers)) {
                    vouchers = Object.values(vouchers);
                }
                if (!Array.isArray(vouchers)) {
                    vouchers = [vouchers];
                }
                let voucherTypeOnlinePayment = vouchers.filter(function(voucher) {
                    return voucher.voucher_type === 4;
                });
                let $links = $('a').filter(function() {
                    return voucherTypeOnlinePayment.some(voucher => $(this).data('id') === voucher.id);
                });
                $links.addClass('disabled');

                $('#paymentSelect').change(function() {
                    paymentValue = $(this).val();
                    if (paymentValue === "1" || paymentValue === "0") {
                        $links.addClass('disabled');
                        let voucherCode = $('#voucher').val();
                        for (let i = 0; i < voucherTypeOnlinePayment.length; i++) {
                            if (voucherCode === voucherTypeOnlinePayment[i].voucher_code) {
                                $('#voucher').val('');
                                let totalPayment = $('.total-payment').data('total_payment');
                                $('.total-payment').html(formatNumber(totalPayment));
                                $('input[name="total_payment"]').val(totalPayment);
                                $('.voucher-value').html(0);
                                break;
                            }
                        }

                    } else {
                        $links.removeClass('disabled');
                    }
                });

                $('.btn-use').click(function(e) {
                    e.preventDefault();
                    let voucherId = $(this).data('id');
                    let $voucherValue = null;
                    for (let i = 0; i < vouchers.length; i++) {
                        if (vouchers[i].id == voucherId) {
                            $('#voucher').val(vouchers[i].voucher_code);
                            voucherValue = vouchers[i].value;
                            break;
                        }
                    }

                    let totalPayment = $('.total-payment').data('total_payment');
                    let voucherDiscount = Math.round(totalPayment * voucherValue / 100);
                    totalPayment -= voucherDiscount;
                    $('.total-payment').html(formatNumber(totalPayment));
                    $('input[name="total_payment"]').val(totalPayment);
                    $('.voucher-value').html(formatNumber(voucherDiscount));

                });

                $('#voucher').on('keydown', function(e) {
                    e.preventDefault();
                });

                function formatNumber(number) {
                    let roundedNumber = Math.round(number);
                    return roundedNumber.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }
            });

            $(document).ready(function() {
                //Lấy tỉnh thành
                $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
                    if (data_tinh.error == 0) {
                        $.each(data_tinh.data, function(key_tinh, val_tinh) {
                            $("#province").append('<option value="' + val_tinh.full_name +
                                '" data-tinh_id="' + val_tinh.id + '">' + val_tinh.full_name +
                                '</option>');
                        });
                        $("#province").change(function(e) {
                            var idtinh = $(this).find(':selected').data('tinh_id');
                            //Lấy quận huyện
                            $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(
                                data_quan) {
                                if (data_quan.error == 0) {
                                    $("#district").html(
                                        '<option value="0">--Quận Huyện--</option>');
                                    $("#ward").html('<option value="0">--Phường Xã--</option>');
                                    $.each(data_quan.data, function(key_quan, val_quan) {
                                        $("#district").append('<option value="' +
                                            val_quan
                                            .full_name + '" data-quan_id="' +
                                            val_quan.id + '">' + val_quan
                                            .full_name +
                                            '</option>');
                                    });
                                    //Lấy phường xã  
                                    $("#district").change(function(e) {
                                        var idquan = $(this).find(':selected').data(
                                            'quan_id')
                                        $.getJSON('https://esgoo.net/api-tinhthanh/3/' +
                                            idquan + '.htm',
                                            function(data_phuong) {
                                                if (data_phuong.error == 0) {
                                                    $("#ward").html(
                                                        '<option value="0">--Phường Xã--</option>'
                                                    );
                                                    $.each(data_phuong.data,
                                                        function(key_phuong,
                                                            val_phuong) {
                                                            $("#ward").append(
                                                                '<option value="' +
                                                                val_phuong
                                                                .full_name +
                                                                '">' +
                                                                val_phuong
                                                                .full_name +
                                                                '</option>');
                                                        });
                                                }
                                            });
                                    });

                                }
                            });
                        });

                    }
                });
            });
        </script>
    </section> <!--/#cart_items-->
@endsection
