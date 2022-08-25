<?php

/**
 * DataTransferObject
 * php version 7.4.16
 *
 * @category DTO
 * @package  Qyon\ServiceLayer
 */

namespace Qyon\ServiceLayer;

use Illuminate\Support\ServiceProvider;

/**
 * DataTransferObject Classe que serve para transferência de dados entre o Service e o Controller
 *
 */
class DataTransferObject extends ServiceProvider
{
    private $success;
    private $include;
    private $index;
    private $message;
    private $data;
    private $internalCode;
    private $httpCode;

    /**
     * __construct function
     */
    public function __construct()
    {
        $this->success      = true;
        $this->include      = [];
        $this->index        = false;
        $this->message      = "";
        $this->data         = [];
        $this->internalCode = 2000;
        $this->httpCode     = 201;
    }

    /**
     * setSuccess
     *
     * @param bool $value 
     *
     * @return void
     */
    public function setSuccess($value)
    {
        $this->success = $value;
    }

    /**
     * setInclude
     *
     * @param array $value 
     * @return void
     */
    public function setInclude($value)
    {
        $this->include = $value;
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
     * @param  mixed $value
     * @return void
     */
    public function setData($value)
    {
        $this->data = $value;
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
     * include
     *
     * @return array
     */
    public function getInclude()
    {
        return $this->include;
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
     * message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * data
     *
     * @return $value
     */
    public function getData()
    {
        return $this->data;
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
     * HttpCode
     *
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }
    /**
     * HttpCode
     *
     * @param  mixed $code
     * @return void
     */
    public function setHttpCode($code)
    {
        $this->httpCode = $code;
    }

    /**
     * successMessage
     *
     * @param  string $message
     * @param  mixed $data
     * @return self
     */
    public function successMessage(string $message, $data = null, int $internalCode = 9000, $httpCode = 200)
    {
        $this->setMessage($message);
        $this->setInternalCode($internalCode);
        $this->setData($data);
        $this->setHttpCode($httpCode);
        return $this;
    }

    /**
     * ErrorMessage function
     *
     * @param string $message
     * @param $data
     * @param integer $internalCode
     *
     * @return self
     */
    public function errorMessage(string $message, $data = null, int $internalCode = 9000, $httpCode = 500): self
    {
        $this->setSuccess(false);
        $this->setMessage($message);
        $this->setInternalCode($internalCode);
        $this->setData($data);
        $this->setHttpCode($httpCode);

        return $this;
    }

    /**
     * GetMessageDTO function
     *
     * @return void
     */
    public function getMessageDTO()
    {
        $callback = [
            "success"      => $this->getSuccess(),
            "internalCode" => $this->getInternalCode(),
            "message"      => $this->getMessage(),
        ];

        if (count($this->getInclude()) > 0) {
            $callback = array_merge($callback, ["include" => $this->getInclude()]);
        }

        if (in_array(gettype($this->getData()), ["array"]) && count((array) $this->getData()) > 0) {
            $callback = array_merge($callback, [
                "data" => $this->getData()
            ]);
        }

        if (in_array(gettype($this->getData()), ["object"]) && !is_null($this->getData())) {
            if (method_exists($this->getData(), "toarray")) {
                $callback = array_merge($callback, [
                    "data" => $this->getData()->toarray()
                ]);
            } else {
                $callback = array_merge($callback, [
                    "data" => (array) $this->getData()
                ]);
            }
        }

        if (in_array(gettype($this->getData()), ["string", "numeric", "integer"]) && !empty($this->getData())) {
            $callback = array_merge($callback, [
                "data" => $this->getData()
            ]);
        }

        if ($this->index) {
            $callback = array_merge($callback, $this->getData());
        }

        return response()->json($callback, $this->getHttpCode());
    }
}
