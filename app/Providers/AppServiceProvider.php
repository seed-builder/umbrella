<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CustomerPayment;
use App\Models\CustomerHire;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
	    Relation::morphMap([
		    'customer_payment' => CustomerPayment::class,
		    'customer_hire' => CustomerHire::class,
	    ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
