<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DashboardMiddleware
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

        if ($request->is('/dashboard/super-admin')) //If user is deleting a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard - Super Admin')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('/dashboard/admin'))//If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard - Admin'))
            {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('/dashboard/product-manager'))//If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard - Product Manager'))
            {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('/dashboard/order-manager'))//If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard - Order Manager'))
            {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('/dashboard/logistics-manager'))//If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard - Logistics Manager'))
            {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('/dashboard/accounts-manager'))//If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard - Accounts Manager'))
            {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('/dashboard/business-manager'))//If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard - Business Manager'))
            {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('/dashboard/media-manager'))//If user is listing a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard - Media Manager'))
            {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('/dashboard/editor'))//If user is creating a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard - Editor'))
            {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('/dashboard/author')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard - Author')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('/customer/dashboard')) //If user is editing a post
        {
            if (!Auth::user()->hasPermissionTo('Dashboard - Customer')) {
                abort('401');
            } else {
                return $next($request);
            }
        }


        return $next($request);
    }
}
