<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $route = $request->route();
        $flag = $route->getAction('permission');

        if ($flag === null) {
            $flag = $route->getName();
        }

        $flag = preg_replace('/.store$/', '.create', $flag);
//        $flag = preg_replace('/.update$/', '.edit', $flag);
        $flag = preg_replace('/.show$/', '.update', $flag);
//        $flag = preg_replace('/.destroy$/', '.delete', $flag);

        if ($flag && !$request->user()->hasAnyPermission((array)$flag)) {
            throw new AuthorizationException(__('Authorization has been denied for this request.'));
        }

        return $next($request);
    }
}
