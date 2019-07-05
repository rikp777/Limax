<?php

namespace app\api;

use Illuminate\Http\Request;

class ApiVersion
{
    public static function getVersion(Request $request){
        return $request->header('Api-version');
    }

    public static function getClass($class, $version){
        if(array_key_exists($version, config("apiVersions.{$class}"))){
            return config("apiVersions.{$class}")[$version];
        }

        return $class;
    }
}
