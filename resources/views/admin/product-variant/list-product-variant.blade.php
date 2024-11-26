@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/product-variant.css') }}" rel="stylesheet" />

    <div class="container-redirect-common">
        <div class="redirect-common text-end">
            <a href="{{ route('admin-product-list') }}" class="btn btn-primary link-redirect-common"> DANH SÁCH SẢN
                PHẨM</a>
        </div>
        <div class="redirect-common text-end">
            <a href="{{ route('admin-product-variant-form-create', ['id' => $productId]) }}"
                class="btn btn-primary link-redirect-common"><i class="fa-solid fa-circle-plus"></i> THÊM BIẾN THỂ</a>
        </div>
    </div>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh Sách Biến Thể
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
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Hình ảnh</th>
                            <th class="text-center">Đặc điểm</th>
                            <th class="text-center">Số lượng đã bán</th>
                            <th class="text-center">Số lượng còn lại</th>
                            <th class="text-center" style="">Tùy Chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!is_null($productVariants))
                            @foreach ($productVariants as $productVariant)
                                <tr>
                                    <td>{{ ++$increment }}</td>
                                    <td class="max-width: 100px">
                                        <img src="{{ asset('image/' . $productVariant->image_path) }}" alt="Ảnh"
                                            height="90px" width="90px">
                                    </td>
                                    <td><span
                                            class="text-ellipsis">{{ $productVariant->color . ', ' . $size[$productVariant->size] }}</span>
                                    </td>
                                    <td><span class="text-ellipsis">{{ $productVariant->sold_quantity }}</span></td>
                                    <td><span
                                            class="text-ellipsis">{{ number_format($productVariant->remain_quantity, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <a title="Sửa sản phẩm"
                                            href="{{ route('admin-product-variant-form-update', ['id' => $productId, 'product_variant_id' => $productVariant->id]) }}"
                                            style="margin-right: 12px"><i class="fa-regular fa-pen-to-square"
                                                style="color: #0c9636;"></i>
                                        </a>
                                        <form
                                            action="{{ route('admin-product-variant-delete', ['id' => $productId, 'product_variant_id' => $productVariant->id]) }}"
                                            method="POST" style="display:inline; margin-right: 12px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Xóa sản phẩm" class="btn-delete"
                                                style="border: none; background: none; cursor: pointer; padding:0;">
                                                <i class="fa-solid fa-trash" style="color: #E9423F;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    text: "Bạn có chắc chắn xóa biến thể này?",
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
