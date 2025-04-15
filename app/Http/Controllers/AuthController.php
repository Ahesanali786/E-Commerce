<?php

namespace App\Http\Controllers;

use App\Mail\OtpSend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('Auth.register');
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4|confirmed',
            // 'password_confirmation' => 'required|string|min:4|confirmed',
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if ($request->password == $request->password_confirmation) {

                // Mail::to($user->email)->send(new OtpSend($user));
                $user->save();
                return redirect()->route('login')->with('success', 'User Registretion successfully');
            } else {
                return redirect()->back()->with('error', 'Please Chack your Confirm Password...');
            }
        } catch (\Exception  $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'opps Try Again......');
        }
    }
    public function login()
    {
        return view('Auth.login');
    }
    public function chack_auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4',
        ]);
        // dd(Auth::attempt($credentials));
        try {
            if (Auth::attempt($credentials)) {
                    return redirect()->route('home.page')->with('success', 'User Login Successfully');
            }else {
                return redirect()->back()->with('error', 'opps Try Again......');
            }
        }  catch (\Exception  $e) {
            return redirect()->back()->with('error', 'opps Try Again......');
        }
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
    public function otpsend(){
        return view('emailsend.otp');
    }
}
