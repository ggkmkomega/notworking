<?php

namespace App\Providers;

use App\Models\OrderList;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
        if(Schema::hasTable('services')){
            $servicesList = Service::all();

            View::composer('*', function ($view) use ($servicesList) {
                $view->with(compact('servicesList'));
            });
        }else{
            error_log('Unable to get services table');
        }

        if(Schema::hasTable('order_list')){

            $auth = $this->app['auth'];
            //compose all the views....
            view()->composer('layouts.website-main', function ($view) use($auth)
            {
                if($auth->user()){
                    $orderList = OrderList::where('user_id', '=', $auth->user()->id)
                        ->where('order_id', '=', null)->get();
                    //...with this variable
                    $view->with(compact('orderList'));
                }
            }); 

        }
    }
}
