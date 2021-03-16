<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use \Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //Schema::defaultStringLength(191);

        Validator::extend('checkPI', function($attribute, $value, $parameters, $validator) {
            $data= $validator->getData();
            $users = DB::table('weights')
                ->where('email','like', '%'. $data['email'].'%' )
                ->get();
            if($users->count() == 0 && config('app.restrictregisterlist', false))
                return false;
            return true;
        }, __('This email is not allowed to register, contact the administrator.'));
    }
}
