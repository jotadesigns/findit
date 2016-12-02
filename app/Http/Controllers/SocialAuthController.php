<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Socialite;
use App\User;
use App\SocialAccountService;


class SocialAuthController extends Controller
{
    //redirect function
    public function redirect(){
        return Socialite::driver('facebook')->redirect();

    }

    //funcion de callback de facebook
    public function callback(SocialAccountService $service){

        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        //nos logueamos con el usuario
        auth()->login($user);
        return view('home');
    }
}
