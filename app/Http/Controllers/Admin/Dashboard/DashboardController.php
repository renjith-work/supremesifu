<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    public function __construct() {
         $this->middleware(['auth', 'dashboard'])->except(['customer']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        
        if($user->hasRole('Super Admin')){
            return redirect('/admin/dashboard/super-admin');
        }else if($user->hasRole('Administrator')){
            return redirect('/admin/dashboard/admin');
        }else if($user->hasRole('Product Manager')){
            return redirect('/admin/dashboard/product-manager');
        }else if($user->hasRole('Order Manager')){
            return redirect('/admin/dashboard/order-manager');
        }else if($user->hasRole('Logistics Manager')){
            return redirect('/admin/dashboard/logistics-manager');
        }else if($user->hasRole('Accounts Manager')){
            return redirect('/admin/dashboard/accounts-manager');
        }else if($user->hasRole('Business Manager')){
            return redirect('/admin/dashboard/business-manager');
        }else if($user->hasRole('Media Manager')){
            return redirect('/admin/dashboard/media-manager');
        }else if($user->hasRole('Editor')){
            return redirect('/admin/dashboard/editor');
        }else if($user->hasRole('Author')){
            return redirect('/admin/dashboard/author');
        }else if($user->hasRole('Customer')){
            return redirect('/user/dashboard');
        }
    }

    public function superAdmin(){
        return view('admin.dashboard.superAdmin');
    }

    public function admin(){
        return view('admin.dashboard.admin');
    }

    public function productManager(){
         return view('admin.dashboard.productManager');
    }

    public function orderManager(){
         return view('admin.dashboard.orderManager');
    }

    public function logisticsManager(){
         return view('admin.dashboard.logisticsManager');
    }

    public function accountsManager(){
         return view('admin.dashboard.accountsManager');
    }

    public function businessManager(){
         return view('admin.dashboard.businessManager');
    }

    public function mediaManager(){
         return view('admin.dashboard.mediaManager');
    }


    public function editor(){
        return view('admin.dashboard.editor');
    }

    public function author(){
        return view('admin.dashboard.author');
    }

    public function customer(){
        return view('front.user.dashboard');
    }


}
