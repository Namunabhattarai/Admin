<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use DataTables;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
   public function index(){
       $categories=Category::latest()->get();
       return view('admin.category.index',compact('categories'));
   }

    public function addCategory(){
        $categories = Category::where('parent_id', 0)->get();
        return view('admin.category.add', compact('categories'));
    }
    public function storeCategory(Request $request){
        $data = $request->all();
        $rules = [
            'category_name' => 'required|max:255',
            
        ];
        $customMessages = [
            'category_name.required' => 'Category name is required',
            'category_name.max' => 'You are not allowed to enter more than 255 characters',
            
        ];
        $this->validate($request, $rules, $customMessages);

        $slug = Str::slug($data['category_name']);
        $categoryCount = Category::where('slug', $slug)->count();

        if($categoryCount > 0){
            Session::flash('error_message', 'Category name already exists in our database');
            return redirect()->back();
        }

        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->slug = Str::slug($data['category_name']);
        $category->parent_id = $data['parent_id'];
        if(empty($data['status'])){
            $category->status = 'Inactive';
        }
        else{
            $category->status = 'Active';
        }
        $category->save();
        Session::flash('success_message', 'Category Has Been Added Successfully');
        return redirect()->back();
    }
    public function dataTable(){
        $model = Category::all();
        return DataTables::of($model)
            ->addColumn('action', function ($model){
                return view ('admin.category._actions', [
                   'model' => $model,
                    'url_edit' => route('editCategory', $model->id),
                    'url_delete' => route('deleteCategory', $model->id),
                ]);
            })
            ->editColumn('parent_id', function ($model){
                if($model->parent_id == 0){
                    return "Main Category";
                } else {
                    return $model->subCategory->category_name;
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
    public function editCategory($id){
        $categoryData = Category::findOrFail($id);
        $categories = Category::where('parent_id', 0)->get();
        return view ('admin.category.edit', compact('categoryData', 'categories'));
    }

    // Update Category
    public function updateCategory(Request $request, $id){
        $data = $request->all();
        $rules = [
            'category_name' => 'required|max:255',
        
        ];
        $customMessages = [
            'category_name.required' => 'Category name is required',
            'category_name.max' => 'You are not allowed to enter more than 255 characters',
           
        ];
        $this->validate($request, $rules, $customMessages);

        $slug = Str::slug($data['category_name']);


        $category = Category::findOrFail($id);
        $category->category_name =$data['category_name'];
        $category->slug = Str::slug($data['category_name']);
        $category->parent_id = $data['parent_id'];

        if(!empty($data['status'])){
            $category->status = 'Active';
        } else {
            $category->status = 'Inactive';
        }

        $category->save();
        Session::flash('success_message', 'Category Has Been Updated Successfully');
        return redirect()->back();
    }

    public function deleteCategory($id){
        $category = Category::findOrFail($id);
        $category->delete();
        DB::table('categories')->where('parent_id', $id)->delete();
        Session::flash('success_message', 'Category Has Been Deleted Successfully');
        return redirect()->back();
    }


  





}
