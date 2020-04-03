<?php

namespace App\Http\Middleware;

use Closure;

class FabricBrandMiddleware
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

        if ($request->is('admin/product/fabric/brand'))//If user is listing a post category
         {
            if (!Auth::user()->hasPermissionTo('List Fabric Brand'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/fabric/brand/create'))//If user is creating a post category
         {
            if (!Auth::user()->hasPermissionTo('Create Fabric Brand'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/fabric/brand/*/edit')) //If user is editing a post category
         {
            if (!Auth::user()->hasPermissionTo('Edit Fabric Brand')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/fabric/brand/*/delete')) //If user is deleting a post category
         {
            if (!Auth::user()->hasPermissionTo('Delete Fabric Brand')) {
                abort('401');
            } 
         else 
         {
                return $next($request);
            }
        }

        return $next($request);
    }
}
