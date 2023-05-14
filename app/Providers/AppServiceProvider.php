<?php

namespace App\Providers;

use App\Models\OrderList;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        if(DB::table('services')){
            $services = Service::all();

            View::composer('layouts.website-main', function ($view) use ($services) {
                $view->with(compact('services'));
            });
        }else{
            error_log('Unable to get services table');
        }

        if(DB::table('order_list') && Auth::check()){

            //compose all the views....
            view()->composer('layouts.website-main', function ($view) 
            {
                $orderList = OrderList::where('user_id', '=', Auth::user()->id)
                    ->where('order_id', '=', null)->get();
                //...with this variable
                $view->with(compact('orderList')); 
            }); 

        }else{
            error_log('Unable to get orderList');
            view()->composer('layouts.website-main', function ($view) 
            {
                $orderList = null;
                //...with this variable
                $view->with(compact('orderList')); 
            }); 
        }
    }
}
