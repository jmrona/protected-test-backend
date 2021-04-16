<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'firstName' => 'required',
            'lastName' => 'required',
            'userName' => ' required|unique:users',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'ok' => false,
                'msg' => 'Bad request'
            ]);
        }

        $user = new User;
        $user->firstName = e($request->firstName);
        $user->lastName = e($request->lastName);
        $user->userName = e($request->userName);
        $user->canSignIn = true;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => 200,
            'ok' => true,
            'msg' => 'User registered succesfully',
        ]);

    }

    public function login( Request $request ){
        $validator = Validator::make($request->all(),[
            'userName' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'The username or password is invalid'
            ]);
        }

        $credentials = $request->only('userName', 'password');

        if(!Auth::attempt($credentials)){
            return response()->json([
                'status' => 400,
                'msg' => 'Credencential doesn\'t exist'
            ]);
        }

        $user = User::where('userName',$request->userName)->first();

        if($user->canSignIn === 0 || $user->canSignIn === false){
            return response()->json([
                'status' => 400,
                'ok' => false,
                'msg' => 'Access denied',
                'as' => $user->canSighIn
            ]);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status' => 200,
            'ok' => true,
            'msg'=> 'Logged successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function getUser(){

        $user = Auth::user();
        if(!$user){
            return response()->json([
                'status' => 400,
                'ok' => false,
                'msg' => 'User no found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'ok' => true,
            'msg' => 'Getting user successfully',
            'user' => $user
        ]);
    }

    public function logout( Request $request ){
        $request->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'ok' => true,
            'msg' => 'Token deleted successfully'
        ]);
    }
}
