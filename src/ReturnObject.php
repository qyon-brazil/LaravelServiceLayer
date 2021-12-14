<?php

namespace Qyon\ServiceLayer;

use Illuminate\Support\ServiceProvider;

/**
 * ReturnObject Classe para retorno de dados
 *
 * @author Edson Queiroz <edson@qyon.com>
 *
 */
class ReturnObject extends ServiceProvider
{
    /**
     * success
     *
     * @var bool
     */
    private $success;

    /**
     * include
     *
     * @var mixed
     */
    private $httpCode;

    /**
     * index
     *
     * @var mixed
     */
    private $internalCode;

    /**
     * msg
     *
     * @var string
     */
    private $msg;

    /**
     * message
     *
     * @var string
     */
    private $message;

    /**
     * data
     *
     * @var mixed
     */
    private $data;

    /**
     * errors
     *
     * @var mixed
     */
    private $errors;

    /**
     * include
     *
     * @var array
     */
    private $include;

    /**
     * index
     *
     * @var bool
     */
    private $index;


    /**
     * result
     *
     * @var mixed
     */
    private $result;

    public function __construct()
    {
        $this->success = false;
        $this->httpCode = 200;
        $this->internalCode = 0;
        $this->msg = "";
        $this->message = "";
        $this->data = null;

        $this->errors = null;
        $this->include = [];
        $this->index = false;

        $this->result = [];
    }


    /**
     * success
     *
     * @return bool
     */
    public function getSuccess()
    {
        return $this->success;
    }
    /**
     * setSuccess
     *
     * @param  bool $value
     * @return void
     */
    public function setSuccess($value)
    {
        $this->success = $value;
    }

    /**
     * message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * message
     *
     * @param  string $value
     * @return void
     */
    public function setMessage($value)
    {
        $this->message = $value;
    }

    /**
     * data
     *
     * @return mixed $value
     */
    public function getData()
    {
        return $this->data;
    }
    /**
     * data
     *
     * @param  mixed $value
     * @return void
     */
    public function setData($value)
    {
        $this->data = $value;
    }


    /**
     * httpCode
     *
     * @return string
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }
    /**
     * httpCode
     *
     * @param  string $code
     * @return void
     */
    public function setHttpCode($code)
    {
        $this->httpCode = $code;
    }


    /**
     * internalCode
     *
     * @return mixed
     */
    public function getInternalCode()
    {
        return $this->internalCode;
    }
    /**
     * internalCode
     *
     * @param  mixed $code
     * @return void
     */
    public function setInternalCode($code)
    {
        $this->internalCode = $code;
    }


    /**
     * include
     *
     * @return bool
     */
    public function getInclude()
    {
        return $this->include;
    }
    /**
     * setInclude
     *
     * @param  array $value
     * @return void
     */
    public function setInclude($value)
    {
        $this->include = $value;
    }
    /**
     * include
     *
     * @return bool
     */
    public function getIndex()
    {
        return $this->index;
    }
    /**
     * setIndex
     *
     * @param  bool $value
     * @return void
     */
    public function setIndex($value)
    {
        $this->index = $value;
    }
    /**
     * errors
     *
     * @return mixed $value
     */
    public function getErrors()
    {
        return $this->errors;
    }
    /**
     * errors
     *
     * @param  mixed $value
     * @return void
     */
    public function setErrors($value)
    {
        $this->errors = $value;
    }


    public function getResult()
    {
        $this->prepareResult();
        return $this->result;
    }
    public function prepareResult()
    {
        $this->result = [
            "success" => $this->success,
            "code" => $this->httpCode,
            "internalCode" => $this->internalCode,
            "msg" => $this->message,
            "message" => $this->message,
        ];

        if ($this->data) {
            $this->result['data'] = $this->data;

            $data = gettype($this->data) != 'array' ? [$this->data] : $this->data;
            $this->result = array_merge($this->result, [
                "totalindata" => count($data),
            ]);
        }

        if ($this->include) {
            $this->result['include'] = $this->include;
        }

        if ($this->errors) {
            $this->result['errors'] = $this->errors;
        }
    }

    public function getResultDto(DataTransferObject $dto)
    {
        $this->setSuccess($dto->getSuccess());
        $this->setData($dto->getData());
        $this->setMessage($dto->getMessage());
        $this->setIndex($dto->getIndex());
        $this->setInclude($dto->getInclude());
        $this->setErrors($dto->getErrors());
        $this->setInternalCode($dto->getInternalCode());
        return $this->getResult();
    }
}
