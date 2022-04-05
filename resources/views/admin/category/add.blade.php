@extends('admin.includes.admin_design')
@section('content')
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">
            <strong>Basic Form</strong> Elements
        </div>
        <div class="card-body card-block">
            @include('admin.includes._message')
            <form action="{{route('storeCategory')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="row form-group">
                    <div class="col col-md-3"><label for="parent_id" class=" form-control-label">Category <span class="text-danger">*</label></div>
                    <div class="col-12 col-md-9">
                        <select name="parent_id" id="parent_id" class="form-control-sm form-control">
                            <option value="0">Main Category</option>
                        
                            
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="name" class=" form-control-label">Category Name<span class="text-danger">*</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="name" name="category_name" placeholder="Enter category name" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="status" class=" form-control-label">Status</label></div>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="checkbox" name="status" checked data-toggle="toggle" data-size="xs" value="1">
                         <label>Active</label>
                    </div>
                </div>
               
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    
                </div>
               
                
               
                   
                    
                   
                    
                    
            </form>
        </div>
        
    </div>
   
</div>
@endsection