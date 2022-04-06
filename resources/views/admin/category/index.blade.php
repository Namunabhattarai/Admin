@extends('admin.includes.admin_design')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                    </div>
                    <div class="card-body">
                        <table id="category-datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Category Name</th>
                                    <th>Under Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>
                                        @if($category->parent_id == 0)
                                            Main Category
                                         @else
                                         {{$category->subCategory->category_name}}   
                                        @endif
                                    </td>
                                    <td>
                                        @if($category->status == 'Active')
                                        <span class="badge badge-success">{{$category->status}}</span>
                                    @else
                                        <span class="badge badge-danger">{{$category->status}}</span>
                                    @endif
                                        
                                    </td>    
                                    <td><a href="{{route('editCategory',$category->id)}}" data-toggle="tooltip" title="Edit" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('deleteCategory',$category->id)}}" data-toggle="tooltip" title="Delete" class="btn btn-sm btn-outline-danger btnDelete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                    
                                </tr>   
                                @endforeach

                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->


@endsection
@section('js')
<script src="{{ asset('public/dashboard/assets/js/jquery.sweet-alert.custom.js') }}"></script>
<script src="{{ asset('public/dashboard/assets/js/sweetalert.min.js') }}"></script>

<script>
$('body').on('click', '.btnDelete', function (event){
    event.preventDefault();
    var SITEURL = '{{ URL('/') }}';
    var id = $(this).attr('rel1');
    var deleteFunction = $(this).attr('rel');
    swal({
            title: "Are You Sure? ",
            text: "You will not be able to recover this record again",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Delete it!"
        },
        function () {
            window.location.href = SITEURL + "/admin/"  + deleteFunction + "/" + id;
        });
})
<script>

@endsection