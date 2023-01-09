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
     * @var Qyon\ServiceLayer\DataTransferObject
     */
    protected $dto;
    protected $validation;
    protected $model;

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
    public function validate($data,$currentId = null)
    {
        //Checks if the validate method have a ID param and, if necessary, sends it
        $method = new \ReflectionMethod(get_class($this->validation), 'rules');
        $methodParams = $method->getParameters(); 

        if((count($methodParams) == 1 && $methodParams[0]->name == 'id' )){
            return Validator::validate($data, $this->validation->rules($currentId), $this->validation->messages());
        }else{
            return Validator::validate($data, $this->validation->rules(), $this->validation->messages());
        }
    }

    /**
     * Busca os dados com base em um id ou retorna todos
     *
     * @param mixed $id
     * @return void
     */
    public function getData($id = null)
    {

        if ($id) {
            $returnData = $this->model->find($id);
        } else {
            $returnData = $this->model->get();
        }

        return $returnData;
    }

    /**
     * Retorna todos os dados da model
     *
     * @return Qyon\ServiceLayer\DataTransferObject
     */
    public function index()
    {
        $returnData = $this->getData(); 
        $this->dto->successMessage('Successfully found',$returnData);
        return $this->dto;
    }

    /**
     * Salva os dados
     *
     * @param array $data
     * @return Qyon\ServiceLayer\DataTransferObject
     */
    public function store($data)
    {
        $this->validate($data);

        $returnData = $this->model::create($data);
        $this->dto->successMessage('Successfully created',$returnData);
        return $this->dto;
    }

    /**
     * Exibe um registro
     *
     * @param mixed $id
     * @return Qyon\ServiceLayer\DataTransferObject
     */
    public function show($id)
    {
        $returnData = $this->getData($id);
        $this->dto->successMessage('Successfully found',$returnData);
        return $this->dto;
    }

    /**
     * Atualiza um registro
     *
     * @param [array] $data
     * @param mixed $id
     * @return Qyon\ServiceLayer\DataTransferObject
     */
    public function update($data, $id)
    {
        $this->validate($data, $id);

        $returnData = $this->model::find($id)->update($data);

        if (is_null($returnData) || ($returnData == 0)) {
            throw new Exception("Not found", 406);
        }

        $this->dto->successMessage('Successfully updated',$returnData);
        return $this->dto;
    }

    /**
     * Deleta um registro
     *
     * @param mixed $id
     * @return Qyon\ServiceLayer\DataTransferObject
     */
    public function destroy($id)
    {
        $returnData = $this->model::find($id)->delete();

        if ($returnData == 0) {
            throw new Exception("Not found", 406);
        }

        $this->dto->successMessage('Successfully deleted',$returnData);
        return $this->dto;
    }
}
