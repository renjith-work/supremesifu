<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BrandMiddleware
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

        if ($request->is('admin/product/brand'))//If user is listing a post category
         {
            if (!Auth::user()->hasPermissionTo('List Brand'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/brand/create'))//If user is creating a post category
         {
            if (!Auth::user()->hasPermissionTo('Create Brand'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/brand/*/edit')) //If user is editing a post category
         {
            if (!Auth::user()->hasPermissionTo('Edit Brand')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/product/brand/*/delete')) //If user is deleting a post category
         {
            if (!Auth::user()->hasPermissionTo('Delete Brand')) {
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
