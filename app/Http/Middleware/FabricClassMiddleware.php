<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FabricClassMiddleware
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

        if ($request->is('admin/product/fabric/class'))//If user is listing a post category
         {
            if (!Auth::user()->hasPermissionTo('List Fabric Class'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/fabric/class/create'))//If user is creating a post category
         {
            if (!Auth::user()->hasPermissionTo('Create Fabric Class'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/fabric/class/*/edit')) //If user is editing a post category
         {
            if (!Auth::user()->hasPermissionTo('Edit Fabric Class')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/fabric/class/*/delete')) //If user is deleting a post category
         {
            if (!Auth::user()->hasPermissionTo('Delete Fabric Class')) {
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
