<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        //
<<<<<<< HEAD
=======
        // Braintree_Configuration::environment(env('BRAINTREE_ENV'));
        // Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        // Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        // Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
>>>>>>> ffd55c5a43fcdf5de69499b0a9a15dbf36570d2f
    }
}
