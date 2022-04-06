<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('category')->latest()->get();
        return view ('admin.product.index', compact('products'));
    }

    // Add Product
    public function addProduct(){
        $categories = Category::where('parent_id', 0)->where('status', 'active')->orderBy('category_name', 'ASC')->get()->toArray();
        return view ('admin.product.add', compact('categories'));

    }
    public function storeProduct(Request $request){
        $data = $request->all();
        $product = new Product();


        $rules = [
            'product_name' => 'required|max:255',
            'category_id' => 'required',
            'price' => 'required',

        ];
        $customMessages = [
            'product_name.required' => 'Product Name cannot be left empty',
            'product_name.max' => 'You are not allowed to enter more than 255 characters',
            'price.required' => 'Please provide product price',

        ];
        $this->validate($request, $rules, $customMessages);
        $product->product_name = $data['product_name'];
        $product->price = $data['price'];
        $product->slug = Str::slug($data['product_name']);
        $product->category_id = $data['category_id'];
        $random = Str::random(10);
        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random . '.' . $extension;
                $image_path = 'public/uploads/products/' . $filename;
                Image::make($image_tmp)->save($image_path);
                $product->image = $filename;

            }
        }
       

        if(!empty($data['excerpt'])){
            $product->excerpt = $data['excerpt'];
        } else {
            $product->excerpt = "";
        }

        if (empty($data['status'])){
            $product->status = "inactive";
        } else {
            $product->status = "active";
        }


        $product->save();
        Session::flash('success_message', 'Product Has Been Added Successfully');
        return redirect()->back();
    }
    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::where('parent_id', 0)->where('status', 'active')->orderBy('category_name', 'ASC')->get()->toArray();
        $sub_categories = Category::where('parent_id', '!=', 0)->where('status', 'active')->orderBy('category_name', 'ASC')->get()->toArray();
        return view ('admin.product.edit', compact('categories', 'product', 'sub_categories'));
    }



  

}
