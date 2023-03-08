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
                        <h3 class="card-title">{{__('cms.edit_meal')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                        <div class="form-group">
                            <label>{{__('cms.category')}}</label>
                            <select class="form-control" id="category_id">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('cms.title')}}</label>
                            <input type="text" class="form-control" id="title" placeholder="{{__('cms.title')}}" value="{{$meal->title}}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('cms.description')}}</label>
                            <input type="text" class="form-control" id="description" placeholder="{{__('cms.description')}}" value="{{$meal->description}}">
                        </div>
                        <div class="form-group">
                            <label for="price">{{__('cms.price')}}</label>
                            <input type="text" class="form-control" id="price" placeholder="{{__('cms.price')}}" value="{{$meal->price}}">
                        </div>
                        <div class="form-group">
                            <label for="meal_image">meal Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="meal_image">
                                    <label class="custom-file-label" for="meal_image">Choose file</label>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="button" onclick="performUpdate($meal->id)"class="btn btn-primary">
                             {{__('cms.save')}}</button>
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
<script>
$(function () { bsCustomFileInput.init() });
</script>
<script>
function performUpdate(id) {
    var formData = new FormData();
        formData.append('category_id', document.getElementById('category_id').value);
        formData.append('title', document.getElementById('title').value);
        formData.append('price', document.getElementById('price').value);
        if(document.getElementById('meal_image').files[0] != undefined) {
            formData.append('image',document.getElementById('meal_image').files[0]);
        }
        formData.append('_method','PUT');        
        // formData.append('active', document.getElementById('active').checked ? 1 : 0);

        axios.post('/cms/admin/meals',formData)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/meals';

        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection