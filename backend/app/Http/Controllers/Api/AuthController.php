<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use Exception;

class AuthController extends Controller
{
    public function register(Request $request){
        return 'register';
    }
    public function login(Request $request){
        $validate= Validator::make($request->all(),[
            'name'=> 'required|min:3',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);
        if ($validate->fails()){
            return response()->json(['msg'=>'not a user', 'data'=>$validate->errors()],422);
        };
        try {
            $user = User::create([
                'name' =>$request->name,
                'email' =>$request->email,
                'password' =>Hash::Make($request->password)  
            ]);
            return response()->json(['status' =>true, 'msg'=>'user registration is success' ,'user' => $user]);
        } catch(Exception $e){
            return response()->json([
                'msg'=>$e->getMessage()
            ], $e->getCode());
        }
            
           
        
    }
}
