@extends('user/layouts/layout')

@section('content')
    <section id="slider"><!--slider-->
        <style>
            header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 1000;
                background-color: white;
            }

            #slider {
                padding-bottom: 0;
            }

            #footer {
                margin-top: 0;
            }

            .control-carousel {
                position: absolute;
                top: 50%;
                font-size: 60px;
                color: #C2C2C1;
                transform: translateY(-50%);
            }

            .right.control-carousel i {
                padding-right: 20px;
            }

            .left.control-carousel i {
                padding-left: 20px;
            }

            .item {
                position: relative;
            }

            .item.active .content-slider {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%)
            }
        </style>


        @php
            $sliderContents = [
                [
                    'title' => 'KAWS + Andy Warhol',
                    'description' => 'Sự hợp tác chưa từng có giữa hai nghệ sĩ hàng đầu của thời đại',
                ],
                ['title' => 'PHONG CÁCH THỜI TRANG', 'description' => 'SỰ KẾT HỢP HOÀN HẢO GIỮA CÁ TÍNH VÀ TIỆN ÍCH'],
                ['title' => 'SUMMER COLLECTION', 'description' => 'MÁT MẺ VÀ PHONG CÁCH'],
                ['title' => 'PHONG CÁCH VINTAGE', 'description' => 'KẾT HỢP HOÀN HẢO GIỮA CỔ ĐIỂN VÀ HIỆN ĐẠI'],
                ['title' => 'BST SPORT UTILITY WEAR', 'description' => 'THOẢI MÁI TRONG MỌI CHUYỂN ĐỘNG'],
                ['title' => 'WINTER COLLECTION', 'description' => 'GIỮ ẤM CÙNG PHONG CÁCH'],
            ];
        @endphp
        <div class="container-flush">
            <div class="col-sm-12" style="height: 100%; padding: 0">
                <div id="slider-carousel" class="carousel slide" style="height: 100%" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for ($i = 0; $i < 6; $i++)
                            <li data-target="#slider-carousel" data-slide-to="{{ $i }}"
                                class="{{ $i == 0 ? 'active' : '' }}"></li>
                        @endfor
                    </ol>

                    <div class="carousel-inner" style="height: 100%">
                        @foreach (['slider1', 'slider2', 'slider3', 'slider4', 'slider5', 'slider6'] as $index => $image)
                            <div class="item {{ $index == 0 ? 'active' : '' }}" style="height: 100%; padding: 0">
                                <div class="row">
                                    <div class="col-sm-12" style="height: 100%; padding: 0">
                                        <img src="{{ 'frontend/images/home/' . $image . '.jpg' }}"
                                            class="girl img-responsive" alt=""
                                            style="width: 100%; height: 100%; object-fit: cover;" />
                                    </div>
                                    <div class="content-slider container">
                                        <h1 style="color: #FFFFFF; margin-top: 0">{{ $sliderContents[$index]['title'] }}
                                        </h1>
                                        <p style="color: #FFFFFF">{{ $sliderContents[$index]['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
    </section><!--/slider-->
    <script>
        $(document).ready(function() {
            var headerHeight = $('header').outerHeight();
            var footerHeight = $('footer').outerHeight();
            $('.container-flush').css('height', `calc(100vh - ${headerHeight}px)`);
            $('body').css('padding-top', `${headerHeight}px`);
        });
    </script>
@endsection
