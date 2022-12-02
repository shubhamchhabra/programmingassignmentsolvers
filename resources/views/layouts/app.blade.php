<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{URL::asset('/images/favicon.png')}}" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .title {
            font-size: 54px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        .text-shadow {
text-shadow: 0 0 10px #455, 0 0 20px #455, 0 0 100px #455;
}
.btnHover::before {
opacity: 0.2;
}
.carousel {
margin: 50px auto;
}
.v-card__title {
    align-items: center;
    display: flex;
    flex-wrap: wrap;
    font-size: 1.25rem;
    font-weight: 500;
    letter-spacing: 0.0125em;
    line-height: 2rem;
    word-break: break-all;
}
.v-card__subtitle, .v-card__text {
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.375rem;
    letter-spacing: 0.0071428571em;
}
.primary--text {
    color: #248097;
    caret-color:#248097;
}
.warning--text {
    color: #c4e83c;
    caret-color: #c4e83c;
}
.carousel .carousel-item {
color: #999;
overflow: hidden;
min-height: 120px;
font-size: 13px;
}
.carousel .media {
position: relative;
padding: 0 0 0 20px;
margin-left: 20px;
}
.carousel .media img {
width: 75px;
height: 75px;
display: block;
border-radius: 50%;
box-shadow: 0 2px 4px rgba(0,0,0,0.2);
border: 2px solid #fff;
}
.carousel .testimonial {
color: #fff;
position: relative;
background: #9b9b9b;
padding: 15px;
margin: 0 0 20px 20px;
}
.carousel .testimonial::before, .carousel .testimonial::after {
content: "";
display: inline-block;
position: absolute;
left: 0;
bottom: -20px;
}
.carousel .testimonial::before {
width: 20px;
height: 20px;
background: #9b9b9b;
box-shadow: inset 12px 0 13px rgba(0,0,0,0.5);
}
.carousel .testimonial::after {
width: 0;
height: 0;
border: 10px solid transparent;
border-bottom-color: #fff;
border-left-color: #fff;
}
.carousel .carousel-item .row > div:first-child .testimonial {
margin: 0 20px 20px 0;
}
.carousel .carousel-item .row > div:first-child .media {
margin-left: 0;
}
.carousel .testimonial p {
text-indent: 40px;
line-height: 21px;
margin: 0;
}
.carousel .testimonial p::before {
content: "\201D";
  font-family: Arial,sans-serif;
color: #fff;
font-weight: bold;
font-size: 68px;
line-height: 70px;
position: absolute;
left: -25px;
top: 0;
}
.carousel .overview {
padding: 3px 0 0 15px;
}
.carousel .overview .details {
padding: 5px 0 8px;
}
.carousel .overview b {
text-transform: uppercase;
color: #ff5555;
}
.carousel-control-prev, .carousel-control-next {
width: 30px;
height: 30px;
background: #666;
text-shadow: none;
top: 4px;
}
.carousel-control-prev i, .carousel-control-next i {
font-size: 16px;
}
.carousel-control-prev {
left: auto;
right: 40px;
}
.carousel-control-next {
left: auto;
}
.carousel-indicators {
bottom: -80px;
}
.carousel-indicators li, .carousel-indicators li.active {
width: 17px;
height: 17px;
border-radius: 0;
margin: 1px 5px;
  box-sizing: border-box;
}
.carousel-indicators li {
background: #e2e2e2;
border: 4px solid #fff;
}
.carousel-indicators li.active {
color: #fff;
background: #ff5555;
border: 5px double;
}
.star-rating li {
padding: 0 2px;
}
.star-rating i {
font-size: 14px;
color: #ffdc12;
}
.primary{
background:    #248097
}
.secondary{
background:#c4e83c
}
.link-secondary {
    color: #c4e83c;
}
.secondary-text {
    color: #c4e83c;
}.header-content {
  position: absolute;
  font-family: sans-serif;
  top: 50%;
  left: 40%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  //background-color: #555;
  color: white;
  font-size: 32px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
}
ul.services-links__list.list--clean {
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    list-style-type: none;
}

ul.services-links__list.list--clean li {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 12px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 12px;
    width: 25%;
    padding-right: 12px;
    color: #ffffff;
}

@media only screen and (max-width: 768px) {
  /* For mobile phones: */
  ul.services-links__list.list--clean li{
    width: 100%;
  }
  .header-content{
    font-size: 10px;
    padding: 0;
  }
}

