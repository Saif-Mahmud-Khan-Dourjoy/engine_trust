<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if($request->routeIs('superAdmin.*')){
                return route('superAdmin.login');
            }
            if($request->routeIs('moderator.*')){
                return route('moderator.login');
            }
            return route('user.login');
        }
    }
}
