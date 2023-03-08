@extends('front.parent')
@section('styles')
<meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <style>
        * {
        box-sizing: border-box;
        }
        /* Add a gray background color with some padding */
        body {
        font-family: Arial;
        padding: 0px;
        background: #f1f1f1;
        }
        .btn-primary {
      color: #212529;
      background-color: #e2432e;
       border-color: #e2432e;
}
.btn-primary:hover {
    color: #fff;
    background-color: #f33f3f;
    border-color: #f33f3f;
}
        /* Header/Blog Title */
        .header {
        padding: 30px;
        font-size: 40px;
        text-align: center;
        background: white;
        }
        /* Create two unequal columns that floats next to each other */
        /* Left column */
        .leftcolumn {   
        float: left;
        width: 75%;
        }
        /* Right column */
        .rightcolumn {
        float: left;
        width: 25%;
        padding-left: 20px;
        }
        /* Fake image */
        .fakeimg {
        background-color: #aaa;
        width: 100%;
        padding: 20px;
        }
        /* Add a card effect for articles */
        .card {
        background-color: white;
        padding: 20px;
        margin-top: 20px;
        }
        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }
        .avatar {
        vertical-align: middle;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        }
        .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
        }
        .rate:not(:checked) > input {
        position:absolute;
        display: none;
        }
        .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
        }
        .rate:not(:checked) > label:before {
        content: '★ ';
        }
        .rate > input:checked ~ label {
        color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
        }
        .rating-container .form-control:hover, .rating-container .form-control:focus{
        background: #fff;
        border: 1px solid #ced4da;
        }
        .rating-container textarea:focus, .rating-container input:focus {
        color: #000;
        }
        .dropdown.dropdown-lg .dropdown-menu {
    margin-top: -1px;
    padding: 4px 15px;
}


    
        /* End */
     </style>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('detail/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('detail/css/style.css')}}" rel="stylesheet">
@endsection
      

 
    
@section('content')

   <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div style=" padding-top: 100px;  padding-bottom: 100px;" class="row px-xl-5">
            @foreach ($meals as $meal)
            <div class="col-lg-5 pb-5">
              
                <div id="product-carousel" data-ride="carousel">
                    <div class="carousel-inner border">
                       
                    <img style=" vertical-align: middle;" class="w-75 h-75" src="{{Storage::url($meal->image ?? '')}}" alt="Image">
                        
                    </div>
                    {{-- <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a> --}}
                </div>
            </div>

<div class="col-lg-7 pb-5">
    <h3 style="color: #e2432e"  class="font-weight-semi-bold" >{{$meal->title}}</h3>
    <h4>{{$meal->resturant->name}} Resturant</h4>
    <p >{{$meal->description}}</p>
    <h3 style="color: #e2432e"  class="font-weight-semi-bold mb-4">{{$meal->price}}$</h3>


    <div class="d-flex mb-3">
        {{-- <div class="text-primary mr-2">
            <small class="fas fa-star"></small>
            <small class="fas fa-star"></small>
            <small class="fas fa-star"></small>
            <small class="fas fa-star-half-alt"></small>
            <small class="far fa-star"></small>
        </div> --}}
       {{-- @foreach ($reviewMeals as $reviewMeals)  --}}
        {{-- @for($i=1; $i<=$meal->avg_rating; $i++) 
        <i  class="fas fa-star" style="font-size: 20px; color: yellow;"></i>
      
        @endfor
        @for($i=1; $i<=(5-$meal->avg_rating); $i++) 
        <i  class="fas fa-star" style="font-size: 20px; color: grey;"></i>
    
        @endfor  --}}

        
     
   &nbsp; &nbsp;
    
    
        <small style="font-size: 13px;" class="pt-1">{{$meal->avg_rating}}/5</small>
        <small style="font-size: 13px; " class="pt-1">({{$meal->num_reviews}}  Reviews)</small>
    </div>
    
  
    <div class="d-flex align-items-center mb-4 pt-2">
      
        <button href="{{route('carts.index')}}" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
    </div>
  
</div>

           
        </div>



        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a style="font-size: 20px; color:#000; font-weight: bold; " font-size: 20px; class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews </a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
 {{-- reviews --}}
                            <div class="col-md-6">
                                <h3 style=" font-weight: bold; "   class="mb-4">Reviews</h3>
                                <div class="media mb-4 ">
                                  
                                    <div class="media-body col-lg-4 pb-5">
                                        @foreach ( $reviewMeals as $reviewMeal)
                                            
                                    
                                       <h4 style=" font-weight: bold;" >  {{$reviewMeal->User->name}}<small> -{{$reviewMeal->created_at->diffForHumans()}}</small></h4>
                                        {{-- <div class="text-primary mb-2">
                                            <i class="fas fa-star" aria-hidden="true"></i>
                                            <i class="fas fa-star"  aria-hidden="true"></i>
                                            <i class="fas fa-star"  aria-hidden="true"></i>
                                            <i class="fas fa-star-half-alt"  aria-hidden="true"></i>
                                            <i class="far fa-star"  aria-hidden="true"> </i>
                                        </div>  --}}
                                        
                                        @for($i=1; $i<=$reviewMeal->rate; $i++) 
                                        <span><i style="font-size: 17px;" class="fa fa-star text-warning"></i></span>
                                        @endfor
                                      
                                        <p style="font-size: 17px;"> {{$reviewMeal->comment}}</p>
                                        <hr style="border: 1px solid rgb(43, 42, 42);">
                                        @endforeach       
                                    </div>
                             
                                </div>
                            </div>
                         



                            <div class="col-md-6">
                                <h4 style="font-size: 15px; color:#000;  font-weight: bold; "  class="mb-4">Leave a review</h4>
                                <div class="d-flex my-3">
                                    <p  style=" font-size:15px; color:#000;  font-weight: bold;"  class="mb-0 mr-2">Rate Us :</p>
                                   
                                    <div class="text-primary">
                                  
                                        <form class="rate">
                                            <input type="radio" id="star5" class="rate" name="rating" value="5" onclick="postToController();" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" checked id="star4" class="rate" name="rating" value="4" onclick="postToController();" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" class="rate" name="rating" value="3" onclick="postToController();" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" class="rate" name="rating" value="2" onclick="postToController();" >
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" class="rate" name="rating" value="1" onclick="postToController();" />
                                            <label for="star1" title="text">1 star</label>

                                        </form>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label  style=" font-size: 15px; color:#000;  font-weight: bold; "  for="message">Your Comment</label>
                                        <textarea style="border: 1px solid rgb(43, 42, 42);" id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                  
                                    <div class="form-group mb-0">
                        

                                        @if(Auth::guard('user')->check())
                                        <button type="button" onclick="performStore({{$meal->id}}, {{Auth::guard('user')->user()->id}}) "
                                                    class="btn btn-primary">save
                                        </button>
                                        @else
                                        <a  href="{{route('cms.login','user')}}"  type="button" 
                                            class="btn btn-primary"> save
                                    </a>
                                        @endif
                                    </div>
                                    @endforeach                             
                                </form>
                            </div> 


                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@endsection
@section('scripts')
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('detail/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('detail/lib/owlcarousel/owl.carousel.min.js')}}"></script>


    <!-- Contact Javascript File -->
    <script src="{{asset('detail/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('detail/mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('detail/js/main.js')}}"></script>
    <script>
        function performStore(idmeal , iduser ) {
         
    
            axios.post('/front/detail', {
                message: document.getElementById('message').value,
                rate: postToController() ,
                meal_id: idmeal,
                user_id :iduser,
     // role_id: document.getElementById('role_id').value,
            })
            .then(function (response) {
                console.log(response);
                window.location.href = '/front/detail?meal_id='+idmeal;
			    // document.getElementById('save-address').reset();
                toastr.success(response.data.message);

                
            })
            .catch(function (error) {
                console.log(error.response);
                toastr.error(error.response.data.message);
            });
        }

    </script>

<script> 
    function postToController() {
        for (i = 0; i < document.getElementsByName('rating').length; i++) {
                if(document.getElementsByName('rating')[i].checked == true) {
                    var ratingValue = document.getElementsByName('rating')[i].value;
                    break;
                }
        }
        return ratingValue;
    
}

</script>
<script> 
    function calculateAve() {
        for (i = 0; i < document.getElementsByName('rating').length; i++) {
                if(document.getElementsByName('rating')[i].checked == true) {
                    var ratingValue = document.getElementsByName('rating')[i].value;
                    break;
                }
        }
        return ratingValue;
    
}

</script>
    @endsection