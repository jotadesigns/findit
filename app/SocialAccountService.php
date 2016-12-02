<?php
namespace App;

use  Laravel\Socialite\Two\User as ProviderUser;

class SocialAccountService
{

    public function createOrGetUser(ProviderUser $providerUser){
        function getOr(&$var, $default) {
        $userExtra = [
        if($account){
            $account = new SocialAccount([
            $user = User::whereEmail($providerUser->getEmail())->first();
            if(!$user){
                $user = User::create([
            $account->user()->associate($user);
            return $user;