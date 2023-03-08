@extends('cms.parent')

@section('title',__('cms.Orders'))
@section('page-lg',__('cms.index'))
@section('main-pg-md',__('cms.Orders'))
@section('page-md',__('cms.index'))

@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.orders')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.User Name	')}}</th>
                                    <th>{{__('cms.Mobile')}}</th>
                                    <th>{{__('cms.Address')}}</th>
                                    <th>{{__('cms.Order Date')}}</th>
                                    <th>{{__('cms.status')}}</th>
                                    <th>{{__('cms.Net Amount')}}</th>
                                    <th>{{__('cms.Action')}}</th>
                                    {{-- @canany(['Update_Meal','Delete_Meal']) --}}
                                    {{-- @endcanany --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                  
                                    <td>{{$order->user->name}}</td>
                                    <td><span class="badge bg-info">{{$order->user->mobile}}</span></td>
                                    <td>{{$order->address->name}} |{{$order->address->area}} |{{$order->address->street}}|{{$order->address->building}} |{{$order->address->flate_num}}</td>                        
                                    <td>{{$order->date}} </td>

                                    <td> 
                                        <form id="update-status">
                                            @csrf
                                        <select onchange="updateStatus('{{$order->id}}')" class="form-control" id="order_id">
                                        <option value="Waitting"    @if($order->status == 'Waitting') selected @endif>Waitting</option>
                                        <option value="Processing"  @if($order->status == 'Processing') selected @endif >Processing</option>
                                        <option value="Delivered"   @if($order->status == 'Delivered') selected @endif >Delivered</option>
                                        </select>
                                        </form>
                                    </td>                                    
                                    <td>{{$order->total}}$</td>
                                    <td><a href="{{route('admin.ordermeals',['order_id'=>$order->id])}}" class="view" title="View Details" data-toggle="tooltip"><i class="material-icons">&#xE5C8;</i></a></td>
                                 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	
    function updateStatus(id) {
        // alert(document.getElementById('order_id').value);
            axios.put('/cms/admin/orders/'+id, {
                status: document.getElementById('order_id').value,
            })
            .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
            })
            .catch(function (error) {
                console.log(error.response);
                toastr.error(error.response.data.message);
            });
        }
      
    
    </script>
@endsection