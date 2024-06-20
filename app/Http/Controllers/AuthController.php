<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    // Register Business Logic Start

    public function register(){
        return view('Auth.Register');
    }

    public function storeRegister(Request $request){
        $request->validate([
            'name'=>'required|string|min:3',
            'email'=>'required|email|unique:users',
            'password'=>['required',Rules\Password::Default(),'confirmed'],
        ]);
        // print_r($request->toArray());
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        return redirect()->route('login')->with(['message'=>'Register Successfully']);

    }

    // Register Business Logic Start




    // Register Business Login Start

    public function login(){
        return view('Auth.Login');
    }

    public function storeLogin(Request $request){
        $request->validate([
            'email'=>'required|email|string',
            'password'=>'required|string|min:8',
        ]);
       $user= User::where('email',$request->email)->get();
       if($user->count() >0){
           if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                session()->put(['email'=>$request->email]);
               return redirect()->route('dashboard')->with(['welcome'=>$user[0]['name']]);
            }else{
                return back()->with(['error'=>'Invalid Login Crediantials']);
            }
        }else{
            return back()->with(['error'=>'Email not register yet ?']);
        }
    }
    // Register Business Login Start

    public function logout(){
        session()->flush();
        return redirect()->route('login');
    }
}
