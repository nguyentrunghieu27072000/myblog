<link rel="stylesheet" href="{{asset('css/store.css')}}"></link>
@extends('LayoutWeb/master')
@section('body')
<div style="height: 85px;background-color: #000;"></div>
<div class="header-top">
    <div class="swiper-container SwiperBanner">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
        <img src="{{asset('haircare/images/slideshow_2.jpg')}}" />
        </div>
        <div class="swiper-slide">
        <img src="{{asset('haircare/images/slideshow_1.jpg')}}" />
        </div>
        <div class="swiper-slide">
        <img src="{{asset('haircare/images/slideshow_3.jpg')}}" />
        </div>
        <div class="swiper-slide">
        <img src="{{asset('haircare/images/slideshow_4.jpg')}}" />
        </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
    </div>
</div>
<div >
    <div id="main-content">
        @foreach($species_product as $sp)
        <a href="collections?sp={{$sp->ID_SpeciesProduct}}" class="item-sp">
            <img src="{{asset('haircare/images').'/'.$sp->Image_SpeciesProduct}}" alt="">
            <span>{{$sp->Name_SpeciesProduct}}</span>
        </a>
        @endforeach
    </div>
    <div id="involve-content">
        <div class="container-fluid" style="height:500px">
            <div class="title-invole-store">
                <span class="text-title">Sản phẩm nổi bật</span>
                <span><a href="">Xem tất cả</a></span>
            </div>
            <div class="content-store">
                <div class="swiper-container SwiperStoreHot">
                    <div class="swiper-wrapper">
                        @for($i= 1;$i< 30; ++$i)
                        <div class="swiper-slide">
                            <div class="owl-item">
                                <div class="item-info">
                                    <a href="#" class="team" title="Lăn Khử Mùi Ngăn Mồ Hôi Chuyên Biệt Etiaxil Deodorant Douceur 48h Roll-On 50ML">
                                        <div class="img" style="height:250px;background-image: url(http://localhost:8081/myblog/public/haircare/images/stylist-{{rand(1,5)}}.jpg);"></div>
                                        <span>Lăn Khử Mùi Ngăn Mồ Hôi Chuyên Biệt Etiaxil Deodorant Douceur 48h Roll-On 50ML</span>
                                        <span>237,000₫</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-button-next next-product next-product-hot"></div>
                <div class="swiper-button-prev prev-product prev-product-hot"></div>
            </div>
        </div>
        <div class="container-fluid" style="height:500px">
            <div class="title-invole-store">
                <span class="text-title">Sản phẩm mới</span>
                <span><a href="">Xem tất cả</a></span>
            </div>
            <div class="content-store">
                <div class="swiper-container SwiperStoreNew">
                    <div class="swiper-wrapper">
                        @for($i= 1;$i< 30; ++$i)
                        <div class="swiper-slide">
                            <div class="owl-item">
                                <div class="item-info">
                                    <a href="#" class="team" title="Lăn Khử Mùi Ngăn Mồ Hôi Chuyên Biệt Etiaxil Deodorant Douceur 48h Roll-On 50ML">
                                        <div class="img" style="height:250px;background-image: url(http://localhost:8081/myblog/public/haircare/images/stylist-{{rand(1,5)}}.jpg);"></div>
                                        <span>Lăn Khử Mùi Ngăn Mồ Hôi Chuyên Biệt Etiaxil Deodorant Douceur 48h Roll-On 50ML</span>
                                        <span>237,000₫</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-button-next next-product next-product-new"></div>
                <div class="swiper-button-prev prev-product prev-product-new"></div>
            </div>
        </div>
        <div class="container-fluid" style="height:500px">
            <div class="title-invole-store">
                <span class="text-title">Sản phẩm mua nhiều</span>
                <span><a href="">Xem tất cả</a></span>
            </div>
            <div class="content-store">
                <div class="swiper-container SwiperStoreMany">
                    <div class="swiper-wrapper">
                        @for($i= 1;$i< 30; ++$i)
                        <div class="swiper-slide">
                            <div class="owl-item">
                                <div class="item-info">
                                    <a href="#" class="team" title="Lăn Khử Mùi Ngăn Mồ Hôi Chuyên Biệt Etiaxil Deodorant Douceur 48h Roll-On 50ML">
                                        <div class="img" style="height:250px;background-image: url(http://localhost:8081/myblog/public/haircare/images/stylist-{{rand(1,5)}}.jpg);"></div>
                                        <span>Lăn Khử Mùi Ngăn Mồ Hôi Chuyên Biệt Etiaxil Deodorant Douceur 48h Roll-On 50ML</span>
                                        <span>237,000₫</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-button-next next-product next-product-many"></div>
                <div class="swiper-button-prev prev-product prev-product-many"></div>
            </div>
        </div>
    </div>
</div>
<script>
    var SwiperBanner = new Swiper(".SwiperBanner", {
        effect: "fade",
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
    var SwiperStoreHot = new Swiper(".SwiperStoreHot", {
        slidesPerView: 5,
        slidesPerGroup: 5,
        pagination: {
          el: ".swiper-pagination",
          type: "progressbar",
        },
        navigation: {
          nextEl: ".next-product-hot",
          prevEl: ".prev-product-hot",
        },
    });
    var SwiperStoreNew = new Swiper(".SwiperStoreNew", {
        slidesPerView: 5,
        slidesPerGroup: 5,
        pagination: {
          el: ".swiper-pagination",
          type: "progressbar",
        },
        navigation: {
          nextEl: ".next-product-new",
          prevEl: ".prev-product-new",
        },
    });
    var SwiperStoreMany = new Swiper(".SwiperStoreMany", {
        slidesPerView: 5,
        slidesPerGroup: 5,
        pagination: {
          el: ".swiper-pagination",
          type: "progressbar",
        },
        navigation: {
          nextEl: ".next-product-many",
          prevEl: ".prev-product-many",
        },
    });
</script>
@endsection