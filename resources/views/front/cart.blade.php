@extends('front.parent')
@section('styles')

       {{-- </style>  --}}
{{-- <style> --}}
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    {{-- <link rel="preconnect" href="https://fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">  --}}


    <link href="{{asset('cart/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('cart/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
  

@endsection



@section('content')
    


    <!-- Cart Start -->
    @if($cartisFull)
    <div  class="container-fluid pt-5">
        <div  style=" padding-top: 100px;  padding-bottom: 100px;" class="row px-xl-5">
            <div   class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Meals</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            
                            {{-- <th>Price</th> --}}
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php $total=0; @endphp
                        @foreach ($carts as $cart )

                        <tr>
                            <td style="padding: 2.5rem; font-size:15px;  font-weight: bold;" class="align-middle"><img src="{{Storage::url($cart->meal->image ?? '')}}" alt="" style="width: 100px;">  &nbsp; &nbsp; {{$cart->meal->title}}</td>
                            <td  style="padding: 2.5rem; font-size:20px; "  name="price" class="align-middle">{{$cart->price}} $</td>
                            <td  style="padding: 2.5rem;" class="align-middle">
                                {{-- <div onclick="changequantity('{{$cart->id}}')" id="quantity_{{$cart->id}}" value ="{{$cart->quantity}}" min="1" class="input-group quantity mx-auto" style="width: 100px;">
                                    <div  class="input-group-btn">
                                        <button  class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input  type="text" class="form-control form-control-sm bg-secondary text-center" >
                                    <div class="input-group-btn">
                                        <button  class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div> --}}
                            

                                    <form>
                                    <input class="align-middle" style=" width:200px;  font-size:20px" name="qty" onchange="changequantity('{{$cart->id}}')" id="quantity_{{$cart->id}}" type="number" value ="{{$cart->quantity}}" class="form-control quantity-input"  min="1">
                                    </form>
                            </td>
                            {{-- <td  class="align-middle">
                                <input  style="width:25px" name="price" value ="{{$cart->price}}"/>
                            </td> --}}
                            {{-- <td  class="align-middle" name="price" >{{$cart->price}}</td> --}}
                            <td  class="align-middle"><a onclick="confirmDelete('{{$cart->id}}' ,this)" class="btn btn-sm btn-primary"><i style="font-size: 20px;" class="fa fa-times"></i>
                            </a></td>
                        </tr>
                      @php $total+=$cart->quantity *$cart->price; @endphp
						@endforeach
                   
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
               
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 style="padding: 1.3rem; font-size:15px;  font-weight: bold;" class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>

                  

                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 style="padding: 1.3rem; font-size:20px; " class="font-weight-bold">Total</h5>
                            <h5 style="padding: 1.3rem; font-size:20px;  " id="total" class="font-weight-bold"> {{$total}} $</h5>
                        </div>
                        {{-- value="{{$total}}" --}}
                        <a style="padding: 1.3rem; font-size:15px;  font-weight: bold;"  class="btn btn-block btn-primary my-3 py-3" href="{{route('addresses.index')}}" role="button">Checkout</a>
                    </div>
                </div>
                @else
                <div class="block-heading">
                    <h2>Empty Cart !</h2>
                    <a style="width:200px" href="{{route('front.index')}}" class="btn btn-primary btn-lg btn-block">Continue To shopping!</a>
                  </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    




    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    @endsection
    @section('scripts')
{{-- 
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('front/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('front/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <script src="{{asset('front/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('front/mail/contact.js')}}"></script>

    <script src="{{asset('front/js/main.js')}}"></script> --}}
    <script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>


    <script>
    function changequantity(id) {

        axios.put('/front/carts/'+id, {
            quantity: document.getElementById('quantity_'+id).value,
        })
        .then(function (response) {
            findTotal();
            console.log(response);
            toastr.success(response.data.message);
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
    function findTotal(){
    var arr = document.getElementsByName('qty');
    var price =document.getElementsByName('price').innerHTML;
    alert(price.data);
    // var price = parseFloat(document.getElementsById('price').innerHTML);
	// var price = parseFloat(document.getElementsByName('price').innerHTML.replace(",", "").replace("$", "").val());

    var tot=0;
    for(var i=0;i<arr.length;i++){
        if( parseFloat(arr[i].value) && parseFloat(price[i]) )
            tot += parseFloat(arr[i].value * price[i]);
    }
    document.getElementById('total').value = tot;
}
    
    function confirmDelete(id,reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            performDelete(id,reference);
        }
        });
    }

    function performDelete(id, reference) {
        axios.delete('/front/carts/'+id)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            reference.closest('tr').remove();

            showMessage(response.data);
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
            showMessage(error.response.data);
        });
    }

    function showMessage(data) {
        Swal.fire(
            data.title,
            data.text,
            data.icon
        );
    }
    </script>
    @endsection
