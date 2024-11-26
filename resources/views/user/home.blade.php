@extends('user/layouts/layout')
@section('content')
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ 'frontend/images/home/girl1.jpg' }}" class="girl img-responsive"
                                        alt="" />
                                
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>100% Responsive Design</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ 'frontend/images/home/girl2.jpg' }}" class="girl img-responsive"
                                        alt="" />
                                
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free Ecommerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ 'frontend/images/home/girl3.jpg' }}" class="girl img-responsive"
                                        alt="" />
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free Ecommerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ 'frontend/images/home/s1.jpg' }}" class="girl img-responsive"
                                        alt="" />
                                
                                </div>
                            </div>

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 padding-right">
                    {{--  @yield('content')  --}}
                    <!--features_items-->
                    <div class="features_items">
                        <h2 class="title text-center">SẢN PHẨM NỔI BẬT</h2>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product1.jpg' }}" alt="" />
                                        <p>Áo thun nam 3 lớp</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product2.jpg' }}" alt="" />
                                        <p>Easy Polo Black Edition</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                         <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product2.jpg' }}" alt="" />
                                        <p>Easy Polo Black Edition</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                         <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product2.jpg' }}" alt="" />
                                        <p>Easy Polo Black Edition</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product3.jpg' }}" alt="" />
                                        <p>Easy Polo Black Edition</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product4.jpg' }}" alt="" />
                                        <p>Easy Polo Black Edition</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                    <img src="{{ 'frontend/images/home/new.png' }}" class="new" alt="" />
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product5.jpg' }}" alt="" />
                                        <p>Áo thun cao cổ dài tay đủ mau</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                    <img src="{{ 'frontend/images/home/sale.png' }}" class="new" alt="" />
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product6.jpg' }}" alt="" />
                                        <h2>12.000.000</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                    <!--features_items-->

                    <!--recommended_items-->
                    <div class="features_items">
                        <h2 class="title text-center">SẢN PHẨM GIẢM GIÁ</h2>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product1.jpg' }}" alt="" />
                                        <p>Áo thun nam 3 lớp</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product2.jpg' }}" alt="" />
                                        <p>Easy Polo Black Edition</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                         <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product2.jpg' }}" alt="" />
                                        <p>Easy Polo Black Edition</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                         <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product2.jpg' }}" alt="" />
                                        <p>Easy Polo Black Edition</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product3.jpg' }}" alt="" />
                                        <p>Easy Polo Black Edition</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product4.jpg' }}" alt="" />
                                        <p>Easy Polo Black Edition</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                    <img src="{{ 'frontend/images/home/new.png' }}" class="new" alt="" />
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product5.jpg' }}" alt="" />
                                        <p>Áo thun cao cổ dài tay đủ mau</p>
                                        <h2>1.200.000đ</h2>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                    <img src="{{ 'frontend/images/home/sale.png' }}" class="new" alt="" />
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo">
                                        <img src="{{ 'frontend/images/home/product6.jpg' }}" alt="" />
                                        <h2>12.000.000</h2>
                                        <p>Easy Polo Black Edition</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                    <!--recommended_items-->

                </div>
            </div>
        </div>
    </section>
@endsection