#pricing .card-body h1 {
    font-size: 3em;
    padding: 30px 0px;
    border-bottom: 2px solid #ebedec;
    line-height: 0.7;
}
#pricing .card-body small {
    vertical-align: bottom;
    font-size: 0.30em;
    letter-spacing: 0.04em;
    padding-left: 0.2em;
}
    </style>
</head>
<body>
    <div id="app">
        <nav class="p-2 primary border-bottom">
            <div class="d-flex flex-wrap justify-content-center justify-content-sm-between">
              <ul class="nav">
                <li class="nav-item"><a class="nav-link link-dark px-2 active" href="mailto:support@programming-assignment-solvers.com" style="color: white !important; text-decoration: underline !important;">support@programming-assignment-solvers.com</a></li>
              </ul>
              <ul class="nav">
                @if (Route::has('login'))
                    @auth

                    <li class="nav-item"><a class="nav-link link-dark px-2 text-white" href="{{ url('/orders') }}">My Account</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link link-dark px-2 text-white" href="{{ route('order') }}">Order Now</a></li>

                    <li class="nav-item align-self-center"><a class="nav-link link-dark px-2 text-white" href="{{ route('login') }}"><i class="fa fa-user"></i></a></li>

                        @if (Route::has('register'))
                        {{-- <li class="nav-item"><a class="nav-link link-dark px-2 text-white" href="{{ route('register') }}">Register</a></li> --}}
                        @endif
                    @endauth
            @endif
              </ul>
            </div>
          </nav>
          <header class="border-bottom">
            <div class="container d-flex flex-wrap justify-content-center align-items-center">
              <a href="/" class="d-flex  mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <img src="{{URL::asset('/images/logo_old.png')}}" width="220px" style="padding: 10px"/>
              </a>
              <ul class="col-12 col-lg-auto mb-3 mb-lg-0 nav justify-content-center">
                <li class="nav-item"><a href="/#" class="nav-link link-dark px-2 active" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="/#testimonial" class="nav-link link-dark px-2">Testimonial</a></li>
                <li class="nav-item"><a href="/#pricing" class="nav-link link-dark px-2">Pricing</a></li>
                <li class="nav-item"><a href="/#services" class="nav-link link-dark px-2">Services</a></li>
                <li class="nav-item"><a href="/#blog" class="nav-link link-dark px-2">Blog</a></li>
                  <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link link-dark px-2">Contact</a></li>

              </ul>
            </div>
          </header>
          <div style="position: relative;"><img lazy-src="/images/header.jpg" max-width="auto" src="/images/header.jpg" style="width: 100%;">
              <div data-v-0a987ebd="" class="header-content">
                  <p data-v-0a987ebd="">The Best Programming Online Help For You</p>
                  <a href="{{ route('order') }}" data-v-0a987ebd="" type="button" class="btn order-now-btn v-btn v-btn--is-elevated v-btn--has-bg text-white theme--light v-size--default primary">
                      <span class="v-btn__content">Order now</span>
                  </a>
              </div>
          </div>
        <main class="">
            @yield('content')
        </main>
                <!-- Footer -->
<footer class="text-center text-lg-start primary text-white">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <!-- Left -->
      <div class="me-5 d-none d-lg-block">
        <span>Get connected with us on social networks:</span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="" class="me-4 link-secondary">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 link-secondary">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 link-secondary">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 link-secondary">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 link-secondary">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 link-secondary">
          <i class="fab fa-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              About Us
            </h6>
            <p>
              Programming Assignment Solvers is an international team of experts in coding, programming, designing, and other technical related fields. They are here to help you with any task you might be facing! .
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Services
            </h6>
            <?php
                    foreach($subjects as $subject){
                     ?>
            <p>
              <a class="text-reset" href="{{route('services.view',['slug' => $subject['slug']])}}"><?=$subject['title']?></a>
            </p>
           <?php } ?>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Useful links
            </h6>
                  <?php
                    foreach($staticPages as $page){
                     ?>
                     <p>
                        <a href="{{route('pages', ['url' => $page->urlTitle])}}" class="text-reset"><?= $page->title ?></a>
                     </p>
                  <?php
                    }
                  ?>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
            <p><i class="fas fa-home me-3 link-secondary"></i>Delhi , India</p>
            <p>
              <i class="fas fa-envelope me-3 link-secondary"></i>
              allassignmenthelpers@gmail.com
            </p>
            <p><i class="fas fa-phone me-3 link-secondary"></i> + 01 234 567 88</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
      © 2022 Copyright:
      <a class="text-reset fw-bold" href="https://www.linkedin.com/in/shubham-chhabra-832b19b0/">Shubham Chhabra</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>
