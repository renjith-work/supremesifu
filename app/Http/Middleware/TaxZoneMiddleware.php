<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TaxZoneMiddleware
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

        if ($request->is('admin/product/tax/zone')) //If user is listing a post category
        {
            if (!Auth::user()->hasPermissionTo('List Tax Zone')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/tax/zone/create')) //If user is creating a post category
        {
            if (!Auth::user()->hasPermissionTo('Create Tax Zone')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/tax/zone/*/edit')) //If user is editing a post category
        {
            if (!Auth::user()->hasPermissionTo('Edit Tax Zone')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/tax/zone/*/delete')) //If user is deleting a post category
        {
            if (!Auth::user()->hasPermissionTo('Delete Tax Zone')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
