<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MfdCountryMiddleware
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

        if ($request->is('admin/product/mfd-country')) //If user is listing a post category
        {
            if (!Auth::user()->hasPermissionTo('List Manufacturing Country')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/mfd-country/create')) //If user is creating a post category
        {
            if (!Auth::user()->hasPermissionTo('Create Manufacturing Country')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/mfd-country/*/edit')) //If user is editing a post category
        {
            if (!Auth::user()->hasPermissionTo('Edit Manufacturing Country')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/mfd-country/*/delete')) //If user is deleting a post category
        {
            if (!Auth::user()->hasPermissionTo('Delete Manufacturing Country')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
