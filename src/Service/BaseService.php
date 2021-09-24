<?php

namespace Qyon\ServiceLayer\Service;

use Qyon\ServiceLayer\DataTransferObject;
use Qyon\ServiceLayer\Service\Contract\ServiceInterface;

/**
 * BaseService Classe base para as classes de serviço
 *
 * @author Diego Silva <diego@qyon.com>
 * @author Guilherme Andreoti <diego@qyon.com>
 */
class BaseService implements ServiceInterface
{
    /**
     * Data Transfer Object
     *
     * @var DataTransferObject
     */
    protected $dto;
    private $model;

    /**
     * __construct
     *
     * @param [Model] $model Uma instância da model
     * @param [Array] $validationRules Um array com as regras de validação no padrão do laravel
     */
    public function __construct($model = null, $validationRules = null)
    {
        $this->dto = new DataTransferObject();
        $this->validationRules = $validationRules;
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
        Validator::validate($data, $this->validationRules);
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
