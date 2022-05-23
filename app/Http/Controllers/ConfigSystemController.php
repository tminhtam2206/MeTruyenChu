<?php

namespace App\Http\Controllers;

use App\Models\ConfigSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ConfigSystemController extends Controller{
    public static function getConfigSystem(){
        $config = ConfigSystem::first();

        if($config == null){
            $config_new = new ConfigSystem();
            $config_new->baotri = 'N';
            $config_new->craw = 'N';
            $config_new->google_login = 'N';
            $config_new->facebook_login = 'N';
            $config_new->save();

            return $config_new;
        }

        return $config;
    }

    public static function updateMaintenance(){
        $config = ConfigSystem::first();

        if($config->baotri == 'N'){
            $config->baotri = 'Y';
            $config->save();

            Artisan::call('down');
        }else{
            $config->baotri = 'N';
            $config->save();
            Artisan::call('up');
        }
    }

    public static function updateCrawData(){
        $config = ConfigSystem::first();

        if($config->craw == 'N'){
            $config->craw = 'Y';
            $config->save();
        }else{
            $config->craw = 'N';
            $config->save();
        }
    }
    
    public static function updateGoogleLogin(){
        $config = ConfigSystem::first();

        if($config->google_login == 'N'){
            $config->google_login = 'Y';
            $config->save();
        }else{
            $config->google_login = 'N';
            $config->save();
        }
    }

    public static function updateFacebookLogin(){
        $config = ConfigSystem::first();

        if($config->facebook_login == 'N'){
            $config->facebook_login = 'Y';
            $config->save();
        }else{
            $config->facebook_login = 'N';
            $config->save();
        }
    }
}
