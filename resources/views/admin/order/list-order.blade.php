@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/order.css') }}" rel="stylesheet" />
    <style>

    </style>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh Sách Đơn Hàng
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
            {{-- TABLE --}}
            @if ($orders)
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Mã Đơn Hàng</th>
                                <th class="text-center">Tên Khách Hàng</th>
                                <th class="text-center">Ngày Đặt</th>
                                <th class="text-center">Trạng Thái</th>
                                <th class="text-center">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ ++$increment }}</td>
                                    <td><span class="text-ellipsis">{{ $order->order_code }}</span></td>
                                    <td class="max-width: 100px"><span
                                            class="text-ellipsis">{{ $order->customer->username }}</span>
                                    </td>
                                    <td><span class="text-ellipsis">{{ $order->created_at->format('d-m-Y H:i:s') }}</span>
                                    </td>
                                    <td><span class="text-ellipsis status"
                                            style="background-color: {{ $orderStatusColors[$order->status] }}">{{ $orderStatusArray[$order->status] }}</span>
                                    </td>
                                    <td>
                                        @if ($order->status == 1)
                                            <form action="{{ route('admin-order-update', ['id' => $order->id]) }}"
                                                method="POST" style="display:inline; margin-right: 12px;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" title="Xác nhận đơn hàng" class="btn-update-confirm"
                                                    style="border: none; background: none; cursor: pointer; padding:0;">
                                                    <i class="fa-solid fa-check" style="color: #0c9636;"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($order->status == 2)
                                            <form action="{{ route('admin-order-update', ['id' => $order->id]) }}"
                                                method="POST" style="display:inline; margin-right: 12px;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" title="Giao Hàng" class="btn-update-ship"
                                                    style="border: none; background: none; cursor: pointer; padding:0;">
                                                    <i class="fa-solid fa-truck-fast" style="color: #f17d1a;"></i></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a title="Chi Tiết Đơn Hàng"
                                            href="{{ route('admin-order-detail', ['id' => $order->id]) }}" class="ml-2"
                                            style="margin-right: 12px"><i class="fa-solid fa-circle-info"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links() }}
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
