@extends('admin/layouts/layout')
@section('admin-content')
    <link href="{{ asset('admin/css/create-product.css') }}" rel="stylesheet" />

    <div class="redirect-common text-end">
        <a href="{{ route('admin-product-list') }}" class="btn btn-primary link-redirect-common">DANH SÁCH SẢN PHẨM</a>
    </div>
    <div class="row mt-form-common">
        @if (isset($product))
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading heading-form-common">
                        Sửa Sản Phẩm
                    </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="cmxform form-horizontal" id="" method="post"
                                action="{{ route('admin-product-update') }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="cname" class="control-label col-lg-12">Tên sản phẩm</label>
                                    <div class="col-lg-12">
                                        <input class="form-control" id="cname" name="name" type="text" required
                                            value="{{ $product->name }}">
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category" class="control-label col-lg-12">Danh mục</label>
                                    <div class="col-lg-7">
                                        <select class="form-control" id="category" required name="category_id">
                                            @if (isset($categories))
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($category->id == $product->category_id) selected @endif>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('category_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="control-label col-lg-12">Mô tả</label>
                                    <div class="col-lg-12">
                                        <textarea name="description" rows="3" class="form-control">{{ $product->description }}</textarea>
                                        @error('description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price" class="control-label col-lg-12">Giá <span
                                            style="color: red">*</span></label>
                                    <div class="col-lg-12">
                                        <input class="form-control" id="price" name="price" type="number"
                                            min="0" value="{{ $product->price }}">
                                        @error('price')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="discount" class="control-label col-lg-12">Giảm giá(%)</label>
                                    <div class="col-lg-7">
                                        <input class="form-control" id="discount" name="discount" type="number"
                                            min="0" max="100" value="{{ $product->discount }}">
                                        @error('discount')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="product_variant" class="control-label col-lg-12">Biến thể sản phẩm mặc
                                        định</label>
                                    <div class="col-lg-12">
                                        <select class="form-control" id="product_variant" required
                                            name="default_product_variant_id">
                                            @if (isset($productVariants))
                                                @foreach ($productVariants as $productVariant)
                                                    <option value="{{ $productVariant->id }}"
                                                        @if ($productVariant->id == $product->default_product_variant_id) selected @endif>
                                                        {{ $productVariant->name }},
                                                        {{ $productVariant->color }}-{{ $productVariant->size }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="0">Không có biến thể sản phẩm</option>
                                            @endif
                                        </select>
                                        @error('default_product_variant_id')
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
        @else
            @include('no-data')
        @endif
    </div>
@endsection
