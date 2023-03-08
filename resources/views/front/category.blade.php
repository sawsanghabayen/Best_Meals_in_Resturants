@extends('front.parent')
@section('styles')
<link href="{{asset('front/assets/css/stylegallery.css')}}" rel="stylesheet">
<style>
section  {
  padding:9rem 9%;
}
</style>
@endsection
@section('content')

{{-- <form  class="form-inline" action="{{route('front.categories')}}" method="get" >  
  <label>{{__('cms.category')}}</label>
  <select class="form-control" name="category">
    <option value="-1">All Category </option>
    @foreach ( App\Models\Category::all() as $category )
    <option value="{{$category->id}}">{{$category->name}}</option>
    @endforeach
  </select>
  <button type="submit" class="btn btn-outline-dark">Search</button>
  {{-- <button type="submit" class="btn btn-outline-dark">Search</button> --}}
{{-- </form>  --}}
    
<!-- gallery section starts  -->

<section class="gallery" id="gallery">

  <h1 class="heading"> our <span> Categories </span> </h1>

  <div class="box-container">
    @foreach ( $categories as $category )
    <div class="box">
      <div class="image">
        <img src="{{Storage::url($category->image ?? '')}}" class="main-img" alt="">
      </div>
        <div class="content">
            <h3>{{$category->name}}</h3>
            <p>{{$category->description}}</p>
            <a href="{{route('front.meals',['category_id'=>$category->id])}}" class="btn">Show Meals</a>
        </div>
    </div>
    
    @endforeach
  </div>

</section>

<!-- gallery section ends -->

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
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>

  // $('#category_id').on('change',function(){
  //     if(this.value!==-1)
  //     getCategories(this.value);
  //     // else
  //     // $('#sub_category_id').empty();

  // });

  //  function getCategories(categoryId){
  //     axios.get('/front/categories/'+categoryId)
  //     .then(function (response) {
  //         console.log(response);
  //         // console.log(response.data.data);
  //         // $('#sub_category_id').empty();
  //         // $.each(response.data.data , function(i, item){
  //         //  $('#sub_category_id').append(new Option(  item['title'] ,item['id'] ))
  //         //  });
         
          
  //     }).catch(function (error) {
  //         console.log(error.response);
  //     });
  // }
</script>
@endsection


  