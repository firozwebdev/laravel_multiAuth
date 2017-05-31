<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLoginForm(){
        return view('auth.admin-login');
    }

    public function login(Request $request){
       //validate the form data
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //Attempt to log the in
        if(Auth::guard('admin')->attempt(['email'=> $request->email,'password' => $request->password],$request->remember)){
            return redirect()->intended(route('admin.dashboard'));

        }

        return redirect()->back()->with($request->only('email','remember'));

        //if successfull , then redirect to their inteded location
        //if unsuf , then redirect back to the login with the form data
    }
}
