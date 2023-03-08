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
                        <h3 class="card-title">{{__('cms.create_restaurant')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {{-- enctype="multipart/form-data" --}}
                    <form id="create-resturant">
                        @csrf
                        <div class="card-body">
                        
                            <div class="form-group">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" placeholder="{{__('cms.name')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('cms.email')}}</label>
                                <input type="email" class="form-control" id="email" placeholder="{{__('cms.email')}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="mobile">{{__('cms.mobile')}}</label>
                                <input type="text" class="form-control" id="mobile" placeholder="{{__('cms.mobile')}}">
                            </div>
                            <div class="form-group">
                                <label for="telephone">{{__('cms.telephone')}}</label>
                                <input type="text" class="form-control" id="telephone" placeholder="{{__('cms.telephone')}}">
                            </div>
                            
                            <div class="form-group">
                                <label>{{__('cms.city')}}</label>
                                <select class="form-control" id="city_id">
                                    @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <label for="address">{{__('cms.address')}}</label>
                            <input type="text" class="form-control" id="address" placeholder="{{__('cms.address')}}">
                            <div class="form-group">
                                <label for="resturant_image">Resturant Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="resturant_image">
                                        <label class="custom-file-label" for="resturant_image">Choose file</label>
                                    </div>
                                
                                </div>
                            </div>
                        </div>

                            
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performStore()"
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
{{-- <script>
    $(function () { bsCustomFileInput.init() });
</script> --}}
<script>
    function performStore() {

        var formData = new FormData();
        formData.append('name', document.getElementById('name').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('mobile', document.getElementById('mobile').value);
        formData.append('telephone', document.getElementById('telephone').value);
        formData.append('city_id', document.getElementById('city_id').value);
        formData.append('address', document.getElementById('address').value);
        formData.append('image',document.getElementById('resturant_image').files[0]);


        axios.post('/cms/admin/resturants',formData)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-resturant').reset();
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
        }
</script>
@endsection