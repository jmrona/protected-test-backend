<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'Asc')->get();
        if(!$users){
            return response()->json([
                'status' => 400,
                'ok' => false,
                'msg' => 'No users found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'ok' => true,
            'msg' => 'Users loaded',
            'users' => $users
        ]);

    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'firstName' => 'required',
            'lastName' => 'required',
            'userName' => ' required|unique:users',
            'password' => ' required|min:6',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'ok' => false,
                'msg' => 'Fields are required'
            ]);
        }

        $user = new User;
        $user->firstName = e($request->firstName);
        $user->lastName = e($request->lastName);
        $user->userName = e($request->userName);
        $user->password = Hash::make($request->password);
        if($request->darkMode && $request->darkMode != "2"){
            $user->darkMode = $request->darkMode;
        }
        if($request->canSignIn && $request->canSignIn != "2"){
            $user->canSignIn = $request->canSignIn;
        }
        $user->save();

        return response()->json([
            'status' => 200,
            'ok' => true,
            'msg' => 'User created succesfully',
            'users' => User::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_updated = User::where('id', $id)->first();

        if(!$user_updated){
            return response()->json([
                'status' => 400,
                'ok' => false,
                'msg' => 'User no found'
            ]);
        }

        if($request->firstName){
            $user_updated->firstName = e($request->firstName);
        }

        if($request->lastName){
            $user_updated->lastName = e($request->lastName);
        }

        if($request->userName){
            $user_updated->userName = e($request->userName);
        }

        if($request->darkMode != '2'){
            $user_updated->darkMode = $request->darkMode;
        }

        if($request->canSignIn != '2'){
            $user_updated->canSignIn = $request->canSignIn;
        }

        if($request->password){
            $user_updated->password = Hash::make($request->password);
        }

        if(!$user_updated->save()){
            return response()->json([
                'status' => 400,
                'ok' => false,
                'msg' => 'Something was wrong, please contact with admin'
            ]);
        }

        return response()->json([
            'status' => 200,
            'ok' => true,
            'msg' => 'User updated successfully',
            'users' => User::all()
        ]);
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        if(!$user){
            return response()->json([
                'status' => 400,
                'ok' => false,
                'msg' => 'User no found'
            ]);
        }

        $user->delete();

        return response()->json([
            'status' => 200,
            'ok' => true,
            'msg' => 'User deleted successfully',
            'users' => User::all()
        ]);
    }

    public function search($username){
        $users = DB::table('users')->where('userName', 'LIKE', '%'.$username.'%')->get();

        if(!$users){
            return response()->json([
                'status' => 400,
                'ok' => false,
                'msg' => 'No users found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'ok' => true,
            'msg' => 'Users filtered successfully',
            'users' => $users
        ]);
    }

    public function darkModeToogle(Request $request){
        $user = User::where('id', $request->id)->first();
        if(!$user){
            return response()->json([
                'status' => 400,
                'ok' => false,
                'msg' => 'User does not exist'
            ]);
        }

        $user->darkMode = $request->darkMode;
        $user->save();
        return response()->json([
            'status' => 200,
            'ok' => true,
            'msg' => 'Dark mode changed successfully'
        ]);
    }
}
