<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function login(){
        return view('ecommerce.auth.login');
    }

    public function register(){
        return view('ecommerce.auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:customers|max:120',
            'email' => 'required|unique:customers',
            'password' => 'required|confirmed|max:20'
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password)
        ]);
        return redirect('/');
    }

    public function loginCheck(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required|max:20'
        ]);
        $customer = Customer::where('email','=',$request->email)->first();
        if ($customer){
            if (Hash::check($request->password,$customer->password)){
                $request->session()->put('customer_logged_in',$customer->email);
                return redirect('/');
            }else{
                return back();
            }
        }else{
            return back();
        }

    }

    public function logout(){
        if (session()->has('customer_logged_in')){
            session()->pull('customer_logged_in');
            return redirect('/customer/login');
        }
        return back();
    }

}
