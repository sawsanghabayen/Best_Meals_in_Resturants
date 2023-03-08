@extends('front.parent')
@section('styles')

<style>
  footer {
 font-size: 15px;
      }
</style>
<link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">

<!-- Libraries Stylesheet -->

@endsection
@section('content')
      
    {{-- <div class="products">
      <div class="container"> --}}
        {{-- <div class="row">
          
          <div class="col-md-12">
            <div class="filters-content">
                <div class="row grid">
                  @foreach($favorites as $favorite)
                    <div class="col-lg-4 col-md-4 all des">
                     
                      <div class="product-item">
                        <a href="#"><img style="height: 80" src="{{Storage::url($favorite->image ?? '')}}" alt=""></a>
                        <div class="down-content">
                         
                         <h4>{{$favorite->title}} </h4>
                         <h6 id="price">${{$favorite->price}}</h6>
                         <a href="#"><h4 style="color:#f33f3f ">{{$favorite->resturant->name}} Resturant</h4></a>

                          <p>{{$favorite->description}}</p>
                          <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                          </ul>
                          <form>
                            @csrf
                          <input onclick="performCartStore({{$favorite->id }} ,{{$favorite->price}})" type="button" class="btn btn-primary" value="Add To Cart" >
                          <input onclick="performFavoriteStore({{$favorite->id }})" type="button" class="btn btn-danger" value="Add To WishList" >
                          </form>
                        </div>
                      </div>
                      
                    </div>
                    @endforeach
                </div>
            </div>
          </div>
          <div class="col-md-12">
            <ul class="pages">
              <li><a href="#">1</a></li>
              <li class="active"><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
          </div>
        </div> --}}
        <section class="products">

          <h1 class="heading"> My <span>favorite</span> </h1>
      
          <div class="box-container">
            @foreach($favorites as $favorite)

              <div class="box">
                  <div class="image">
                      <img src="{{Storage::url($favorite->image ?? '')}}" class="main-img" alt="">
                      <img src="{{Storage::url($favorite->image ?? '')}}" class="hover-img" alt="">
                      <div class="icons">
                          <a onclick="performCartStore({{$favorite->id }} ,{{$favorite->price}})" class="fas fa-shopping-cart"></a>
                          <a onclick="performFavoriteStore({{$favorite->id }})"   style=" background-color: #f33f3f;" class="fas fa-heart"></a>
                          <a href="#" class="fas fa-eye"></a>
                      </div>
                  </div>
                  <div class="content">
                      <h3>{{$favorite->title}}</h3>
                      <h4>{{$favorite->resturant->name}}</h4>

                      <div class="price">${{$favorite->price}} <span>${{$favorite->price}}</span></div>
                      <div class="stars">
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star-half-alt"></i>
                      </div>
                  </div>
              </div>
      
       
      
        
        @endforeach
          </div>
      
      </section>
      {{-- </div>
    </div> --}}

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


    function performCartStore(id ,favoriteprice ) {
      axios.post('/front/carts',{
            favorite_id:  id,
            quantity :1,
            price:favoriteprice,

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
