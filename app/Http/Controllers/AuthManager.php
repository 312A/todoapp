<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthManager extends Controller
{
    //
    public function login(){
       return  view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email'=> 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ]);
        }
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route("home"));
            // $request->session()->regenerate();
            // return response()->json([
            //     'status' => true,
            //     'redirect' => route('home'),
            // ]);
        }
        return redirect(route("login"))->with("error","Invalid Email or Password");
        // return response()->json([
        //     'status' => false,
        //     'errors' => ['The provided credentials are incorrect']
        // ]);
    }
    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function registerPost(Request $request){
        $request->validate([
            'fullname'=>'required',
            'email'=> 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|recaptcha'
            // 'g-recaptcha-response' => 'required',
        ]);
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'=>config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);
        if (!$response->json()['success']) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed.'])->withInput();
        }
        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password= $request->password;
        if($user->save()){
            return redirect(route("login"))
            ->with("success","Registration Successfull");
        };

        return redirect(route("register"))
            ->with("error","Registration Failed");
    }

    // public function registerPost(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'fullname' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|min:6|confirmed',
    //         'g-recaptcha-response' => 'required|recaptcha',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
    //         'secret' => env('RECAPTCHA_SECRET'),
    //         'response' => $request->input('g-recaptcha-response'),
    //         'remoteip' => $request->ip(),
    //     ]);

    //     if (!$response->json()['success']) {
    //         return redirect()->back()
    //             ->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed.'])
    //             ->withInput();
    //     }

    //     $user = new User();
    //     $user->name = $request->fullname;
    //     $user->email = $request->email;
    //     $user->password = bcrypt($request->password);

    //     if ($user->save()) {
    //         return redirect(route("login"))
    //             ->with("success", "Registration successful");
    //     } else {
    //         return redirect(route("register"))
    //             ->with("error", "Registration failed");
    //     }
    // }


}
