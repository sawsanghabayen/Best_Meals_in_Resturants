@extends('cms.parent')

@section('title','Temp')
@section('page-lg','Temp')
@section('main-pg-md','CMS')
@section('page-md','Temp')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.edit_restaurant')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="update-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" placeholder="{{__('cms.name')}}" value="{{$resturant->name}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('cms.email')}}</label>
                                <input type="email" class="form-control" id="email" placeholder="{{__('cms.email')}}" value="{{$resturant->email}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="mobile">{{__('cms.mobile')}}</label>
                                <input type="text" class="form-control" id="mobile" placeholder="{{__('cms.mobile')}}" value="{{$resturant->mobile}}">
                            </div>
                            <div class="form-group">
                                <label for="telephone">{{__('cms.telephone')}}</label>
                                <input type="text" class="form-control" id="telephone" placeholder="{{__('cms.telephone')}}" value="{{$resturant->telephone}}">
                            </div>
                            
                            <div class="form-group">
                                <label>{{__('cms.city')}}</label>
                                <select class="form-control" id="city_id">
                                    @foreach ($cities as $city)
                                    <option value="{{$city->id}}" @if($resturant->city_id == $city->id) selected @endif>{{$city->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="address">{{__('cms.address')}}</label>
                            <input type="text" class="form-control" id="address" placeholder="{{__('cms.address')}}" value="{{$resturant->address}}">
                        </div>
                            
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{$resturant->id}}')"
                                class="btn btn-primary">{{__('cms.save')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
{{-- <script src="{{asset('js/axios.js')}}"></script> --}}
<script>
    function performUpdate(id) {
        axios.put('/cms/admin/resturants/{{$resturant->id}}', {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            mobile: document.getElementById('mobile').value,
            telephone: document.getElementById('telephone').value,
            city_id: document.getElementById('city_id').value,
            address: document.getElementById('address').value,


            // role_id: document.getElementById('role_id').value,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/resturants';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection