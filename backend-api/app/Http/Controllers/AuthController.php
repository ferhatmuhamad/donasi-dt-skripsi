<?php

namespace App\Http\Controllers;

use App\Models\DonasiModel;
use App\Models\ForgotPasswordModel;
use App\Models\User;
use Carbon\Carbon;
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
        $this->middleware('auth:api', ['except' => ['login', 'register', 'forgotPassword', 'prosesForgotPassword']]);
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

    public function forgotPassword(Request $request) {

        $email = $request->email;

        $data = $request->only('email');
        $validator = Validator::make($data, [
            'email' => 'required|email',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return format_response('error', Response::HTTP_BAD_REQUEST, 'error validation', $validator->getMessageBag());
        }

        $datauser = User::where('email', $email)->first();

        if($datauser == null) {
            return format_response('error', Response::HTTP_NOT_FOUND, 'user not found!', null);
        }

        // restrict brute force token
        $searchForgotPassword = ForgotPasswordModel::where('id_user', $datauser->id_user)->where('status', 0)->orderBy('created_at', 'desc')->first();
        
        if($searchForgotPassword) {
            if((time() - strtotime($searchForgotPassword->updated_at)) < 180) {
                return format_response('failed', Response::HTTP_BAD_REQUEST, 'Too many request!. Please wait', null);
            }
        }    


        $hashToken = md5($datauser->email . '-' . time());

        $forgetPassword = ForgotPasswordModel::create([
            'id_user' => $datauser->id_user,
            'token' => $hashToken,
            'link' => 'forgot-password/' . $hashToken,
            'status' => 0
        ]);

        return format_response('success', Response::HTTP_OK, 'Reset password link has been sent to email!', null);

    }

    public function prosesForgotPassword(Request $request) {

        $data = $request->only('email', 'password', 'token');

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50',
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return format_response('error', Response::HTTP_BAD_REQUEST, 'error validation', $validator->getMessageBag());
        }

        // get token
        $tokenForgot = ForgotPasswordModel::where('token', $request->token)->first();

        if($tokenForgot == null) {
            return format_response('failed', Response::HTTP_UNAUTHORIZED, 'error token', null);
        }

        $datauser = User::where('email', $request->email)->first();

        if($datauser == null) {
            return format_response('error', Response::HTTP_NOT_FOUND, 'user not found!', null);
        }

        $passwordHash = Hash::make($request->password);

        $datauser->password = $passwordHash;
        $datauser->save();

        $tokenForgot->status = 1;
        $tokenForgot->save();

        return format_response('success', Response::HTTP_OK, 'success change password!', $passwordHash);

    }

    public function userProfile()
    {
        try {
            $user = JWTAuth::user();

            $total_donation = DonasiModel::where('id_user', $user->id_user)->where('status', 'success')->sum('amount');

            $user->total_donation = $total_donation;

            return format_response('success', Response::HTTP_OK, 'user successfully fetch', $user);
        } catch(JWTException $e) {
            return format_response('error', Response::HTTP_INTERNAL_SERVER_ERROR, 'can not fetch user data', null);
        }
    }

    
}
