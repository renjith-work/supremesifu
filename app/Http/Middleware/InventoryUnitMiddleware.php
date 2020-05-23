<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class InventoryUnitMiddleware
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

        if ($request->is('admin/product/inventory/unit')) //If user is listing a post category
        {
            if (!Auth::user()->hasPermissionTo('List Inventory Unit')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/inventory/unit/create')) //If user is creating a post category
        {
            if (!Auth::user()->hasPermissionTo('Create Inventory Unit')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/inventory/unit/*/edit')) //If user is editing a post category
        {
            if (!Auth::user()->hasPermissionTo('Edit Inventory Unit')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/inventory/unit/*/delete')) //If user is deleting a post category
        {
            if (!Auth::user()->hasPermissionTo('Delete Inventory Unit')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
