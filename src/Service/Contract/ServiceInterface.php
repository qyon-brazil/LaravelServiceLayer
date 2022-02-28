<?php

/**
 * Service Interface
 * php version 7.4.16
 *
 * @category Interface
 * @package  Qyon\ServiceLayer\Service\Contract
 */

namespace Qyon\ServiceLayer\Service\Contract;

use Qyon\ServiceLayer\DataTransferObject;

/**
 * Service Interface
 * Interface para as classes de serviço
 *
 * @category Interface
 * @package  Qyon\ServiceLayer\Service\Contract
 */
interface ServiceInterface
{
    /**
     * Construct function
     */
    public function __construct();

    /**
     * Index function
     *
     * @param array  $data  Requisicao da rota
     * @param object $model Model Principal
     *
     * @return DataTransferObject
     */
    public function index(array $data, object $model): DataTransferObject;

    /**
     * Store function
     *
     * @param array  $data  Requisicao da rota
     * @param object $model Model Principal
     *
     * @return DataTransferObject
     */
    public function store(array $data, object $model): DataTransferObject;

    /**
     * Show function
     *
     * @param integer $id    Identificador principal
     * @param object  $model Model Principal
     *
     * @return DataTransferObject
     */
    public function show(int $id, object $model): DataTransferObject;

    /**
     * Update function
     *
     * @param array   $data  Requisicao da rota
     * @param integer $id    Identificador principal
     * @param object  $model Model Principal
     *
     * @return DataTransferObject
     */
    public function update(array $data, int $id, object $model): DataTransferObject;

    /**
     * Destroy function
     *
     * @param integer $id    Identificador principal
     * @param object  $model Model Principal
     *
     * @return DataTransferObject
     */
    public function destroy(int $id, object $model): DataTransferObject;

    /**
     * Status function
     *
     * @param object $model Model Principal
     *
     * @return DataTransferObject
     */
    public function status(object $model): DataTransferObject;
}
