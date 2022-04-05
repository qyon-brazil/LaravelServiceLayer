<?php

/**
 * Base Service
 * php version 7.4.16
 *
 * @category ServiceInterface
 * @package  Qyon\ServiceLayer\Service
 */

namespace Qyon\ServiceLayer\Service;

use Exception;
use Illuminate\Support\Facades\Validator;
use Qyon\ServiceLayer\DataTransferObject;
use Qyon\ServiceLayer\Service\Contract\ServiceInterface;

class BaseService
{
    /**
     * Data Transfer Object
     *
     * @var Qyon\ServiceLayer\DataTransferObject
     */
    protected $dto;
    protected $storeValidation;
    protected $updateValidation;
    protected $model;

    /**
     * Construct function
     *
     * @param object|null $model      Model Principal
     * @param object|null $validation Uma instância da classe de validação
     */
    public function __construct(?object $model = null, ?object $storeValidation = null, ?object $updateValidation = null)
    {
        $this->dto = new DataTransferObject();
        $this->storeValidation = $storeValidation;
        $this->updateValidation = $updateValidation;
        $this->model = $model;
    }

    /**
     * Valida os dados
     *
     * @param [Array] $data
     * @param string $caller Upper Case Http method
     * @return void
     */
    public function validate($data, $caller = null, $currentId = null, $customValidation = null)
    {
        if ($customValidation) {
            $validation = $customValidation;
        } else {
            switch ($caller) {
                case 'store':
                    $validation = $this->storeValidation;
                    break;
                case 'update':
                    $validation = $this->updateValidation;
                    break;
                default:
                    return;
            }
        }

        if (!$validation) {
            return;
        }

        //Checks if the validate method have a ID param and, if necessary, sends it
        $method = new \ReflectionMethod(get_class($validation), 'rules');
        $methodParams = $method->getParameters();

        // TODO Qyon: $validation->authorize();

        if ((count($methodParams) == 1 && $methodParams[0]->name == 'id')) {
            Validator::validate($data, $validation->rules($currentId), $validation->messages());
        } else {
            Validator::validate($data, $validation->rules(), $validation->messages());
        }
    }

    /**
     * Retorna todos os dados da model
     *
     * @return Qyon\ServiceLayer\DataTransferObject
     */
    public function index(array $data): DataTransferObject
    {
        if (!isset($data['per_page'])) {
            $data['per_page'] = 50;
        }

        $returnData = $this->model->get();
        $this->dto->successMessage('Successfully found', $returnData);
        return $this->dto;
    }

    /**
     * Salva os dados
     *
     * @param array $data
     * @return Qyon\ServiceLayer\DataTransferObject
     */
    public function store(array $data): DataTransferObject
    {
        $this->validate($data, 'store');

        $returnData = $this->model::create($data);
        $this->dto->successMessage('Successfully created', $returnData);
        return $this->dto;
    }

    /**
     * Show a single record
     *
     * @param mixed $id    Identificador principal

     * @return Qyon\ServiceLayer\DataTransferObject
     */
    public function show($id): DataTransferObject
    {
        $returnData = $this->model->find($id);
        $this->dto->successMessage('Successfully found', $returnData);
        return $this->dto;
    }

    /**
     * Update a record
     *
     * @param array $data
     * @param mixed $id
     *
     * @return Qyon\ServiceLayer\DataTransferObject
     */
    public function update(array $data, $id): DataTransferObject
    {
        $this->validate($data, 'update', $id);

        $returnData = $this->model::find($id)->update($data);

        if (is_null($returnData) || ($returnData == 0)) {
            throw new Exception("Not found", 406);
        }

        $this->dto->successMessage('Successfully updated', $returnData);
        return $this->dto;
    }

    /**
     * Deleta um registro
     *
     * @param mixed $id
     *
     * @return Qyon\ServiceLayer\DataTransferObject
     */
    public function destroy($id): DataTransferObject
    {
        $returnData = $this->model::find($id)->delete();

        if ($returnData == 0) {
            throw new Exception("Not found", 406);
        }

        $this->dto->successMessage('Successfully deleted', $returnData);
        return $this->dto;
    }

    /**
     * Status function
     *
     * @return DataTransferObject
     */
    public function status(): DataTransferObject
    {
        return $this->dto;
    }
}
