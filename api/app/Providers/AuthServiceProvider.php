<?php

namespace App\Providers;

use App\Models\Auth\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     *
     * @return void
     */
    public function boot()
    {

        $this->app['auth']->viaRequest('api', function ($request) {
            if($request->input('email')) {
                return User::where('email', $request->input('email'))->first();
            }
        });
    }
}
