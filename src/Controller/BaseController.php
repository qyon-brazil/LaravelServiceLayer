<?php

/**
 * Base Controller
 * php version 7.4.16
 *
 * @category Controller
 * @package  Http\Controller
 */

namespace Qyon\ServiceLayer\Controller;

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
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id)->getMessageDTO();
    }

    /**
     * Display the specified resource.
     *
     * @param mixed $id Parametro identificador Principal
     */
    public function show($id)
    {
        return $this->service->show($id)->getMessageDTO();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $id Parametro identificador Principal
     */
    public function destroy($id)
    {
        return $this->service->destroy($id)->getMessageDTO();
    }

    /**
     * Store the specified resource from storage.
     *
     * @param  Request $request
     */
    public function store(Request $request)
    {
        return $this->service->store($request->all())->getMessageDTO();
    }

    /**
     * status the specified resource from storage.
     */
    public function status()
    {
        return $this->service->status()->getMessageDTO();
    }
}
