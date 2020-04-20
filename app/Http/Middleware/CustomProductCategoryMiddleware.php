<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomProductCategoryMiddleware
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

        if ($request->is('admin/product/custom/category')) //If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('List Custom Product Category')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/custom/category/create')) //If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Create Custom Product Category')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/custom/category/*/edit')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Edit Custom Product Category')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/custom/category/*/delete')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Delete Custom Product Category')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
    }
}
