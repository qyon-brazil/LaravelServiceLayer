<?php

namespace Qyon\ServiceLayer\Provider;

use Illuminate\Support\ServiceProvider;
use Qyon\DataTransferObject;

/**
 * ReturnPrepare Serve para responder requisições no Controller
 * Nota: baseada na Classe DataPrepare (Utilizada na API do ERP) 
 * 
 * @author Diego Silva <diego.silva@qyon.com> 
 * @author Luis Gustavo Santarosa <gustavo.santarosa@qyon.com>
 *
 */
class QyonServiceProvider extends ServiceProvider
{
    public $bindings = [
        ServerProvider::class => DataTransferObject::class,
        ServerProvider::class => ReturnPrepare::class,
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