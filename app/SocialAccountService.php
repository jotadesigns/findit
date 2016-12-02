<?php
namespace App;

use  Laravel\Socialite\Two\User as ProviderUser;

class SocialAccountService
{

    public function createOrGetUser(ProviderUser $providerUser){
        function getOr(&$var, $default) {            if (isset($var)) {                return $var;            } else {                return $default;            }        }        $account = SocialAccount::whereProvider('facebook')                ->whereProviderUserId($providerUser->getId())                ->first();        // Cogemos los campos extras del usuario y los introducimos en la sesion
        $userExtra = [            'gender' => getOr($providerUser->user["gender"], null),            'age_range' => getOr($providerUser->user["age_range"], null) ,            'cover' => getOr($providerUser->user["cover"]["source"], null),            'avatar' => $providerUser->getAvatar() ,        ];        session(['userExtra' => $userExtra]);        //si ya existe el usuario
        if($account){            return $account->user;        }else{
            $account = new SocialAccount([                'provider_user_id' => $providerUser->getId(),                'provider' => 'facebook'            ]);
            $user = User::whereEmail($providerUser->getEmail())->first();
            if(!$user){                $email="";                if($providerUser->getEmail()==null){                    $email = $providerUser->getId();                }else{                    $email = $providerUser->getEmail();                }
                $user = User::create([                    'email' => $email,                    'name' => $providerUser->getName(),                ]);            }
            $account->user()->associate($user);            $account->save();
            return $user;        }    }}