<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index() {
        $userdata = UserModel::get();

        $data = [
            'users' => $userdata
        ];

        return view('user.index', $data);
    }

    // FOR BLADE TEMPLATE
    public function showLoginPage() {
        if(Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function prosesLogin(Request $request) {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = Validator::make($data, $rules);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return redirect('/auth/login')->with('error', $validator->getMessageBag());
        }

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            return redirect('dashboard');
        } else {
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
        
    }

    public function prosesLogout() {
        Auth::logout();

        return redirect('/');
    }
}
