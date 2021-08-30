<?php

namespace Qyon\ServiceLayer\Service;

use Illuminate\Http\Request;
use Qyon\ServiceLayer\DataTransferObject;
use Qyon\ServiceLayer\Service\Contract\ServiceInterface;

/**
 * BaseService Classe base para as classes de serviço
 *
 * @author Diego Silva <diego@qyon.com>
 */
class BaseService implements ServiceInterface
{    
    /**
     * Data Transfer Object
     *
     * @var DataTransferObject
     */
    protected $dto;

    public function __construct()
    {
        $this->dto = new DataTransferObject();        
    }

    public function index(Request $request)
    {
        return $this->dto;
    }

    public function store(Request $request)
    {
        return $this->dto;
    }
        
    public function show($id)
    {        
        return $this->dto;
    }
    
    public function update($request, $id)
    {
        return $this->dto;
    }
    public function destroy($id)
    {
        return $this->dto;
    }
}