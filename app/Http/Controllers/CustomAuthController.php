<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function regis ()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function login()
    {
        return view('auth.login');
    }


    public function registrationSubmit (Request $request)
    {
        $request->validate([
           'name' => 'required',
           'username' => 'required|unique:users',
           'email' => 'required|unique:users',
           'password' => 'required|confirmed|min:8',
           'password_confirmation' => 'required',
        ]);


        User::saveUserData($request);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials))
        {
            return redirect()->intended('dashboard')->with('message', 'signed in successfully');
        }

        return redirect('/logins')->with('error', 'login details are not valid');
    }


    public function loginSubmit(Request $request)
    {
        $request->validate([
//           'username' => 'required',
           'email' => 'required',
           'password' => 'required',
        ]);

        $userCheck = User::where('email', $request->email)->orWhere('username', $request->email)->orWhere('name', $request->email)->exists();
        if ($userCheck)
        {
            $user = User::where('email', $request->email)->orWhere('username', $request->email)->orWhere('name', $request->email)->first();
            if (Hash::check($request->password, $user->password))
            {
                $request->offsetSet('email', $user->email);
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials))
                {
                    return redirect()->intended('dashboard')->with('message', 'logged in successfully');
                }
            }
            else {
                return redirect()->back()->with('error', 'password not matched');
            }
        }
        return redirect()->back()->with('error', 'email is not registered');
    }


    public function logout (Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('logins');
    }
}
