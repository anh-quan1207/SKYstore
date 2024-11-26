@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/image-product.css') }}" rel="stylesheet" />

    <div class="container-redirect-common">
        <div class="redirect-common text-end">
            <a href="{{ route('admin-product-list') }}" class="btn btn-primary link-redirect-common"> DANH SÁCH SẢN
                PHẨM</a>
        </div>
        @if (!is_null($productId))
            <div class="redirect-common text-end">
            <a href="{{ route('admin-product-image-form', ['id' => $productId]) }}" class="btn btn-primary link-redirect-common"><i
                    class="fa-solid fa-circle-plus"></i> THÊM HÌNH ẢNH</a>
        </div>
        @endif
    </div>

    @if(!is_null($productId))
    <div class="gallery">
        <h2 class="w3ls_head">HÌNH ẢNH SẢN PHẨM</h2>
        <div class="gallery-grids">
            <div class="gallery-top-grids">
                @if (!is_null($images))
                    @foreach ($images as $image)
                        <div class="col-sm-4 gallery-grids-left">
                            <div class="gallery-grid">
                                <a class="example-image-link"  data-lightbox="example-set"
                                    data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae cursus ligula">
                                    <img src="{{ asset('image/' . $image->image_path) }}" alt="" />
                                </a>
                                <form action="{{ route('admin-image-delete', ['id' => $image->id]) }}" method="POST"
                                    style="display:inline; margin-right: 12px;" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Xóa hình ảnh"
                                        style="border: none; background: none; cursor: pointer; padding:0;"
                                        class="btn-delete">
                                        <i class="fa fa-times del"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    @else
        @include('no-data')
    @endif
    <script>
        $(document).ready(function() {
            $('.btn-delete').on('click', function(e) {
                console.log(1);
                e.preventDefault();
                var confirmed = confirm("Bạn có chắc chắn muốn xóa hình này?");
                if (confirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
@endsection
