<?php

namespace App\Http\Controllers\Auth\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class authController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback($provider){

        $user = Socialite::driver($provider)->stateless()->user();

        $users =  User::where(['email' => $user->getEmail()])->first();
        if($users){
            $message = 'Successfully Logged in';
            return response([
                'message'=>$message,
                'user'=>$user
            ]);
        }else{
            $user = User::create([
                'name'          => $user->getName(),
                'email'         => $user->getEmail(),
                'provider_id'   => $user->getId(),
                'provider'      => $provider,
            ]);

            $message = 'Successfully Logged in';
            return response([
                'message'=>$message,
                'user'=>$user
            ]);
        }
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
