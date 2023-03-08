@extends('front.parent')
@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<style>
  footer {
 font-size: 15px;
      }
      
/* filter */

h2{
      margin-top: 0px;
     margin-bottom: 0px;
}
.input-group-addon, .input-group-btn {
  vertical-align: middle;
}
.dropdown.dropdown-lg .dropdown-menu {
 
    margin-top: -1px;
 
    padding: 4px 15px;
 
}
 
 
 
.btn-group .btn {
 
    border-radius: 0;
 
    margin-left: -1px;
 
}
 
.form-horizontal .form-group {
 
    margin-left: 0;
 
    margin-right: 0;
 
}
 
 
 
.search-box-style {
 
    padding: 9px;
 
    border: solid 1px #408080;
 
    outline: 0;
 
    background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #A4FFA4), to(#FFFFFF));
 
    background: -moz-linear-gradient(top, #FFFFFF, #A4FFA4 1px, #FFFFFF 25px);
 
    box-shadow: rgba(0,64,64, 0.3) 0px 0px 8px;
 
    -moz-box-shadow: rgba(0,64,64, 0.3) 0px 0px 8px;
 
    -webkit-box-shadow: rgba(0,64,64, 0.3) 0px 0px 8px;;
 
 
 
    } 
 
@media screen and (min-width: 768px) {
 
    #boot-search-box {
 
        width: 500px;
 
        margin: 0 auto;
 
    }
 
    .dropdown.dropdown-lg {
 
        position: static !important;
 
    }
 
    .dropdown.dropdown-lg .dropdown-menu {
 
        min-width: 500px;
 
    }
 
}
</style>
<link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">

<!-- Libraries Stylesheet -->

@endsection
@section('content')

