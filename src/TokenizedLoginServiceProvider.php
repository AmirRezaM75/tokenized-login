<?php

namespace AmirRezaM75\TokenizedLogin;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use AmirRezaM75\TokenizedLogin\Facades\AuthRepositoryFacade;
use AmirRezaM75\TokenizedLogin\Facades\TokenRepositoryFacade;
use AmirRezaM75\TokenizedLogin\Facades\UserRepositoryFacade;
use AmirRezaM75\TokenizedLogin\Repositories\AuthRepository;
use AmirRezaM75\TokenizedLogin\Repositories\TokenRepository;
use AmirRezaM75\TokenizedLogin\Repositories\UserRepository;
use AmirRezaM75\TokenizedLogin\Repositories\Stubs\TokenRepositoryStub;

class TokenizedLoginServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/tokenized-login.php', 'tokenized-login');

        AuthRepositoryFacade::proxy(AuthRepository::class);
        UserRepositoryFacade::proxy(UserRepository::class);
        TokenRepositoryFacade::proxy(app()->runningUnitTests() ? TokenRepositoryStub::class : TokenRepository::class);

        if (! $this->app->routesAreCached())
            Route::prefix('api/tokenized-login')
                ->name('tokenized-login.')
                ->middleware('api')
                ->namespace('AmirRezaM75\TokenizedLogin\Http\Controllers')
                ->group(__DIR__ . '/../routes/api.php');
    }

    public function boot()
    {

    }
}
