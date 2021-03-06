<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Partner;
use App\Services\Sms\AliDaYuSms;
use App\Services\Sms\ISmsSvr;
use Illuminate\Support\Facades\Request;
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
        $this->loadConfig();
        //
	    Relation::morphMap([
		    'customer_payment' => CustomerPayment::class,
		    'customer_hire' => CustomerHire::class,
            'comment' => Comment::class,
	    ]);
    }

    protected function loadConfig(){
        $request = Request::instance();
        $path = $request->path();
        //LogSvr::routeSvr()->info($path);
        if(preg_match('/^api/', $path)) {
        }
        if(preg_match('/^\//', $path)) {
        }
        if(preg_match('/^admin/', $path)) {
            config([
                'auth.model' => User::class,
            ]);
        }
        if(preg_match('/^partner/', $path)) {
            config([
                'auth.defaults.guard' => 'partner',
                'auth.model' => Partner::class,
            ]);
        }

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

	public function provides()
	{
		return [
		]; // TODO: Change the autogenerated stub
	}
}
