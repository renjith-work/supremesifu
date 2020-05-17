<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TaxClassMiddleware
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
        if (Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('admin/product/tax/class')) //If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('List Tax Class')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/tax/class/create')) //If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Create Tax Class')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/tax/class/*/edit')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Edit Tax Class')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/tax/class/*/delete')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Delete Tax Class')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
    }
}
