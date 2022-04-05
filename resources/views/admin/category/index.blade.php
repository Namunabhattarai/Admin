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
                                    {{-- <th>Under Category</th>
                                    <th>Action</th> --}}
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->


@endsection
@section('js')
<script>
    $("#category-datatable").DataTable({
        processing: true,
        serverSide: true,
        sorting: true,
        searchable: true,
        responsive: true,
        ajax: "{{ route('tableCategory') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'category_name', name: 'category_name'},
            // {data: 'parent_id', name: 'parent_id'},
            // {data: 'action', name: 'action', orderable: false},
        ]
    });
</script>
@endsection