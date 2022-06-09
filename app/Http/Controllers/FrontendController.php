<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Hash ;
use App\User;
use Session;

class FrontendController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('login');
    }
    public function showRegisterForm(){
        return view('register');
    }

    public function register(SignupRequest $request){

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('success', 'Đăng kí thành công');
        return redirect()->route('login');
    }
    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            Session::put('user', $request->email);
            if(Auth::attempt($credentials, 'role' == 'admin')) {
                return redirect()->intended('admin')->with('success','Successfully Login');
            }else{
                return redirect()->intended('login')->with('success','Successfully Login');
            }
        }else{
            request()->session()->flash('error','Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }

    public function logout(){
        if(Auth()->check()){
            Session::forget('user');
            Auth::logout();
            request()->session()->flash('success','Đăng xuất thành công');
            return redirect()->route('login');
        }else{
            request()->session()->flash('error','Đăng xuất thất bại');
            return redirect()->route('login');
        }

    }
}
