<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\URL;

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
            if ($request->is(ADMIN_PREFIX) || $request->is(ADMIN_PREFIX . '/*')) {
//                dd('not login', URL::previous());
                return route('admin.login');
            }

            return route('login');
        }
    }
}
