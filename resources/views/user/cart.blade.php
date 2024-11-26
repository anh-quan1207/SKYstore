@extends('user/layouts/layout')
@php
    use App\Models\ProductVariant;
@endphp
@section('content')
    <script src="https://esgoo.net/scripts/jquery.js"></script>
    <style>
        .cart_menu {
            height: 70px !important;
        }

        .cart_menu td {
            text-align: center
        }

        tbody td {
            text-align: center
        }

        .cart_quantity {
            position: relative;
        }

        .cart_quantity_button {
            display: block;
            position: absolute;
            top: 50%;
            left: 14%;
            transform: translateY(-50%);
            width: 100%;
        }

        .card {
            border-radius: 12px;
            border: 1px solid #ccc;
            padding: 12px;
            margin-bottom: 26px;
        }

        .btn-block {
            border-radius: 10px !important;
            background: crimson !important;
        }

        #cart_items .cart_quantity_button a {
            background: #F0F0E9;
            color: #696763;
            display: inline-block;
            font-size: 16px;
            overflow: hidden;
            text-align: center;
            width: 35px;
            padding: 4px 0;
            height: auto;
            text-decoration: none;
        }

        #cart_items .cart_quantity_input {
            padding: 4px 0;
            min-width: 70px;
            font-size: 14px;
        }

        .cart_quantity_input {
            border: 2px solid #ccc;
        }

        #checkoutLink {
            text-decoration: none;
        }


        .swal2-popup {
            width: 500px;
        }

        div:where(.swal2-container) .swal2-html-container {
            font-size: 20px;
        }

        .swal2-actions {
            font-size: 14px;
        }

        button.swal2-confirm.swal2-styled {
            padding: 8px 70px;
        }
    </style>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home_page_user') }}">Trang chủ</a></li>
                    <li class="active">GIỎ HÀNG</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td></td>
                            <td class="image">HÌNH ẢNH</td>
                            <td class="description">TÊN SẢN PHẨM</td>
                            <td class="price">GIÁ</td>
                            <td class="quantity">SỐ LƯỢNG</td>
                            <td class="total">TỔNG TIỀN</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($carts))
                            @foreach ($carts as $cart)
                                <tr>
                                    <td><input class="select-cart" type="checkbox" name="select_cart[]"
                                            value="{{ $cart->id }}" />
                                    </td>
                                    <td class="cart_product">
                                        <a
                                            href="{{ route('product-detail', ['id' => $cart->productVariant->product->id]) }}">
                                            <img style="width: 80px; height: 80px;"
                                                src="{{ asset('/image/' . $cart->productVariant->image_path) }}"
                                                alt="">
                                        </a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="">{{ $cart->productVariant->product->name }}</a></h4>
                                        <p>{{ $cart->productVariant->color . ', ' . renderSize($cart->productVariant->size) }}
                                        </p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{ priceFormat(priceDiscount($cart->productVariant->product->price, $cart->productVariant->product->discount)) }}
                                        </p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <a class="cart_quantity_down" data-id="{{ $cart->id }}"
                                                data-product_variant_id="{{ $cart->product_variant_id }}" href=""> -
                                            </a>
                                            <input id="cart_quantity_input_{{ $cart->id }}" class="cart_quantity_input"
                                                data-id="{{ $cart->id }}"
                                                data-product_variant_id="{{ $cart->product_variant_id }}" type="text"
                                                name="quantity" value="{{ $cart->quantity }}" autocomplete="off"
                                                size="2">
                                            <a class="cart_quantity_up" data-id="{{ $cart->id }}"
                                                data-product_variant_id="{{ $cart->product_variant_id }}" href=""> +
                                            </a>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price_{{ $cart->id }}"
                                            data-total_amount="{{ priceDiscount($cart->productVariant->product->price, $cart->productVariant->product->discount) * $cart->quantity }}">
                                            {{ priceFormat(priceDiscount($cart->productVariant->product->price, $cart->productVariant->product->discount) * $cart->quantity) }}
                                        </p>
                                    </td>
                                    <td class="cart_delete">
                                        <form action="{{ route('delete-cart-item', ['id' => $cart->id]) }}" method="POST"
                                            style="display:inline; margin-right: 12px;">
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
            <div class="row">
                <div class="col-md-9">
                </div>
                <div class="col-md-3 mb-5">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h4 class="mb-0">HÓA ĐƠN</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    TỔNG ĐƠN HÀNG |
                                    <span class="quantity-product"><strong>{{ 0 }}</strong></span> LOẠI SẢN
                                    PHẨM
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>TỔNG TIỀN ĐƠN ĐẶT HÀNG</strong>
                                    </div>
                                    <span style="color: #f32f2f" id="total"><strong>{{ 0 }}
                                            VND</strong></span>
                                </li>
                            </ul>

                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-lg btn-block" id="checkoutBtn">
                                <a style="color: #fff" href="{{ route('user-pay') }}" id="checkoutLink"> THANH TOÁN</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!--/#cart_items-->
    <script>
        $(document).ready(function() {
            $('.cart_quantity_input').on('keypress', function(e) {
                let charCode = e.which;
                if (charCode < 48 || charCode > 57) {
                    e.preventDefault();
                }
            });

            $('.cart_quantity_input').on('input', function(e) {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            $('.cart_quantity_up').on('click', async function(e) {
                e.preventDefault();
                let id = $(this).data("id");
                let productVariantId = $(this).data("product_variant_id");
                let remainQuantity = await getQuantity(productVariantId);
                let inputValue = parseInt($("#cart_quantity_input_" + id).val());
                if (inputValue >= remainQuantity) {
                    $("#cart_quantity_input_" + id).val(inputValue);
                } else {
                    $("#cart_quantity_input_" + id).val(++inputValue);
                }

                getNewValue(id, inputValue);
            })

            $('.cart_quantity_down').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data("id");
                let inputValue = parseInt($("#cart_quantity_input_" + id).val());
                inputValue = (inputValue > 1) ? (--inputValue) : inputValue;
                $("#cart_quantity_input_" + id).val(inputValue);

                getNewValue(id, inputValue);
            })

            $('.cart_quantity_input').on('blur', async function(e) {
                let id = $(this).data("id");
                let productVariantId = $(this).data("product_variant_id");
                let remainQuantity = await getQuantity(productVariantId);
                let inputValue = parseInt($("#cart_quantity_input_" + id).val());

                if (Number.isNaN(inputValue)) {
                    $("#cart_quantity_input_" + id).val(1);
                }
                if (inputValue > remainQuantity) {
                    $("#cart_quantity_input_" + id).val(remainQuantity);
                }

                getNewValue(id, inputValue);

            });

            async function getQuantity(productVariantId) {
                let url = "{{ route('get-remain-quantity') }}";
                try {
                    let response = await axios.get(url, {
                        params: {
                            productVariantId: productVariantId,
                        }
                    });
                    let remainQuantity = response.data.remainQuantity;
                    return remainQuantity;
                } catch (error) {
                    console.log(error);
                }
            }

            async function getNewValue(cartId, quantity) {
                let url = "{{ route('get-new-value') }}";
                try {
                    let response = await axios.get(url, {
                        params: {
                            id: cartId,
                            quantity: quantity
                        }
                    });
                    let quantityNew = response.data.quantity;
                    let total_amount = response.data.total_amount;
                    let total = response.data.total;
                    $("#cart_quantity_input_" + cartId).val(quantityNew);
                    $(`.cart_total_price_${cartId}`).html(formatNumber(total_amount));
                    $(`.cart_total_price_${cartId}`).data('total_amount', total_amount);

                    if (selectCart.length > 0) {
                        totalChange = 0;
                        selectCart.forEach(element => {
                            totalChange += $(`.cart_total_price_${element}`).data('total_amount');
                        });
                        $('#total').html(`<strong>${formatNumber(totalChange)}
                                            VND</strong>`);
                    } else {

                    }

                } catch (error) {
                    console.log(error);
                }
            }

            function formatNumber(number) {
                let roundedNumber = Math.round(number);
                return roundedNumber.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // xử lý khi chọn ô checkbox
            let selectCart = [];
            let totalChange = 0;
            $('.select-cart').change(function() {
                const value = $(this).val();
                let count = 0;
                if ($(this).is(':checked')) {
                    selectCart.push(value);
                    totalChange += $(`.cart_total_price_${value}`).data('total_amount');
                    console.log(totalChange);
                } else {
                    selectCart = selectCart.filter(item => item !== value);
                    totalChange -= $(`.cart_total_price_${value}`).data('total_amount');
                }
                count = selectCart.length;
                $('#total').html(`<strong>${formatNumber(totalChange)}
                    VND</strong>`);
                $('.quantity-product').html(`<strong>${count}</strong>`);
            });

            // xử lý khi bấm nút thanh toán 
            $('#checkoutBtn').on('click', function(event) {
                const checkoutUrl =
                    "{{ route('handle-checkout-by-cart', ['cartIds' => '__CART_IDS__']) }}";
                event.preventDefault();
                console.log(selectCart.length);
                if (selectCart.length > 0) {
                    const url = checkoutUrl.replace('__CART_IDS__', selectCart);
                    window.location.href = url;
                } else {
                    Swal.fire({
                        text: 'Bạn chưa chọn sản phẩm nào!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

        $(document).ready(function() {
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    text: "Bạn có chắc chắn xóa sản phẩm này?",
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
