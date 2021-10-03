<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return format_response('error', 200, 'error validation', $validator->getMessageBag());
        }

        //Request is validated
        //Crean token
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return format_response('failed', 400, 'login credentials invalid', null);
            }
        } catch (JWTException $e) {
            return format_response('failed', 500, 'failed created token!', null);
        }

        //Token created, return with success response and jwt token
        return format_response('success', Response::HTTP_OK, 'login success', ['token' => $token]);
    }

    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('nama', 'email', 'password', 'hp');
        $validator = Validator::make($data, [
            'nama' => 'required|string',
            'email' => 'required|email|unique:tb_user',
            'password' => 'required|string|min:6|max:50',
            'hp' => 'required',
            'role' => 'user'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return format_response('error', Response::HTTP_BAD_REQUEST, 'error validation', $validator->getMessageBag());
        }

        //Request is valid, create new user
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hp' => $request->hp,
            'role' => 'user'
        ]);

        //User created, return success response
        return format_response('success', Response::HTTP_OK, 'user successfully created', $user);
    }

    public function userProfile()
    {
        try {
            $user = JWTAuth::user();
            return format_response('success', Response::HTTP_OK, 'user successfully fetch', $user);
        } catch(JWTException $e) {
            return format_response('error', Response::HTTP_INTERNAL_SERVER_ERROR, 'can not fetch user data', null);
        }
    }
}
