    @extends('front.parent')
    @section('styles')

    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
    <style>
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
    @endsection
    @section('content')

  
    <section class="home">

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
                  <p>{{$highestrating->description}}<p>
                    {{-- <br> --}}
                    <span>{{$highestrating->price}}$</span>
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
  
  </section>

    <section class="products">

      <h1 class="heading"> latest <span>meals</span> </h1>
  
      <div class="box-container">
        @foreach($latestmeals as $latestmeal)
        {{-- {{$latestmeal->avg_rating}} --}}

          <div class="box">
              <div class="image">
                  <img src="{{Storage::url($latestmeal->image ?? '')}}" class="main-img" alt="">
                  <img src="{{Storage::url($latestmeal->image ?? '')}}" class="hover-img" alt="">
                  <div class="icons">
                    @if(Auth::guard('user')->check())
                    <a onclick="performCartStore({{$latestmeal->id }} ,{{$latestmeal->price}})" class="fas fa-shopping-cart" ></a>
                    <a onclick="performFavoriteStore({{$latestmeal->id }})" class="fas fa-heart"  @if($latestmeal->is_favorite)  style=" background-color: #f33f3f;"   @endif ></a>

                      @else
                      <a   href="{{route('cms.login','user')}}"  class="fas fa-shopping-cart" ></a>

                      <a href="{{route('cms.login','user')}}"    class="fas fa-heart" ></a>
                      @endif

                      <a href="{{route('front.detail',['meal_id'=>$latestmeal->id])}}" class="fas fa-eye"></a>
                  </div>
              </div>
              <div class="content">
                  <h3>{{$latestmeal->title}}</h3>
                  <h4>{{$latestmeal->resturant->name}}</h4>
                  

                  <div class="price">${{$latestmeal->price}} </div>
                  <span class="stars">
                  
                    @for($i=1; $i<=$latestmeal->avg_rating; $i++) 
                      <i class="fas fa-star"></i> 
                    
                    @endfor 
                    @for($i=1; $i<=(5-(int)$latestmeal->avg_rating); $i++) 
                      <i class="fas fa-star" style="color: grey"></i>
                   
                    @endfor 

              <small style="font-size: 13px;" class="pt-1">{{$latestmeal->avg_rating}}/5</small>
                      <small style="font-size: 13px;" class="pt-1">( {{$latestmeal->num_reviews }} Reviews )</small> 
                      
                      
                  </span>
              </div>
          </div>
  
     
        @endforeach
      </div>
  
  </section>

    <div class="best-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>About Resturants</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4>Looking for the best Meals?</h4>
              <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem facere unde et voluptas labore vero repudiandae. Pariatur facere perferendis officiis ex ad quisquam dignissimos fuga ducimus eveniet, nihil quis facilis?</p>
              <ul class="featured-list">
                <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                <li><a href="#">Consectetur an adipisicing elit</a></li>
                <li><a href="#">It aquecorporis nulla aspernatur</a></li>
                <li><a href="#">Corporis, omnis doloremque</a></li>
                <li><a href="#">Non cum id reprehenderit</a></li>
              </ul>
              <a href="{{route('front.about')}}" class="filled-button">Read More</a>
            </div>
          </div>
          <div class="col-md-6">
            {{-- <div class="right-image"> --}}
              {{-- <img src="{{asset('front/assets/images/about2.jpeg')}}" alt=""> --}}
            {{-- </div> --}}
          </div>
        </div>
      </div>
    </div>
    @endsection

    @section('scripts')

    <!-- jQuery -->
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
    function performFavoriteStore(id) {
      axios.post('/front/favorites',{
            meal_id:  id,
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


</script>
@endsection




    
  