@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/create-voucher.css') }}" rel="stylesheet" />

    <div class="redirect-common text-end">
        <a href="{{ route('admin-voucher-list') }}" class="btn btn-primary link-redirect-common">DANH SÁCH VOUCHER</a>
    </div>
    <div class="row mt-form-common">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading heading-form-common">
                    Thêm VOUCHER
                </header>
                <div class="panel-body">
                    <div class="form">
                        <form class="cmxform form-horizontal" id="" method="post"
                            action="{{ route('admin-voucher-create') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="control-label col-lg-12">Tiêu đề <span
                                        style="color: red">*</span></label>
                                <div class="col-lg-12">
                                    <input class="form-control" id="title" name="title" type="text" required
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="voucher_type" class="control-label col-lg-12">Loại voucher <span
                                        style="color: red">*</span></label>
                                <div class="col-lg-7">
                                    <select class="form-control" id="voucher_type" required name="voucher_type">
                                        @if (isset($voucherTypeArray))
                                            @foreach ($voucherTypeArray as $key => $voucherType)
                                                <option value="{{ $key }}">{{ $voucherType }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('voucher_type')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="control-label col-lg-12">Số lượng voucher <span
                                        style="color: red">*</span></label>
                                <div class="col-lg-7">
                                    <input class="form-control" id="quantity" name="quantity" type="number"
                                        min="0" value="{{ old('quantity') }}" required>
                                    @error('quantity')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="value" class="control-label col-lg-12">Giá trị voucher(%)<span
                                                style="color: red">*</span></label></label>
                                <div class="col-lg-7">
                                    <input class="form-control" id="value" name="value" type="number" min="0"
                                        max="100" value="{{ old('value') }}" required>
                                    @error('value')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="start_date" class="control-label col-lg-12">Ngày bắt đầu <span
                                                style="color: red">*</span></label>
                                        <div class="col-lg-9">
                                            <input class="form-control" id="start_date" name="start_date"
                                                type="date" min="0" value="{{ old('start_date') }}"
                                                required>
                                            @error('start_date')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <label for="end_date" class="control-label col-lg-12">Ngày kết thúc <span
                                                style="color: red">*</span></label>
                                        <div class="col-lg-9">
                                            <input class="form-control" id="end_date" name="end_date"
                                                type="date" min="0" value="{{ old('end_date') }}"
                                                required>
                                            @error('end_date')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12 text-center mt-20">
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
