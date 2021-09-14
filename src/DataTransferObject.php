<?php

namespace Qyon\ServiceLayer;

use Illuminate\Support\ServiceProvider;

/**
 * DataTransferObject Classe que serve para transferência de dados entre o Service e o Controller
 *
 * @author Diego Silva <diego@qyon.com>
 */
class DataTransferObject extends ServiceProvider
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

    public function __construct()
    {
        $this->success = false;
        $this->include = [];
        $this->index = false;
        $this->message = "";
        $this->data = null;
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
     * @return bool
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
     * @return mixed $value
     */
    public function getData()
    {
        return $this->data;
    }        
}