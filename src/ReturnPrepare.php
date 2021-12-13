<?php

namespace Qyon\ServiceLayer;

use Illuminate\Support\ServiceProvider;

/**
 * ReturnPrepare Serve para responder requisições no Controller
 * Nota: baseada na Classe DataPrepare (Utilizada na API do ERP)
 *
 * @author Diego Silva <diego.silva@qyon.com>
 * @author Luis Gustavo Santarosa <gustavo.santarosa@qyon.com>
 *
 */
class ReturnPrepare extends ServiceProvider
{
    public static function getMessageDTO(DataTransferObject $dto, $httpCode)
    {
        $returnObject = new ReturnObject();
        $returnObject->setHttpCode($httpCode);
        return $returnObject->getResultDto($dto);
    }

    private static function getMessage($success, $include = [], $index = false, $message, $code, $params = [], $data = [], $errors = null, $internalCode = 0)
    {
        $returnObject = new ReturnObject();
        $returnObject->setHttpCode($code);
        $returnObject->setInternalCode($internalCode);

        $returnObject->setSuccess($success);
        $returnObject->setData($data);
        $returnObject->setMessage($message);
        $returnObject->setIndex($index);
        $returnObject->setInclude($include);
        $returnObject->setErrors($errors);

        return $returnObject->getResult();
    }

    public static function successMessage($message, $code, $params = [], $data = [])
    {
        return self::getMessage(
            true,
            [],
            false,
            $message,
            $code,
            $params,
            $data
        );
    }

    public static function errorMessage($message, $code, $params = [], $data = [])
    {
        return self::getMessage(
            false,
            [],
            false,
            $message,
            $code,
            $params,
            $data
        );
    }

    public static function makeMessage($success, $message, $code, $data = null)
    {

        return self::getMessage(
            $success,
            [],
            false,
            $message,
            $code,
            [],
            $data
        );
    }
}
