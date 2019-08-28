<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\User;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth', ['except' => ['login', 'register']]);
//        $this->middleware('JWT', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {

            if (! $token = $this->jwt->attempt($request->only('email', 'password' ))) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }

        return response()->json(compact('token'));
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function create(Request $request)
    {
            // validate
            $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            ]);

        try {
            //create user
            $user= new User;

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->email_verified_at= null;
            $user->password = Hash::make($request->input('password'));

            if ($user->save()) {
                return [
                    'status' => 'successful',
                    'message' => 'user created'
                ];
            }
        } catch (Exception $e) {
            return response()->json($e->message());
        }
    }


    /*
    *Authenticate user and return the currently logged in user's data
    *
    *@return \Illuminate\Http\JsonResponse
    */
    public function me()
    {
        return response()->json(User::first());
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->jwt->parseToken()->invalidate();

        return response()->json(['message' => 'Successfully logged out']);
    }

}