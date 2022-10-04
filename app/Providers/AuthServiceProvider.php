<?php

namespace App\Providers;

use App\Service;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class AuthServiceProvider extends ServiceProvider
{
    use Service;
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        // $this->command();
        
        if(request()->ip()){
            $result = DB::table('visitors')->where('ip_address',request()->ip())->first();
            if(empty($result)) {
                DB::table('visitors')->insert(
    array('ip_address' => request()->ip()));
            }
        }
    }
}
