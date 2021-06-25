<?php

namespace App\Http\Controllers\Auth\Passport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\DB;

class authController extends Controller
{

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=>'required|string|unique:users',
            'password' => 'required|confirmed'
        ]);

        if($validator->fails()){
            $error = "Sorry! Recheck your details";
            return response([$error, 401]);         
        }else{
            $user = UserModel::create([
                'name' => $request->name,
                'email'=> $request->email,
                'password' => Hash::make($request->password),
                'provider' => 'passport auth',
            ]);
    
            if($user){
                $token = $user->createToken('token')->accessToken;
                $message = "Registration successfull..";
    
                return response([
                    'message'=> $message,
                    'user'=>$user,
                    'token'=> $token,
                ]);
            }
            else{
                $error = "Sorry! Registration is not successfull.";
                return response([$error, 401]); 
            } 
        }
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email'=>'required|string',
            'password' => 'required|string'
        ]);
 
        if($validator->fails()){
            $error = "Incorrect Details.Please try again";
            return response([$error, 401]); 
        }

        $user = DB::table('users')->where('email',$request->email)->first();
        
        if ($user) {
            //check if email exists
            if (Hash::check($request->password, $user->password)) {
                $user1 = UserModel::find($user->id);
                $token = $user1->createToken('token')->accessToken;
                $message = "Login successfull..";

                return response([
                    'message'=> $message,
                    'user'=>$user,
                    'token'=> $token,
                ], 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        }

    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
    
  
    // public function dontuse()
    // {
    //     +token: "EAAEGe6Q55CMBAHRYC3s0aBqlp8S9hfzaZAoV3ZBun3ChZBCbe1CCutk3ET7DRfHAMkejfHNjbV36w7tR9Jm3G881pNtimqdvxNXDZCwqARcUWraFrjZBwo8u4vJVwyrIA5lMmkHUReaOMEh2sE8E0c9JTqdrASr ▶"
    //     +refreshToken: null
    //     +expiresIn: 5103454
    //     +id: "524970828625961"
    //     +nickname: null
    //     +name: "Evance Omondi"
    //     +email: "evancewebguy@gmail.com"
    //     +avatar: "https://graph.facebook.com/v3.3/524970828625961/picture?type=normal"
    //     +user: array:3 [▼
    //       "name" => "Evance Omondi"
    //       "email" => "evancewebguy@gmail.com"
    //       "id" => "524970828625961"
    //     ]
    //     +"avatar_original": "https://graph.facebook.com/v3.3/524970828625961/picture?width=1920"
    // }
    
}
