<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProductDesignShirtMiddleware
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

        if ($request->is('admin/product/design/shirt'))//If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('List Product Shirt Design'))
            {
                abort('401');
            } 
            else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/design/shirt/create'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Create Product Shirt Design'))
            {
                abort('401');
            } 
            else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/design/shirt/*/edit')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Edit Product Shirt Design')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/design/shirt/*/delete')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Delete Product Shirt Design')) {
                abort('401');
            } 
            else 
            {
                return $next($request);
            }
        }
    }
}
