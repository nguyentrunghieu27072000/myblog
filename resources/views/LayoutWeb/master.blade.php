<!DOCTYPE html>
<html lang="en">

<head>
  <title>Haircare</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:500,600,700&display=swap" rel="stylesheet"> -->

  <link rel="icon" type="image/png" href="{{asset('haircare\images\HaircareFavicon.png')}}">
  <link rel="stylesheet" href="{{asset('haircare/css/open-iconic-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('haircare/css/animate.css')}}">

  <link rel="stylesheet" href="{{asset('haircare/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('haircare/css/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('haircare/css/magnific-popup.css')}}">

  <link rel="stylesheet" href="{{asset('haircare/css/aos.css')}}">

  <link rel="stylesheet" href="{{asset('haircare/css/ionicons.min.css')}}">

  <link rel="stylesheet" href="{{asset('haircare/css/bootstrap-datepicker.css')}}">
  <link rel="stylesheet" href="{{asset('haircare/css/jquery.timepicker.css')}}">

  <link rel="stylesheet" href="{{asset('haircare/css/flaticon.css')}}">
  <link rel="stylesheet" href="{{asset('haircare/css/icomoon.css')}}">
  <link rel="stylesheet" href="{{asset('haircare/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('haircare/css/style2.css')}}">

  <script src="{{asset('haircare/js/jquery.min.js')}}"></script>
  <!-- Slide -->
  <link rel="stylesheet" href="{{asset('haircare/swiper/swiper-bundle.min.css')}}" />
  <script src="{{asset('haircare/swiper/swiper-bundle.min.js')}}"></script>
  <!-- toggle switchery -->
  <link rel="stylesheet" href="{{asset('switchery/switchery.min.css')}}" />
  <script src="{{asset('switchery/switchery.min.js')}}"></script>
  <!--  -->
  <!-- select2 -->
  <link href="{{asset('select2/select2.min.css')}}" rel="stylesheet" />
  <script src="{{asset('select2/select2.min.js')}}"></script>
  <!--  -->
  <!-- firebase -->
  <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
  <!--  -->
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html"><span class="flaticon-scissors-in-a-hair-salon-badge"></span>Haircare</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav nav-ml" style="margin-left: 25%;">
          <li class="nav-item active"><a href="{{URL::to('/')}}/Home" class="nav-link">Trang chủ</a></li>
          <li class="nav-item"><a href="services.html" class="nav-link">Dịch vụ</a></li>
          <li class="nav-item"><a href="{{URL::to('/')}}/Store" class="nav-link">Store</a></li>
          <li class="nav-item"><a href="gallery.html" class="nav-link">Gallery</a></li>
          <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
        </ul>
      </div>
    </div>
    @if(Session::has('user'))
    <div class="nav-login">
      <span>{{session('user')}} <i class="icon-caret-down"></i></span>
      <div class="dropdown-account">
        <a href="#">Số dư</a>
        <a href="#">Lịch sử</a>
        <a href="Logout">Đăng xuất</a>
      </div>
    </div>
    @else
    <div class="nav-login"><span data-toggle="modal" data-target="#loginModal">Đăng nhập</span></div>
    @endif
    @if(in_array(Request::path(),['Store','collections','product-details','Shooping-Cart']))
    <div class="cart-store">
      <div class="shopping-cart">
        <i class="icon-shopping-cart"></i>
        <span class="count">
          @if(Session::has('Cart'))
          {{Session::get("Cart")->totalQuanty}}
          @else
          0
          @endif
        </span>
      </div>
      <div class="cart-hover">
        <div class="select-items">
          <table>
            <tbody id="item-cart">
              @if(Session::has('Cart'))
              @foreach(Session::get("Cart")->products as $item)
              <tr>
                <td class="si-pic"><img src="{{asset('haircare/images').'/'.$item['productInfo']->Image_Product}}" alt="{{$item['productInfo']->Name_Product}}"></td>
                <td class="si-text">
                  <div class="product-selected">
                    <p>{{number_format($item['productInfo']->Price_Product)}}₫ x {{$item['Quanty']}}</p>
                    <h6 title="{{$item['productInfo']->Name_Product}}" style="overflow: hidden;-webkit-line-clamp: 2;-webkit-box-orient: vertical;display: -webkit-box;">{{$item['productInfo']->Name_Product}}</h6>
                  </div>
                </td>
                <td class="si-close">
                  <i data-id="{{$item['productInfo']->ID_Product}}" class="icon-remove remove-item-cart"></i>
                </td>
              </tr>
              @endforeach
              @else
              <tr class="text-center">Hiện chưa có sản phẩm</tr>
              @endif
            </tbody>
          </table>
        </div>
        <div class="select-total">
          <span>Tổng tiền:</span>
          <h5 id="total-money">
            @if(Session::has('Cart'))
            {{number_format(Session::get("Cart")->totalPrice)}}
            @else
            0
            @endif
            ₫
          </h5>
        </div>
        <div class="select-button">
          <a href="{{URL::to('/')}}/Shooping-Cart" class="primary-btn view-card">Xem giỏ hàng</a>
          <a href="{{URL::to('/')}}/Checkout" class="primary-btn checkout-btn">Thanh toán</a>
        </div>
      </div>
    </div>
    @endif
  </nav>
  <!-- END nav -->


  @yield('body')

  <footer class="ftco-footer ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2 logo">Haircare</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4 ml-md-5">
            <h2 class="ftco-heading-2">Information</h2>
            <ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">FAQs</a></li>
              <li><a href="#" class="py-2 d-block">Privacy</a></li>
              <li><a href="#" class="py-2 d-block">Terms Condition</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Links</h2>
            <ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">Home</a></li>
              <li><a href="#" class="py-2 d-block">About</a></li>
              <li><a href="#" class="py-2 d-block">Services</a></li>
              <li><a href="#" class="py-2 d-block">Work</a></li>
              <li><a href="#" class="py-2 d-block">Blog</a></li>
              <li><a href="#" class="py-2 d-block">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Have a Questions?</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">

          <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>
        </div>
      </div>
    </div>
  </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg>
  </div>
  <!-- modal login -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 450px; margin-top: 10%">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <div style="position:absolute;left:50%;top: 15%;">
            <h4 style="position: relative;font-weight: bold;left: -50%;">Đăng nhập</h4>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div id="recaptcha-container"></div>
        </div>
        <div class="modal-body">
          <div id="phone-number">
            <div class="form-title mt-3 mb-3 text-center">
              <span>Số điện thoại của anh, chị là gì?</span>
            </div>
            <div class="d-flex flex-column text-center">
              <form>
                <div class="form-group">
                  <input type="sdt" class="form-control" id="sdt" placeholder="Ví dụ: 0239.xxx.xxx" autocomplete="off">
                  <label class="error-phone-number"></label>
                </div>
                <button type="button" id="send-OTP" class="btn btn-warning btn-block btn-round rounded text-uppercase font-weight-bold">Tiếp tục</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{asset('haircare/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('haircare/js/popper.min.js')}}"></script>
    <script src="{{asset('haircare/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('haircare/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('haircare/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('haircare/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('haircare/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('haircare/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('haircare/js/aos.js')}}"></script>
    <script src="{{asset('haircare/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{asset('haircare/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('haircare/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('haircare/js/scrollax.min.js')}}"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> -->
    <!-- <script src="{{asset('haircare/js/google-map.js')}}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.all.min.js"></script>
    <script src="{{asset('haircare/js/main.js')}}"></script>
    <script src="{{URL::to('/')}}/resources/js/main2.js"></script>
</body>
<script>
  $(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      }
    });
  });
</script>

</html>
@include('sweetalert::alert')