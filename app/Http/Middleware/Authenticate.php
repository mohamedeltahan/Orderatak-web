<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        
        if((! $request->expectsJson()) && str_contains(url()->current(), 'api')){
            return route("error_message");
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
