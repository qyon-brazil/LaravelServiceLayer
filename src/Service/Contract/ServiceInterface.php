<?php

namespace Qyon\ServiceLayer\Service\Contract;

use Qyon\ServiceLayer\DataTransferObject;

/**
 * ServiceInterface Interface para as classes de serviço
 *
 */
interface ServiceInterface
{
        
    /**
     * __construct
     *
     * @param [Model] $model Uma instância da model
     * @param [Array] $validation Uma instância da classe de validação
     */
    public function __construct($model = null, $validationRules = null);

    /**
     * index
     *
     * @return DataTransferObject
     */
    public function index($request, $model);
        
    /**
     * Busca os dados com base em um id ou retorna todos
     *
     * @param mixed $id
     * @return void
     */
    function getData($id);
        
    /**
     * Salva os dados
     *
     * @param array $data
     * @return DataTransferObject
     */
    public function store($data);
    
    /**
     * Exibe um registro
     *
     * @param mixed $id
     * @return DataTransferObject
     */
    public function show($id);
    
    /**
     * Atualiza um registro
     *
     * @param [array] $data
     * @param mixed $id
     * @return DataTransferObject
     */
    public function update($data, $id);
        
    /**
     * Deleta um registro
     *
     * @param mixed $id
     * @return DataTransferObject
     */
    public function destroy($id);
}