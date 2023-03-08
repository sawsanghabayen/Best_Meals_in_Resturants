<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resturant | @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/0866ae2c30.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
  <!-- swiper css link  -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <!-- cusom css file link  -->
  <link rel="stylesheet" href="{{asset('front2/css/style.css')}}">
  {{-- <style>
    
  </style> --}}
  


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Restaurant Meals</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset('front/assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/templatemo-sixteen.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/owl.css')}}">
    
<style>
  footer {
     font-size: 15px;
          }
   .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 15px;
  }
  
  a:hover, .dropdown:hover .dropbtn {
    background-color: #f33f3f;
    transition: all 0.5s;
  
  }
  
  li.dropdown {
    display: inline-block;
  }
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    font-size: 15px;
  
  }
  
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
  }
  
  .dropdown-content a:hover {background-color: #f1f1f1;}
  
  .dropdown:hover .dropdown-content {
    display: block;}
  
  
  /* .home {
    background: #fff;
  } */
  section  {
    padding:9rem 9%;
  }
  
  .home .slide {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    gap: 2rem;
    min-height: 40rem;
    padding: 2rem 0;
  }
  
  .home .slide .image {
    -webkit-box-flex: 1;
        -ms-flex: 1 1 42rem;
            flex: 1 1 42rem;
    text-align: center;
  }
  
  .home .slide .image img {
    height: 30rem;
  }
  
  .home .slide .content {
    -webkit-box-flex: 1;
        -ms-flex: 1 1 42rem;
            flex: 1 1 42rem;
  }
  
  .home .slide .content span {
    font-size: 2rem;
    color: #e2432e;
    justify-content: space-between;
  
  }
  .fa-heart:before{
    font-size: 23px;
  }
  
  .home .slide .content h3 {
    padding-top: .5rem;
    color: #333;
    font-size: 3rem;
  }
  
  .swiper-button-next::after,
  .swiper-button-prev::after {
    font-size: 3rem;
    color: #333;
  }
  .btnbtn {
    margin-top: 1rem;
    display: inline-block;
    border-radius: .5rem;
    padding: 1rem 3rem;
    font-size: 1.7rem;
    color: #fff;
    cursor: pointer;
    background: #e2432e;
  }
  .btnbtn:hover {
    background: #333;
  }
  
  </style>
    @yield('styles')

  </head>

  <body >
 
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="{{route('front.index')}}"><h2>Restaurant <em>Meals</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item ">
                <a class="nav-link" href="{{route('front.index')}}">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="{{route('front.categories')}}">Category </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('front.meals')}}"> Meals</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('front.about')}}">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('contacts.create')}}">Contact Us</a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="{{route('front.contact')}}">Cart</a>
              </li> --}}
              @if (Auth::guard('user')->check())
              <li class="nav-item">
                <a class="nav-link" href="{{route('carts.index')}}"><i class="fas fa-shopping-cart"></i>
                  Cart</a>
              </li>
              {{-- <li class="nav-item"> --}}
                {{-- <i class="fa-solid fa-heart"></i> --}}
                <a class="nav-link" href="{{route('favorites.index')}}"><i class="fa-solid fa-heart"></i>
                  
                  </a>
              {{-- </li> --}}

              
              <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="dropbtn">{{Auth::guard('user')->user()->name}}</a>
                <div class="dropdown-content">
                  <a href="{{route('user.orders')}}" >
                    <i class="fas fa-shopping-cart"></i> My Order
                  </a> 
                  <a href="{{route('password.edit')}}" >
                    <i class="fa-solid fa-right-from-bracket"></i> Change Password
                  </a> 
                  <a href="{{route('cms.logout')}}" >
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                  </a> 
                </div>

              </li>
              {{-- <a href="{{route('carts.index')}}" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">0</span></a> --}}

              {{-- <a class="nav-link"  href="{{route('cms.user.logout')}}" role="button">
                <i class="fa-solid fa-right-from-bracket"></i>
                </a> --}}
              @else

              <li class="nav-item">
                <a class="nav-link" href="{{route('cms.login' ,'user')}}">Sing In</a>
              </li>
              {{-- <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="dropbtn">Sing In</a>
                <div class="dropdown-content">
                  <a href="{{route('cms.login' ,'user')}}">As User</a>
                  <a href="{{route('cms.login' ,'resturant')}}">As Restuarant</a>
                </div>
              </li> --}}
                 
            <li class="nav-item dropdown">
              <a href="javascript:void(0)" class="dropbtn">Sing Up</a>
              <div class="dropdown-content">
                {{-- <a href="{{route('auth.register')}}">As User</a> --}}
                <a href="{{route('auth.registerresturant')}}">As Restuarant</a>
              </div>
            </li>
            @endif

    
            </ul>
          </div>
        </div>
      </nav>
    </header>

    {{-- <section class="home">

      <div class="swiper home-slider">
  
          <div class="swiper-wrapper">
         
              
         
  
            @foreach ($highestratings as $highestrating )
          <div class="swiper-slide slide">
              <div class="image">
                  <img src="{{Storage::url($highestrating->image ?? '')}}" alt="">
              </div>
              <div class="content">
                  <span>{{$highestrating->resturant->name}} Resturant</span>
                  <h3>{{$highestrating->title}}   
                  </h3>
                  <p>{{$highestrating->description}}<p> --}}
               
                    {{-- <span>{{$highestrating->price}}$</span>
                    <br>
                  <span class="stars">
                  
                    @for($i=1; $i<=$highestrating->avg_rating; $i++) 
                      <i class="fas fa-star" style="color: yellow"></i>
         
                      @endfor
                      @for($i=1; $i<=(5-$highestrating->avg_rating); $i++) 
                      <i class="fas fa-star" style="color: grey"></i>
                      @endfor

                      <small class="pt-1">{{$highestrating->avg_rating}}/5</small>
                      <small class="pt-1">( {{$highestrating->num_reviews }} Reviews )</small>
                      <br>
                
                  <a onclick="performCartStore({{$highestrating->id }} ,{{$highestrating->price}})"  class="btnbtn">Order  now</a>
                  </span>
          </div>
          
          
        </div>
        @endforeach

          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
      </div>
  
  </section> --}}
    @yield('content')
    <footer class="footer-48201">
      
        <div class="container">
          <div class="row">
            <div class="col-md-4 pr-md-5">
              <a href="#" class="footer-site-logo d-block mb-4">RESTAURANT MEALS</a>
              <p style="font-size: 14px; 	color: gray;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quasi perferendis ratione perspiciatis accusantium.</p>
            </div>
            <div class="col-md">
              <ul class="list-unstyled nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                
                <li><a href="products.html">Our Meals</a></li>
               
               
              </ul>
            </div>
            <div class="col-md">
              <ul class="list-unstyled nav-links">
                <li><a href="#">Sign in</a></li>
                <li><a href="#">Sign up</a></li>
                <li><a href="{{route('contacts.create')}}">Contact</a></li>
                
              </ul>
            </div>
            <div class="col-md">
              <ul class="list-unstyled nav-links">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms &amp; Conditions</a></li>
                <li><a href="#">Partners</a></li>
              </ul>
            </div>
            <div class="col-md text-md-center">
              <p class=""><a href="{{route('contacts.create')}}" class="btn btn-tertiary">Contact Us</a></p>
            </div>
          </div> 
  
          <div class="row ">
            <div class="col-12 text-center">
              <div class="copyright mt-5 pt-5">
                <p><small>&copy; 2022-2023 All Rights Reserved.</small></p>
              </div>
            </div>
          </div> 
        </div>
        
      </footer>
  
      <!-- loader part  -->
    {{-- <div class="loader-container">
      <img src="{{asset('front/assets/images/loader.gif')}}" alt="">
    </div> --}}
  
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  
  
      <!-- Bootstrap core JavaScript -->
      <script src="{{asset('front/vendor/jquery/jquery.min.js')}}"></script>
      <script src="{{asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  
  
      <!-- Additional Scripts -->
      <script src="{{asset('front/assets/js/custom.js')}}"></script>
      <script src="{{asset('front/assets/js/owl.js')}}"></script>
      <script src="{{asset('front/assets/js/slick.js')}}"></script>
      <script src="{{asset('front/assets/js/isotope.js')}}"></script>
      <script src="{{asset('front/assets/js/accordions.js')}}"></script>
      <script src="{{asset('front/assets/js/script.js')}}"></script>
      <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
<!-- swiper js link      -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
{{-- <script src="{{asset('front2/js/script.js')}}"></script> --}}
<script>
  var swiper = new Swiper(".home-slider", {
    loop:true,
    grabCursor:true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
});

var swiper = new Swiper(".review-slider", {
    loop:true,
    grabCursor:true,
    spaceBetween: 20,
    breakpoints: {
        450: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
    },
});
</script>
@yield('scripts')
  
  
      <script language = "text/Javascript"> 
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t){                   //declaring the array outside of the
        if(! cleared[t.id]){                      // function makes it static and global
            cleared[t.id] = 1;  // you could use true and false, but that's more typing
            t.value='';         // with more chance of typos
            t.style.color='#fff';
            }
        }
      </script>
  
  {{-- <script>
    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }
    
    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
    </script> --}}
    <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
  <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
  
  
  <script>
      function performCartStore(id ,mealprice ) {
      axios.post('/front/carts',{
            meal_id:  id,
            quantity :1,
            price:mealprice,

      })
      .then(function (response) {
          console.log(response);
          toastr.success(response.data.message);
          // window.location.href = '/rest/index';
      })
      .catch(function (error) {
          console.log(error.response);
          toastr.error(error.response.data.message);
      });
  }
  
    </body>
  
  </html>
  