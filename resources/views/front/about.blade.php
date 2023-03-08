
@extends('front.parent')
@section('content')
@section('styles')
<style>
</style>
@endsection
  

   
    
    <div class="team-members">
      <div style=" padding-top: 100px;" class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Our Restaurants</h2>
            </div>
          </div>
          @foreach ($resturants as $resturant )
            
          <div class="col-md-4">
            <div class="team-member">
              <div class="thumb-container">
                <img  src="{{Storage::url($resturant->image ?? '')}}" />
                {{-- <img src="{{asset('front/assets/images/restaurant.jpeg')}}" alt=""> --}}
                <div class="hover-effect">
                  <div class="hover-content">
                    <ul class="social-icons">
                      <a style=" background-color:white"  href="{{route('front.meals',['rest_id'=>$resturant->id])}}" class="btn">Show Meals</a>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="down-content">
                <h4 style="font-size: 20px;">{{$resturant->name}}</h4>
                <h4 style="font-size: 15px;">{{$resturant->mobile}}</h4>
                <span style="font-size: 15px;">{{$resturant->city->name}}</span>
                <p>{{$resturant->address}}</p>
              </div>
            </div>
          </div>
          @endforeach


        </div>
      </div>
    </div>

    <div class="best-features about-features">
      <div style=" padding-bottom: 100px;" class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Our Background</h2>
            </div>
          </div>
          {{-- <div class="col-md-6"> --}}
            {{-- <div class="right-image">
              <img src="{{asset('front/assets/images/about2.jpeg')}}" alt="">
            </div> --}}
          {{-- </div> --}}
          {{-- <div class="col-md-6"> --}}
            <div class="left-content">
              <h4>Who we are &amp; What we do?</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat. Lorem ipsum dolor sit amet, consectetur adipisicing elit.<br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti eum ratione ex ea praesentium quibusdam? Aut, in eum facere corrupti necessitatibus perspiciatis quis.</p>
              <ul class="social-icons">
                
                
              </ul>
            {{-- </div> --}}
          </div>
        </div>
      </div>
    </div>

 
    @endsection




   