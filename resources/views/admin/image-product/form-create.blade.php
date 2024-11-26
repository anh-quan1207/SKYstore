@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/create-product.css') }}" rel="stylesheet" />

    <div class="redirect-common text-end">
        <a href="{{ route('admin-product-list') }}" class="btn btn-primary link-redirect-common">DANH SÁCH HÌNH ẢNH</a>
    </div>
    <div class="row mt-form-common">
        <div class="col-lg-12">
            @if (!is_null($productId))
                <section class="panel">
                    <header class="panel-heading heading-form-common">
                        Thêm Hình ảnh
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="cmxform form-horizontal" id="" method="post"
                                action="{{ route('admin-product-image-create', ['id' => $productId]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="images" class="control-label col-lg-12">Hình ảnh</label>
                                    <div class="col-lg-12">
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-4 imgUp">
                                                <div class="imagePreview"></div>
                                                <label class="btn btn-primary btn-label">
                                                    Upload<input type="file" name="images[]" class="uploadFile img"
                                                        value="Upload Photo"
                                                        style="width: 0px; height: 0px; overflow: hidden;">
                                                </label>
                                            </div>
                                            <i class="fa fa-plus imgAdd"></i>
                                        </div>
                                        @error('images.*')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12 text-center mt-12">
                                        <button class="btn btn-primary" type="submit">Lưu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            @else
                @include('no-data');
            @endif
        </div>
    </div>

    <script>
        $(".imgAdd").click(function() {
            $(this).closest(".row").find('.imgAdd').before(
                '<div class="col-sm-4 imgUp"><div class="imagePreview"></div><label class="btn btn-primary btn-label">Upload<input type="file" name="images[]" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>'
            );
        });

        $(document).on("click", "i.del", function() {
            // Remove the image upload card
            $(this).parent().remove();
        });

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
