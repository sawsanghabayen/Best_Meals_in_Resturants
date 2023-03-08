

@extends('front.parent')
@section('styles')
    

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    {{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">  --}}


    <link href="{{asset('cart/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('cart/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
    {{-- <style>
        .home .slide{
            padding: 2rem 0;
                }
                section {
                padding: 9rem 9%;
                }      

    </style> --}}

    @endsection



@section('content')
      




    <!-- Checkout Start -->
    <div    style=" padding-left: 0px;  padding-right: 0px;" class="container-fluid pt-5">
        <div style=" padding-top: 100px;  padding-bottom: 100px;" class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">

                    <h2 style="  font-weight: bold; font-size:30px;"  class="font-weight-semi-bold mb-4">Billing Address</h2>


                    
                    <div class="row">
                        <table class="table table-bordered">
                            <tr><td><strong style=" font-size:20px;  " >DELEVERY ADDRESSES</strong> </td></tr>
                            <form >
                            @foreach ($addresses as $address )
                                
                            <tr>
                                <td>
                                    <div class="control-group" style="float: left; margin-top:-2px; margin-right:5px;">
                                    
                                       <input type="radio" id="{{$address->id}}" name="address_id" value="{{$address->id}}">
                                        
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">
                                          {{$address->name}} ,{{$address->area}} ,{{$address->building}} 
                                          ,{{$address->street}} ,{{$address->flate_num}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        {{-- <div class="card-footer border-secondary bg-transparent">
                          
                            <button onclick="performPlaceOrder()" id="button" type="button" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                        </div> --}}
                    {{-- </form> --}}
                        <div class="col-md-12 form-group">
                           
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input style=" font-size:30px;"type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address" style=" font-size:20px;"><strong>Ship to different address</strong></label>
                            </div>
                        </div>
                    </div>
                 

                </div>
                <div class="collapse mb-4" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4" >Shipping Address</h4>
                    <form id="save-address">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input style=" font-size:20px;" id="name" class="form-control" type="text" placeholder="city">
                        </div>
                        <div class="col-md-6 form-group">
                            <label style=" font-size:20px;">Area</label>
                            <input style=" font-size:20px;" id="area" class="form-control" type="text" placeholder=" area">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Street</label>
                            <input style=" font-size:20px;"id="street" class="form-control" type="text" placeholder="street ">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Building</label>
                            <input style=" font-size:20px;"id="building" class="form-control" type="text" placeholder=" building">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Flat Num</label>
                            <input style=" font-size:20px;" id="flate_num" class="form-control" type="text" placeholder="123">
                        </div>
                    </div>
                    <a style="width:200px; font-size:20px;" class="btn btn-block btn-primary my-3 py-3" type="button" onclick="performSaveAddress()" >Save Address</a>

                </form>
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 style=" font-size:20px;" class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 style=" font-size:20px;" class="font-weight-medium mb-3">Meals</h5>
                        {{-- <span style=" font-size:20px;" class="font-weight-medium mb-3">Quantity</span> --}}

                        @php $total=0; @endphp
                        @foreach ($carts as  $cart)
                            
                        <div class="d-flex justify-content-between">
                            <h5 style=" font-size:15px;">{{$cart->meal->title}}</h5>
                            <h5 style=" font-size:20px;">{{$cart->quantity}}</h5>
                            <h5 style=" font-size:20px;">${{$cart->price}}</h5>
                        </div>
                        @php $total+=$cart->quantity * $cart->price; @endphp
                        @endforeach
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 style=" font-size:20px;" class="font-weight-bold">Total</h5>
                            <h5 style=" font-size:20px;"  class="font-weight-bold">${{$total}}</h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                
                    <div class="card-footer border-secondary bg-transparent">
                        <button style=" font-size:20px;" onclick="performPlaceOrder({{$total}})" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
  


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('front/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('front/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('front/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('front/mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('front/js/main.js')}}"></script>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>

<script>


function performPlaceOrder(total) {
        axios.post('/front/orders', {
            total:total,
            address_id:  document.querySelector('input[type=radio][name=address_id]:checked').value,
       })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }





function performSaveAddress() {
        axios.post('/front/addresses', {
			name: document.getElementById('name').value,
            area: document.getElementById('area').value,
            street: document.getElementById('street').value,
            building: document.getElementById('building').value,
            flate_num: document.getElementById('flate_num').value,
       
       })
        .then(function (response) {
            console.log(response);
            window.location.href = '/front/addresses';
			document.getElementById('save-address').reset();
            // toastr.success(response.data.message);
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
</html>