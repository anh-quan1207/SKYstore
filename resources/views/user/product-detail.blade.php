@extends('user/layouts/layout')
@section('content')
    <link href="{{ asset('frontend/css/product-detail.css') }}" rel="stylesheet" />
    <style>
        .quantity-error {
            display: none;
            margin-top: 24px;
        }

        .product-information .color-active,
        .product-information .size-active {
            border: 1px solid #fcf0f0;
            BACKGROUND: #fcf0f0;
        }

        .breadcrumbs .breadcrumb {
            margin-bottom: 10px !important;
        }

        .landing {
            color: #686363;
        }

        .active a {
            background: #fff !important;
            color: #000 !important;
            padding: 0 !important;
        }
    </style>
    <section>
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home_page_user') }}">Trang chủ</a></li>
                    <li class="active"><a
                            href="{{ route('products-by-parent-category', ['parent_category' => $parentCategoryParam]) }}">{{ $parentCategoryName }}
                        </a>
                    </li>
                    <span class="active"> <i style="padding: 0 6px;" class="fa-solid fa-angle-right"></i> </span>
                    <li class="active"><a href="{{ route('products-by-category', ['id' => $product->category->id]) }}">
                            {{ $product->category->name }}
                        </a>
                    </li>
                    <span class="active"> <i style="padding: 0 6px;" class="fa-solid fa-angle-right"></i> </span>
                    <li class="landing">{{ $product->name }}</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-sm-12 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <div id="similar-product" class="carousel slide" data-ride="carousel" data-interval="false">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner image-product">
                                        @if (isset($imageProducts))
                                            <div class="item active">
                                                <a href=""><img
                                                        src="{{ asset('/image/' . $product->imageProducts()->first()->image_path) }}"
                                                        alt=""></a>
                                            </div>
                                            @foreach ($imageProducts as $imageProduct)
                                                <div class="item">
                                                    <a href=""><img
                                                            src="{{ asset('/image/' . $imageProduct->image_path) }}"
                                                            alt=""></a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <!-- Controls -->
                                    <a class="left item-control" href="#similar-product" data-slide="prev">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="right item-control" href="#similar-product" data-slide="next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner ">
                                    <div class="item active">
                                        <div class="item active">
                                            @if (isset($imageProducts))
                                                <a href=""><img style="width: 85px;height:85px; margin-bottom: 12px"
                                                        src="{{ asset('/image/' . $product->imageProducts()->first()->image_path) }}"
                                                        alt=""></a>
                                                @foreach ($imageProducts as $imageProduct)
                                                    <a href=""><img
                                                            style="width: 85px;height:85px; margin-bottom: 12px"
                                                            src="{{ asset('/image/' . $imageProduct->image_path) }}"
                                                            alt=""></a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <form id="product-information" action="" method="POST">
                                    @csrf
                                    <input id="product-variant-id" type="hidden" name="productVariantId" value="">
                                    <div class="product-information"><!--/product-information-->
                                        <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                        <h2>{{ $product->name }}</h2>
                                        <div class="price">
                                            @if ($product->discount != 0)
                                                <span class="price-origin">₫{{ priceFormat($product->price) }}</span>
                                            @endif
                                            <span
                                                class="price-sale mx-2">₫{{ priceFormat(priceDiscount($product->price, $product->discount)) }}</span>
                                        </div>
                                        <p style="font-size: 20px; margin-top: 12px;">
                                            <span class="sold-quantity"
                                                data-soldQuantity="{{ $product->sold_quantity }}">Đã
                                                bán:
                                                <strong>{{ $product->sold_quantity }}</strong></span> | <span
                                                class="remain-quantity"
                                                data-remain_quantity="{{ $product->remain_quantity }}">Còn
                                                lại:
                                                <strong>{{ $product->remain_quantity }}</strong></span>
                                        </p>
                                        <div class="row color">
                                            <div class="col-sm-3 title">Màu</div>
                                            <div class="col-sm-9">
                                                @if (isset($colors))
                                                    <div class="row">
                                                        @foreach ($colors as $color)
                                                            <div class="col-sm-2 color-item"
                                                                data-product-id="{{ $product->id }}"
                                                                data-color="{{ $color }}">{{ $color }}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <span class="error color-error">Vui lòng chọn màu sắc!</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row size">
                                            <div class="col-sm-3 title">Size</div>
                                            <div class="col-sm-9">
                                                @if (isset($sizes))
                                                    <div class="row list-size">
                                                        @foreach ($sizes as $size)
                                                            <div class="col-sm-2 size-item">{{ $size }}</div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <span class="error size-error">Vui lòng chọn size!</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row quantity">
                                            <div class="col-sm-3 title">Số lượng</div>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="cart_quantity_button">
                                                        <a class="cart_quantity_down" href=""> - </a>
                                                        <input class="cart_quantity_input" type="text" name="quantity"
                                                            value="1" autocomplete="off" size="2">
                                                        <a class="cart_quantity_up" href=""> + </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <span class="error quantity-error">Vui lòng chọn phân loại sản
                                                        phẩm!</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <button id="addToCartBtn" type="button"
                                                    class="btn btn-fefault btn-cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    THÊM VÀO GIỎ HÀNG
                                                </button>
                                            </div>
                                            <div class="col-sm-4">
                                                <button id="checkoutBtn" type="button" class="btn btn-default btn-buy">
                                                    MUA NGAY
                                                </button>
                                            </div>
                                        </div>

                                    </div><!--/product-information-->
                                </form>
                            </div>

                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li><a href="#details" data-toggle="tab">MÔ TẢ CHI TIẾT</a></li>
                                <li class="active"><a href="#reviews" data-toggle="tab">ĐÁNH GIÁ (5)</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="details">
                                <div class="container">
                                    <h3>CHI TIẾT SẢN PHẨM</h3>
                                    <table class="table table-striped" style="max-width:60%">
                                        <thead>
                                            <tr>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>John</td>
                                                <td>Doe</td>

                                            </tr>
                                            <tr>
                                                <td>Mary</td>
                                                <td>Moe</td>

                                            </tr>
                                            <tr>
                                                <td>July</td>
                                                <td>Dooley</td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade active in" id="reviews">
                                <div class="col-sm-12 review-item">
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure
                                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur.</p>
                                </div>
                                <div class="col-sm-12 review-item">
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure
                                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur.</p>
                                </div>
                            </div>

                        </div>
                    </div><!--/category-tab-->

                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            let productVariantId = null;

            $('.cart_quantity_input').on('keypress', function(e) {
                let charCode = e.which;
                if (charCode < 48 || charCode > 57) {
                    e.preventDefault();
                }
            });

            $('.cart_quantity_input').on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            $('.cart_quantity_up').on('click', function(e) {
                e.preventDefault();
                let inputValue = parseInt($('.cart_quantity_input').val());
                let remainQuantity = $('.remain-quantity').data()['remain_quantity'];
                if (inputValue === remainQuantity) {
                    $('.cart_quantity_input').val(inputValue)
                } else {
                    $('.cart_quantity_input').val(++inputValue);
                }
            })

            $('.cart_quantity_down').on('click', function(e) {
                e.preventDefault();
                let inputValue = $('.cart_quantity_input').val();
                inputValue = (inputValue > 1) ? (--inputValue) : inputValue;
                $('.cart_quantity_input').val(inputValue);
            })

            // hàm xử lý khi nhập số lượng
            $('.cart_quantity_input').on('blur', function() {
                let inputValue = parseInt($('.cart_quantity_input').val());
                let remainQuantity = $('.remain-quantity').data()['remain_quantity'];
                console.log(colorItem);
                console.log(sizeItem);
                if (colorItem === null || sizeItem === null) {
                    $('.cart_quantity_input').val(1);
                } else {
                    if (Number.isNaN(inputValue)) {
                        $('.cart_quantity_input').val(1);
                    }

                    if (inputValue > remainQuantity) {
                        $('.cart_quantity_input').val(remainQuantity)
                    }

                    if (inputValue < 1) {
                        $('.cart_quantity_input').val(1);
                    }
                }

            });
            // Lấy dữ liệu khi chọn màu
            let colorItem = null;
            $('.color-item').on('click', function(e) {
                colorItem = $(this);
                $('.color-item').removeClass('color-active');
                $(this).addClass('color-active');

                let productId = $(this).data('product-id');
                let color = $(this).data('color');

                getImageAndSize(productId, color);
            });

            let sizeItem = null;
            $('.list-size').on('click', '.size-item', function(e) {
                if (colorItem !== null) {
                    $('.size-item').removeClass('size-active');
                    $(this).addClass('size-active');

                    let productId = colorItem.data('product-id');
                    let color = colorItem.data('color');
                    let size = $(this).data('size');
                    sizeItem = size;
                    getQuantity(productId, color, size);
                }
            });

            // hàm thay đổi image & size
            async function getImageAndSize(productId, color) {
                productVariantId = null;
                let url = "{{ route('get-image-and-size') }}";
                try {
                    let response = await axios.get(url, {
                        params: {
                            productId: productId,
                            color: color
                        }
                    });

                    let imageUrl = response.data.image;
                    let imageNewContent = `
                            <div class="item active">
                                <a href=""><img src="{{ asset('/image/${imageUrl}') }}" alt="""></a>
                            </div>
                        `;
                    let sizes = response.data.sizes;
                    let sizeNewContent = '';
                    let configuredSizes = @json($configuredSizes);
                    $.each(sizes, function(index, value) {
                        sizeNewContent += `
                                <div class="col-sm-2 size-item" data-size="${value}">${configuredSizes[value]}</div>
                        `;
                    });
                    $('.carousel-inner.image-product').html(imageNewContent);
                    $('.list-size').html(sizeNewContent);

                } catch (error) {
                    console.log(error);
                }
            }

            // hàm xử lý lấy số lượng 
            async function getQuantity(productId, color, size) {
                let url = "{{ route('get-quantity') }}";
                try {
                    let response = await axios.get(url, {
                        params: {
                            productId: productId,
                            color: color,
                            size: size
                        }
                    });
                    let productVariant = response.data.productVariant
                    let remainQuantity = productVariant['remain_quantity'];
                    let soldQuantity = productVariant['sold_quantity'];
                    productVariantId = productVariant['id'];
                    let newSoldQuantityHtml = `Đã bán: <strong>${soldQuantity}</strong></span>`;
                    let newRemainQuantityHtml = `Còn lại: <strong>${remainQuantity}</strong>`;
                    $('.sold-quantity').html(newSoldQuantityHtml);
                    $('.remain-quantity').html(newRemainQuantityHtml);
                    $('.remain-quantity').data('remain_quantity', remainQuantity);
                } catch (error) {
                    console.log(error);
                }
            }

            // hàm xử lý khi submit form
            $('#addToCartBtn').on('click', function() {
                if (productVariantId === null) {
                    $('.quantity-error').show();
                } else {
                    $('.quantity-error').hide();
                    let addToCartUrl = "{{ route('user-add-to-cart') }}";
                    console.log(addToCartUrl);
                    $('#product-information').attr('action', addToCartUrl);
                    $('#product-variant-id').val(productVariantId);
                    $('#product-information').submit();
                }

            });

            $('#checkoutBtn').on('click', function() {
                if (productVariantId === null) {
                    $('.quantity-error').show();
                } else {
                    let handleCheckoutUrl = "{{ route('user-handle-pay') }}";
                    $('#product-information').attr('action', handleCheckoutUrl);
                    $('#product-variant-id').val(productVariantId);
                    $('#product-information').submit();
                }
            });
        });
    </script>
@endsection
