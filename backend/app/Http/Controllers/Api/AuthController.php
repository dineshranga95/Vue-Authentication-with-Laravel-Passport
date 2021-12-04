<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use Exception;

class AuthController extends Controller
{    
    public function index(){
        $users = User::get();

        return response()->json(['msg'=>'success', 'users'=>$users]);
    }
    public function register(Request $request){
        $validate= Validator::make($request->all(),[
            'name'=> 'required|min:3',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);
        if ($validate->fails()){
              return response()->json(['msg'=>'Validation error', 'data'=>$validate->errors()],422);
        };
        try {
            $user = User::create([
                'name' =>$request->name,
                'email' =>$request->email,
                'password' =>Hash::Make($request->password)  
            ]);
            return response()->json(['status' =>true, 'msg'=>'user registration is success' ,'name' => $user->name]);
        } catch(Exception $e){
            return response()->json([
                'msg'=>$e->getMessage()
            ], $e->getCode());
            
        } 
        
    }
    public function login(Request $request){
        $validate= Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if ($validate->fails()){
              return response()->json(['msg'=>'Validation error', 'data'=>$validate->errors()],422);
        };
        
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $data['name'] = $user->name;
            $data['access_token'] = $user->createToken('accessToken')->accessToken;

            return response()->json(['msg'=>'succesfully logged in', 'user'=>$data]);
        }else{
            return response()->json(['msg'=>'unauthorized'], 401);
        }
    }

    public function logout(Request $request){
        auth::user()->token()->revoke();

        return response()->json(['msg'=>'Succesfully Logged Out']);
    }
    public function show($id){
        $user= User::find($id);
        if($user){
            return response()->json(['msg'=>'success','user'=>$user]);
        }else{
            return response()->json(['msg'=>'Data Not Found']);
        }
        
    }
}
