<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProductMiddleware
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

        if ($request->is('admin/product'))//If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('List Product'))
            {
                abort('401');
            } 
            else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/create'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Create Product'))
            {
                abort('401');
            } 
            else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/*/edit')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Edit Product')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/*/delete')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Delete Product')) {
                abort('401');
            } 
            else 
            {
                return $next($request);
            }
        }
    }
}
