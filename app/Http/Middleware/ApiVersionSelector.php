<?php

namespace App\Http\Middleware;

use app\api\ApiVersion;
use Closure;

class ApiVersionSelector
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach(array_keys(config("apiVersions")) as $class){
            app()->bind(
                $class,
                \App\Api\ApiVersion::getClass($class, \App\Api\ApiVersion::getVersion($request)));
        }
        return $next($request);
    }
}
