@extends('user/layouts/layout')
@section('content')
    <style>
        .product-image-wrapper {
            border-radius: 0;
        }

        .product-image-wrapper:hover {
            border: 2px solid #F89F53;
            cursor: pointer
        }

        .discount {
            font-size: 14px;
            font-weight: 400;
            background-color: antiquewhite;
            margin-left: 12px;
        }

        .productinfo h2 {
            color: #f89f53;
            font-size: 18px;
            margin-top: 0px;
            padding-left: 12px;
        }

        .productinfo .product-name {
            font-family: 'Roboto', sans-serif;
            font-size: 15px;
            font-weight: 500;
            color: #575050;
            margin-top: 22px;
            padding-left: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .productinfo .sold-quantity {
            padding-left: 12px;
            margin-top: 7px;
            font-size: 14px;
            font-weight: 400;
        }

        .single-products a {
            text-decoration: none;
        }
    </style>
    <section>
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home_page_user') }}">Trang chủ</a></li>
                    <li class="active">{{ $parentCategoryName }}</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>DANH MỤC</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @if (isset($categories) && !$categories->isEmpty())
                                @foreach ($categories as $category)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a href="{{ route('products-by-category', ['id' => $category->id]) }}">
                                                    <span data-toggle="collapse" data-parent="#accordian"
                                                        href="#{{ $category->name }}" class="badge pull-right">
                                                        {{-- <i class="fa fa-plus"></i> --}}
                                                    </span>
                                                    {{ $category->name }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div><!--/category-products-->
                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
                        </div><!--/shipping-->

                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{ asset('frontend/images/home/banner-2.jpg') }}" alt="" />
                        </div><!--/shipping-->

                        {{-- <div class="shipping text-center"><!--shipping-->
                            <img src="{{ asset('frontend/images/home/banner-3.jpg') }}" alt="" />
                        </div><!--/shipping--> --}}
                    </div>
                </div>
                <div class="col-sm-9 padding-right">
                    {{--  @yield('content')  --}}
                    <!--features_items-->
                    <div class="features_items">
                        <h2 class="title text-center">DANH SÁCH SẢN PHẨM</h2>
                        @if (isset($products))
                            @foreach ($products as $product)
                                @php
                                    $productVariant = $product->productVariants()->first();
                                @endphp
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <a href="{{ route('product-detail', ['id' => $product->id]) }}">
                                                <div class="productinfo">
                                                    <img src="{{ asset('image/' . $product->imageProducts()->first()->image_path) }}"
                                                        alt="" />
                                                    <p class="product-name">{{ $product->name }}</p>
                                                    <h2>{{ priceFormat(priceDiscount($product->price, $product->discount)) }}đ
                                                        @if ($product->discount > 0)
                                                            <span class="discount">-{{ $product->discount }}%</span>
                                                        @endif
                                                    </h2>
                                                    <p class="sold-quantity">Đã bán {{ $product->sold_quantity }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @if (isset($products))
                        {{ $products->links() }}
                    @endif
                    <!--features_items-->
                    <!--/recommended_items-->
                </div>
            </div>
        </div>
    </section>
@endsection
