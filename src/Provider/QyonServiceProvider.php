<?php

namespace Qyon\ServiceLayer\Provider;

use Illuminate\Support\ServiceProvider;
use Qyon\DataTransferObject;

class QyonServiceProvider extends ServiceProvider
{
    public $bindings = [
        ServerProvider::class => DataTransferObject::class,
        ServerProvider::class => BaseController::class,
        ServerProvider::class => BaseModel::class,
        ServerProvider::class => BaseService::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}