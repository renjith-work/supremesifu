<?php

namespace App\Http\Middleware;

use Closure;

class PostTagMiddleware
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

        if ($request->is('admin/post/tag'))//If user is listing a post category
         {
            if (!Auth::user()->hasPermissionTo('List Post Tag'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/tag/create'))//If user is creating a post category
         {
            if (!Auth::user()->hasPermissionTo('Create Post Tag'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/tag/*/edit')) //If user is editing a post category
         {
            if (!Auth::user()->hasPermissionTo('Edit Post Tag')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/tag/*/delete')) //If user is deleting a post category
         {
            if (!Auth::user()->hasPermissionTo('Delete Post Tag')) {
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
