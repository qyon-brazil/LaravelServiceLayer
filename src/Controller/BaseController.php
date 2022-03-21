<?php

/**
 * Base Controller
 * php version 7.4.16
 *
 * @category Controller
 * @package  Http\Controller
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Qyon\ServiceLayer\Service\Contract\ServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseController extends Controller
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * service
     *
     * @var ServiceInterface
     */
    protected $service;
    protected $model;

    /**
     * Construct function
     *
     * @param $service Service sendo instanciando
     */
    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Index function
     *
     * @param Request $request Form Request da Rota
     */
    public function index(Request $request)
    {
        return $this->service->index($request->all())->getMessageDTO();
    }

    /**
     * Atualizar
     *
     * @param  mixed $request
     * @param  mixed $id
     */
    public function update(Request $request, int $id)
    {
        return $this->service->update($request->all(), $id)->getMessageDTO();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id Parametro identificador Principal
     */
    public function show(int $id)
    {
        return $this->service->show($id)->getMessageDTO();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id Parametro identificador Principal
     */
    public function destroy(int $id)
    {
        return $this->service->destroy($id)->getMessageDTO();
    }

    /**
     * status the specified resource from storage.
     */
    public function status()
    {
        return $this->service->status()->getMessageDTO();
    }
}
