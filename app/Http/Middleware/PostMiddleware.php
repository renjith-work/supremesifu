<?php

namespace App\Http\Middleware;

use Closure;

class PostMiddleware
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

        if ($request->is('admin/post'))//If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('List Post'))
            {
                abort('401');
            } 
            else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/create'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Create Post'))
            {
                abort('401');
            } 
            else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/*/edit')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Edit Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('admin/post/*/delete')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Delete Post')) {
                abort('401');
            } 
            else 
            {
                return $next($request);
            }
        }
    }
}
