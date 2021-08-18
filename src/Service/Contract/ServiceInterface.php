<?php

namespace Qyon\ServiceLayer\Service\Contract;

use Illuminate\Http\Request;

/**
 * ServiceInterface Interface para as classes de serviço
 *
 * @author Diego Silva <diego@qyon.com>
 */
interface ServiceInterface
{
        
    /**
     * index
     *
     * @return DataTransferObject
     */
    public function index();
        
        
    /**
     * store
     *
     * @param  mixed $request
     * @return DataTransferObject
     */
    public function store(Request $request);
    
    /**
     * show
     *
     * @param  mixed $id
     * @return DataTransferObject
     */
    public function show($id);
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return DataTransferObject
     */
    public function update($request, $id);
        
    /**
     * destroy
     *
     * @param  mixed $id
     * @return DataTransferObject
     */
    public function destroy($id);
}