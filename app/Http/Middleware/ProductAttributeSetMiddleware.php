<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProductAttributeSetMiddleware
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

        if ($request->is('admin/product/attribute/set')) //If user is listing a post category
        {
            if (!Auth::user()->hasPermissionTo('List Product Attribute Set')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/attribute/set/create')) //If user is creating a post category
        {
            if (!Auth::user()->hasPermissionTo('Create Product Attribute Set')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/attribute/set/*/edit')) //If user is editing a post category
        {
            if (!Auth::user()->hasPermissionTo('Edit Product Attribute Set')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/attribute/set/*/delete')) //If user is deleting a post category
        {
            if (!Auth::user()->hasPermissionTo('Delete Product Attribute Set')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
