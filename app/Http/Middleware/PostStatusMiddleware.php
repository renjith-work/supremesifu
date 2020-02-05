<?php

namespace App\Http\Middleware;

use Closure;

class PostStatusMiddleware
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

        if ($request->is('admin/post/status'))//If user is listing a post category
         {
            if (!Auth::user()->hasPermissionTo('List Post Status'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/status/create'))//If user is creating a post category
         {
            if (!Auth::user()->hasPermissionTo('Create Post Status'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/status/*/edit')) //If user is editing a post category
         {
            if (!Auth::user()->hasPermissionTo('Edit Post Status')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/status/*/delete')) //If user is deleting a post category
         {
            if (!Auth::user()->hasPermissionTo('Delete Post Status')) {
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
