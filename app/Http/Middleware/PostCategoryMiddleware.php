<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PostCategoryMiddleware
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

        if ($request->is('admin/post/category'))//If user is listing a post category
         {
            if (!Auth::user()->hasPermissionTo('List Post Category'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/category/create'))//If user is creating a post category
         {
            if (!Auth::user()->hasPermissionTo('Create Post Category'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/category/*/edit')) //If user is editing a post category
         {
            if (!Auth::user()->hasPermissionTo('Edit Post Category')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/category/*/delete')) //If user is deleting a post category
         {
            if (!Auth::user()->hasPermissionTo('Delete Post Category')) {
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
