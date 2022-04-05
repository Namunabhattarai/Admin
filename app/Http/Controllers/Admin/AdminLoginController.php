<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function adminLogin(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            // dd($data);
            if(Auth::guard('admin')->attempt(['email'=> $data['email'],'password'=>$data['password'], 'status' => 1])){
                return redirect('/admin/dashboard');
            }
            else{
                return redirect()->back();
            }
        }
        return view('admin.auth.login');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
}
