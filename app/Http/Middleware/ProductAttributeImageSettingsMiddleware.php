<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProductAttributeImageSettingsMiddleware
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

        if ($request->is('admin/product/attribute/value/image/settings')) //If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('List Product Attribute Image Settings')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/attribute/value/image/settings/create')) //If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Create Product Attribute Image Settings')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/attribute/value/image/settings/*/edit')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Edit Product Attribute Image Settings')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/attribute/value/image/settings/*/delete')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Delete Product Attribute Image Settings')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
    }
}
