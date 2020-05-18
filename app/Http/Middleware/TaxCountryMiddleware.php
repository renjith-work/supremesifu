<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TaxCountryMiddleware
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

        if ($request->is('admin/product/tax/country')) //If user is listing a post category
        {
            if (!Auth::user()->hasPermissionTo('List Tax Country')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/tax/country/create')) //If user is creating a post category
        {
            if (!Auth::user()->hasPermissionTo('Create Tax Country')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/tax/country/*/edit')) //If user is editing a post category
        {
            if (!Auth::user()->hasPermissionTo('Edit Tax Country')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/tax/country/*/delete')) //If user is deleting a post category
        {
            if (!Auth::user()->hasPermissionTo('Delete Tax Country')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
