@extends('cms.parent')

@section('title',__('cms.categories'))
@section('page-lg',__('cms.index'))
@section('main-pg-md',__('cms.categories'))
@section('page-md',__('cms.index'))

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.categories')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.image')}}</th>
                                    <th>{{__('cms.title')}}</th>
                                    <th>{{__('cms.category')}}</th>
                                    <th>{{__('cms.resturant_name')}}</th>
                                    <th>{{__('cms.description')}}</th>
                                    <th>{{__('cms.price')}}</th>
                                    <th>{{__('cms.created_at')}}</th>
                                    <th>{{__('cms.updated_at')}}</th>
                                    {{-- @canany(['Update_Meal','Delete_Meal']) --}}
                                    <th style="width: 40px">{{__('cms.settings')}}</th>
                                    {{-- @endcanany --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meals as $meal)
                                <tr>
                                    <td>{{$meal->id}}</td>
                                    <td>
                                        <img height="80" src="{{Storage::url($meal->image ?? '')}}" />
                                    </td>
                                    <td>{{$meal->title}}</td>
                                    <td><span class="badge bg-info">{{$meal->category->name}}</span></td>
                                    <td><span class="badge bg-info">{{$meal->resturant->name}}</span></td>
                                    <td>{{$meal->description}}</td>
                                    <td>{{$meal->price}}</td>
                                    <td>{{$meal->created_at}}</td>
                                    <td>{{$meal->updated_at}}</td>
                                    @canany(['Update-Meal','Delete-Meal'])
                                    <td>
                                        <div class="btn-group">
                                            @can('Update-Meal')
                                            <a href="{{route('meals.edit',$meal->id)}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('Delete-Meal')
                                            <a href="#" onclick="confirmDelete('{{$meal->id}}', this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            @endcan
                                        </div>
                                        
                                    </td>
                                    @endcanany
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
    function confirmDelete(id, reference) {
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
            performDelete(id, reference);
        }
        });
    }

    function performDelete(id, reference) {
        axios.delete('/cms/admin/meals/'+id)
        .then(function (response) {
            console.log(response);
            // toastr.success(response.data.message);
            reference.closest('tr').remove();
            showMessage(response.data);
        })
        .catch(function (error) {
            console.log(error.response);
            // toastr.error(error.response.data.message);
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