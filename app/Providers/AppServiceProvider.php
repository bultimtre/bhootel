<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Braintree_Configuration::environment(env('BRAINTREE_ENV')); 
        \Braintree_Configuration::environment(env('BRAINTREE_ENV')); 
        \Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID')); 
        \Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY')); 
        \Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
    }
}
