<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Alma de las cosas - @yield('title')</title>
  <meta name="description" content="En marcepets.com criamos con amor los mejores cachorros de diferentes razas. 'La vida es mejor con un gordit@ de 4 patitas'" >
 
  <!-- Favicons -->
  <link href="{{ asset('assets/images/favicon.jpg') }}" rel="icon">
  <link href="{{ asset('assets/images/favicon.jpg') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('app-assets/vendor/animate.css/animate.min.css').'?'.rand() }}" rel="stylesheet">
  <link href="{{ asset('app-assets/vendor/bootstrap/css/bootstrap.min.css').'?'.rand() }}" rel="stylesheet">
  <link href="{{ asset('app-assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('app-assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.css" integrity="sha512-MKxcSu/LDtbIYHBNAWUQwfB3iVoG9xeMCm32QV5hZ/9lFaQZJVaXfz9aFa0IZExWzCpm7OWvp9zq9gVip/nLMg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Template Main CSS File -->
  <link href="{{ asset('app-assets/css/style.css').'?'.rand() }}" rel="stylesheet">

  @livewireStyles
 

</head>

<body>
 

  <!-- ======= Property Search Section ======= -->
  <div class="click-closed"></div>
  

  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top header-dark" style="padding: 15px 0;">
    @include('layouts.partials.appmenu')    
  </nav><!-- End Header/Navbar -->
 

  <main id="main">
    @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <section class="section-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4 border-right">
          <div class="widget-a">           
            <div class="w-body-a footer-logo">
              <img class="logo-footer" src="{{ asset('images/logo/logo-alma-de-las-cosas-blanco.png') }}" />
              <ul class="social-footer mt-5">
                <li>
                  <a href="#">
                    <img src="{{ asset('images/Instagram.png') }}" alt="Instagram" class="">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{ asset('images/Facebook.png') }}" alt="Facebook" class="">
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{ asset('images/Twitter.png') }}" alt="Twitter" class="">
                  </a>
                </li>
              </ul>
              
            </div>           
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">            
            <div class="w-body-a">
                <div class="w-footer-a">
                  <ul class="list-unstyled menu-footer">
                    <li class="color-a">
                      <a href="#">Mi cuenta</a>
                    </li>
                    <li class="color-a">
                      <a href="#">Términos y Condiciones</a>
                    </li>
                    <li class="color-a">
                      <a href="#">Contáctenos</a>
                    </li>
                    <li class="color-a">
                      <a href="#">Rastrea tu pedido</a>
                    </li>
                    
                  </ul>
                </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">            
            <div class="w-body-a">
            
                <div class="action-shedule">
                <img src="{{ asset('images/purple-calendar.png') }}" alt="Twitter" class="image-shedule">
                  <p class="text-shedule mt-3">Agendamos una reunión</p>
                  <button type="button" class="btn btn-shedule">Solicitar</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">          
          
          <div class="copyright-footer">
            <p class="copyright color-text-a">
              &copy; Copyright
              <span class="color-year">2022</span> All Rights Reserved.
            </p>
          </div>
          <div class="credits">        
            Powered by <a href="https://almadelascosas.com/" target="_blank">almadelascosas.com</a>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.wtp') 
  </footer><!-- End  Footer -->

  

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Vendor JS Files -->
  <script src="{{ asset('app-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('app-assets/vendor/php-email-form/validate.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js" integrity="sha512-1mDhG//LAjM3pLXCJyaA+4c+h5qmMoTc7IuJyuNNPaakrWT9rVTxICK4tIizf7YwJsXgDC2JP74PGCc7qxLAHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <!-- Template Main JS File -->
  <script src="{{ asset('app-assets/js/main.js') }}"></script>
  <link rel="stylesheet" href="node_modules/@splidejs/splide/dist/css/splide.min.css">

<!-- or the reference on CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@livewireScripts

<script>

        function _alertGeneric(type,title,text,reload=null){
            Swal.fire({
                //icon: type,
                icon: type,
                title: title,
                text: text,
                confirmButtonText:'Aceptar'
            }).then((result) => {
                //$('#page-loader').fadeOut(100);
                if(reload!='' && reload!=null && reload!=1){
                window.location.href = reload;
                }
                if(reload===1){
                location.reload();
                }
                if(reload===2){
                    window.history.go(-1);
                }
            });
        }

    </script>

    @stack('scripts')
</body>

</html>

