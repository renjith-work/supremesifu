<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CatalogueMiddleware
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

        if ($request->is('admin/product/catalogue')) //If user is listing a post category
        {
            if (!Auth::user()->hasPermissionTo('List Catalogue')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/catalogue/create')) //If user is creating a post category
        {
            if (!Auth::user()->hasPermissionTo('Create Catalogue')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/catalogue/*/edit')) //If user is editing a post category
        {
            if (!Auth::user()->hasPermissionTo('Edit Catalogue')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/catalogue/*/delete')) //If user is deleting a post category
        {
            if (!Auth::user()->hasPermissionTo('Delete Catalogue')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
