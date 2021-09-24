<?php

namespace Qyon\ServiceLayer\Service;

use Exception;
use Illuminate\Support\Facades\Validator;
use Qyon\ServiceLayer\DataTransferObject;
use Qyon\ServiceLayer\Service\Contract\ServiceInterface;

/**
 * BaseService Classe base para as classes de serviço
 *
 * @author Diego Silva <diego.silva@qyon.com>
 * @author Guilherme Andreoti <guilherme.andreoti@qyon.com>
 */
class BaseService implements ServiceInterface
{
    /**
     * Data Transfer Object
     *
     * @var DataTransferObject
     */
    protected $dto;
    private $validation;
    private $model;

    /**
     * __construct
     *
     * @param [Model] $model Uma instância da model
     * @param [Array] $validation Uma instância da classe de validação
     */
    public function __construct($model = null, $validation = null)
    {
        $this->dto = new DataTransferObject();
        $this->validation = $validation;
        $this->model = $model;
    }

    /**
     * Valida os dados
     * 
     * @param [Array] $data 
     * @return void
     */
    public function validate($data)
    {
        Validator::validate($data, $this->validation->rules(), $this->validation->messages());
    }

    /**
     * Busca os dados com base em um id ou retorna todos
     *
     * @param mixed $id
     * @return void
     */
    private function getData($id = null)
    {

        if ($id) {
            $returnData = $this->model->find($id);
        } else {
            $returnData = $this->model->get();
        }

        if (empty($returnData)) {
            throw new Exception("Not found", 406);
        }

        return $returnData;
    }

    /**
     * Retorna todos os dados da model
     *
     * @return DataTransferObject
     */
    public function index()
    {
        $returnData = $this->getData();

        $this->dto->setSuccess(true);
        $this->dto->setMessage('Successfully founded');
        $this->dto->setData($returnData);

        return $this->dto;
    }

    /**
     * Salva os dados
     *
     * @param array $data
     * @return DataTransferObject
     */
    public function store($data)
    {
        $this->validate($data);

        $returnData = $this->model::create($data);

        $this->dto->setSuccess(true);
        $this->dto->setMessage('Successfully created');
        $this->dto->setData($returnData);

        return $this->dto;
    }

    /**
     * Exibe um registro
     *
     * @param mixed $id
     * @return DataTransferObject
     */
    public function show($id)
    {
        $returnData = $this->getData($id);

        $this->dto->setSuccess(true);
        $this->dto->setMessage('Successfully founded');
        $this->dto->setData($returnData);

        return $this->dto;
    }

    /**
     * Atualiza um registro
     *
     * @param [array] $data
     * @param mixed $id
     * @return DataTransferObject
     */
    public function update($data, $id)
    {
        $this->validate($data);

        $returnData = $this->model::where('id', $id)->update($data);

        if (is_null($returnData) || ($returnData == 0)) {
            throw new Exception("Not found", 406);
        }

        $this->dto->setSuccess(true);
        $this->dto->setMessage('Successfully updated');
        $this->dto->setData($returnData);

        return $this->dto;
    }

    /**
     * Deleta um registro
     *
     * @param mixed $id
     * @return DataTransferObject
     */
    public function destroy($id)
    {
        $returnData = $this->model::find($id)->delete();

        if ($returnData == 0) {
            throw new Exception("Not found", 406);
        }

        $this->dto->setSuccess(true);
        $this->dto->setMessage('Successfully deleted');
        $this->dto->setData(null);

        return $this->dto;
    }
}
