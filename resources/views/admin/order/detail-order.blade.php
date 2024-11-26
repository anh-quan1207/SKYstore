@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/customer.css') }}" rel="stylesheet" />
    <style>
        .heading-order-detail {
            margin-bottom: 20px;
            font-size: 20px;
        }
    </style>
    <div class="redirect-common text-end">
        <a href="{{ route('admin-order-list') }}" class="btn btn-primary link-redirect-common">DANH SÁCH ĐƠN HÀNG</a>
    </div>
    <div class="table-agile-info">
        <h3 class="heading-order-detail">CHI TIẾT ĐƠN HÀNG</h3>
        <div class="panel panel-default">
            {{-- TABLE --}}
            @if (isset($orderLines))
                <div class="table-responsive">
                    <table class="table text-center table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Loại</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Đơn giá(đ)</th>
                            </tr>
                        </thead>
                        @foreach ($orderLines as $orderLine)
                            <tr>
                                <td class="max-width: 100px"><span
                                        class="text-ellipsis">{{ $orderLine->productVariantWithTrashed->productWithTrashed->name }}</span>
                                </td>
                                <td><span class="text-ellipsis">{{ $orderLine->productVariantWithTrashed->color }},
                                        {{ $size[$orderLine->productVariantWithTrashed->size] }}</span></td>
                                <td><span class="text-ellipsis">{{ $orderLine->quantity }}</span></td>
                                <td><span class="text-ellipsis">{{ number_format($orderLine->price, 0, ',', '.') }}</span>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-ellipsis" colspan="3"><strong>Giảm giá</strong></td>
                            <td class="text-ellipsis">{{ number_format($discount, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-ellipsis" colspan="3"><strong>Tổng Hóa Đơn</strong></td>
                            <td class="text-ellipsis">{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="table-agile-info">
        <h3 class="heading-order-detail">THÔNG TIN THANH TOÁN</h3>
        <div class="panel panel-default">
            {{-- TABLE --}}
            @if (isset($pay))
                <div class="table-responsive">
                    <table class="table  table-bordered">
                        <tr>
                            <td><span class="text-ellipsis"><strong>Họ Tên Người Nhận Hàng</strong></span>
                            </td>
                            <td><span class="text-ellipsis">{{ $pay->customer_name }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="text-ellipsis"><strong>Số Điện Thoại</strong></span>
                            </td>
                            <td><span class="text-ellipsis">{{ $pay->customer_phone }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="text-ellipsis"><strong>Địa chỉ Nhận Hàng</strong></span>
                            </td>
                            <td><span class="text-ellipsis">{{ $pay->shipping_customer }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="text-ellipsis"><strong>Hình Thức Thanh Toán</strong></span>
                            </td>
                            <td><span class="text-ellipsis">{{ $paymentTypes[$pay->payments] }}</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.btn-update-confirm').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Xác nhận đơn hàng',
                    text: "Bạn có chắc chắn xác nhận đơn hàng này?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            $('.btn-update-ship').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Chuyển trạng thái đơn hàng',
                    text: "Bạn có chắc chắn muốn chuyển trạng thái đơn hàng sang đang giao hàng không?",
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
