<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProductAttributeValueMiddleware
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

        if ($request->is('admin/product/attribute/value'))//If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('List Product Attribute Value'))
            {
                abort('401');
            } 
            else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/attribute/value/create'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Create Product Attribute Value'))
            {
                abort('401');
            } 
            else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/attribute/value/*/edit')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Edit Product Attribute Value')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/attribute/value/*/delete')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Delete Product Attribute Value')) {
                abort('401');
            } 
            else 
            {
                return $next($request);
            }
        }
    }
}
