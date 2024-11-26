@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/create-product-variant.css') }}" rel="stylesheet" />

    <div class="redirect-common text-end">
        <a href="{{ route('admin-product-variant-list', ['id' => $productId]) }}" class="btn btn-primary link-redirect-common">DANH SÁCH BIẾN THỂ</a>
    </div>
    <div class="row mt-form-common">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading heading-form-common">
                    Sửa Biến Thể
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form class="cmxform form-horizontal" id="" method="post"
                            action="{{ route('admin-product-variant-update', ['id' => $productId,'product_variant_id' => $productVariant->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="remain_quantity" class="control-label col-lg-12">Số lượng còn lại <span
                                        style="color: red">*</span></label>
                                <div class="col-lg-9">
                                    <input class="form-control" id="remain_quantity" name="remain_quantity" type="number"
                                        min="0" value="{{ $productVariant->remain_quantity }}" required>
                                    @error('remain_quantity')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="control-label col-lg-12">Hình ảnh</label>
                                <div class="col-lg-12">
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-4 imgUp">
                                            <div class="imagePreview"></div>
                                            <label class="btn btn-primary btn-label">
                                                Upload<input type="file" name="image" class="uploadFile img"
                                                    value="Upload Photo" style="width: 0px; height: 0px; overflow: hidden;">
                                            </label>
                                        </div>
                                    </div>
                                    @error('image')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 text-center mt-12">
                                    <button class="btn btn-primary" type="submit">Lưu</button>
                                    <button class="btn btn-default" type="reset">Xóa</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        $(function() {
            $(document).on("change", ".uploadFile", function() {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // No file selected or no FileReader support

                if (/^image/.test(files[0].type)) { // Only image files
                    var reader = new FileReader(); // Instance of FileReader
                    reader.readAsDataURL(files[0]); // Read the local file

                    reader.onloadend = function() { // Set image data as background of div
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image",
                            "url(" + this.result + ")");
                    }
                }
            });
        });
    </script>
@endsection