<div  style=" padding-top: 150px;" class="container">
	<div class="row">
		<div class="col-md-12">
      <form class="form-horizontal" role="form"  action="{{route('front.meals')}}" method="get">  
      <div class="input-group" id="boot-search-box">
                <input name="title1"  type="text" class="form-control" placeholder="Type a search Title Meal like :pizza" />
                <div   class="input-group-btn" >
                    <div  class="btn-group" role="group">
                        <div class="dropdown dropdown-lg ">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <form class="form-horizontal" role="form" action="{{route('front.meals')}}" method="get">
                                  <div class="form-group">
                                    <label for="filter">Narrow the search:</label>
                                    {{-- <select class="form-control">
                                        <option value="catalogue" selected>All Category</option>
                                        <option value="modal">Modal</option>
                                        <option value="price">Price</option>
                                        <option value="popular">Most Popular</option>
                                    </select> --}}
                                    <select class="form-control" name="category">
                                      <option value="">All Category </option>
                                      @foreach ( $categories as $category )
                                      <option value="{{$category->id}}">{{$category->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="contain">title meal:</label>
                                    {{-- <input type="text" name="title" class="form-control" placeholder="title"> --}}
                                    <input class="form-control" type="text" name="title" />
                                  </div>
                               
                                  
                                  <div class="form-group">
                                      <label for="password1" class="col-sm-3 control-label">Price Range:</label>
                                  <div class="col-sm-3">
                                      <input type="text" name="price_from" class="form-control" placeholder="Min"> <br/> <br />
                                      <input type="text" name="price_to" class="form-control" placeholder="Max"> 
                                  </div>
                                    <br /><br /><br /><br />                        
                                    <button type="submit" class="btn btn-primary btn-block">Search :: <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                  </form>
                                  </div>
                                  </div>
                        <button  style="background-color: #e2432e;
                        border-color: #e2432e;" type="submit" class="btn btn-success "><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                      </form> 
                        
                      </div>
                </div>
              
            </div>
          </div>
        </div>
	</div>
</div>


{{-- <form action="{{route('front.meals')}}" method="get">  

  <div>
    <input type="text" name="title" class="form-control" placeholder="title">
  <input type="text" name="price_from" class="form-control" placeholder="price from">
  </div>
 <div>
  <input type="text" name="price_to" class="form-control" placeholder="price to">
  <select class="form-control" name="category">
    <option value="">All Category </option>
    @foreach ( $categories as $category )
    <option value="{{$category->id}}">{{$category->name}}</option>
    @endforeach
  </select>
 </div>
  <button type="submit" class="btn btn-outline-dark">Search</button>
</form>
       --}}
   {{-- <div class="products">
      <div class="container">
     <div class="row">
          
          <div class="col-md-12">
            <div class="filters-content">
                <div class="row grid">
                  @foreach($meals as $meal)
                    <div class="col-lg-4 col-md-4 all des">
                     
                      <div class="product-item">
                        <a href="#"><img style="height: 80" src="{{Storage::url($meal->image ?? '')}}" alt=""></a>
                        <div class="down-content">
                         
                         <h4>{{$meal->title}} </h4>
                         <a href="{{route('front.detail',['meal_id'=>$meal->id])}}"  title="Go Show Reviewa" style="float: right; " class="btn btn-sm text-dark p-0">
                          <i class="fas fa-eye text-primary mr-1"></i></a>
                          
                         <h6 id="price">${{$meal->price}}</h6>
                         <a href="#"><h4 style="color:#f33f3f ">{{$meal->resturant->name}} Resturant</h4></a>
                       
                          <p>{{$meal->description}}</p>
                          <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                          </ul>

                            @csrf
                            <div style="margin: 6px;"> 
                                  <input onclick="performCartStore({{$meal->id }} ,{{$meal->price}})" type="button" class="btn btn-primary" value="Add To Cart" >
                          <input onclick="performFavoriteStore({{$meal->id }})" type="button" class="btn btn-danger" value="Add To WishList" onclick="myFunction()" >
                        </div>

                        
                        
                            <input type="text" style="display: none ;     width: -webkit-fill-available;" id="panel" placeholder="add comment" >
                          </form> 
                        {{-- </div>
                      </div>
                      
                    </div>
            
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
<<<<<<< HEAD
        </div>  --}}
        {{-- </div>  --}}
      

        <section class="products">

          <h1 class="heading"> Our <span>meals</span> </h1>
      
          <div class="box-container">
            @foreach($meals as $meal)

              <div class="box">
                  <div class="image">
                      <img src="{{Storage::url($meal->image ?? '')}}" class="main-img" alt="">
                      <img src="{{Storage::url($meal->image ?? '')}}" class="hover-img" alt="">
                      <div class="icons">
                        @if(Auth::guard('user')->check())
                        <a onclick="performCartStore({{$meal->id }} ,{{$meal->price}})" class="fas fa-shopping-cart" ></a>
                        <a onclick="performFavoriteStore({{$meal->id }})" class="fas fa-heart"  @if($meal->is_favorite)  style=" background-color: #f33f3f;"   @endif ></a>
                        
                          @else
                          <a   href="{{route('cms.login','user')}}"  class="fas fa-shopping-cart" ></a>
    
                          <a href="{{route('cms.login','user')}}"    class="fas fa-heart" ></a>
                          @endif
    
                          <a href="{{route('front.detail',['meal_id'=>$meal->id])}}" class="fas fa-eye"></a>
                      </div>
                  </div>
                  <div class="content">
                    <h3>{{$meal->title}}</h3>
                    <h4>{{$meal->resturant->name}}</h4>
  
                    <div class="price">${{$meal->price}} </div>
                    <span class="stars">
                    
                      @for($i=1; $i<=$meal->avg_rating; $i++) 
                        <i class="fas fa-star"></i>
                      
                        @endfor
                        @for($i=1; $i<=(5-(int)$meal->avg_rating); $i++) 
                        <i class="fas fa-star" style="color: grey"></i>
                     
                        @endfor
  
                        <small style="font-size: 13px;" class="pt-1">{{$meal->avg_rating}}/5</small>
                        <small style="font-size: 13px;" class="pt-1">( {{$meal->num_reviews }} Reviews )</small>
                        
                        
                    </span>
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
{{-- <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script> --}}
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
{{-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"> --}}
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
{{-- <script>
  function myFunction() {
    document.getElementById("panel").style.display = "block";
  }
  </script> --}}
  <script>
    $(document).ready(function(){
      $("button").click(function(){
        $("panel").toggle();
      });
    });
    </script>

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