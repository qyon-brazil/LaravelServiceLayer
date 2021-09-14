<?php

namespace Qyon\ServiceLayer;

use Illuminate\Support\ServiceProvider;

/**
 * ReturnPrepare Serve para responder requisições no Controller
 * Nota: baseada na Classe DataPrepare (Utilizada na API do ERP) 
 *
 */
class ReturnPrepare extends ServiceProvider
{
    private static $_forbidenNames = ['code', 'msg', 'data', 'success'];

    public static function getMessageDTO(DataTransferObject $dto, $http_code)
    {
        return self::getMessage($dto->getSuccess(), $dto->getInclude(), $dto->getIndex(), $dto->getMessage(), $http_code, null, [$dto->getData()]);
    }

    private static function getMessage($success, $include = [], $index = false, $message, $code, $params = [], $data = [])
    {


        $retArr = array(
            "success" => $success,
            "code"    => $code,
            "msg"     => $message,
            "include" => $include,
        );

        if (isset($data[0]) && count($data) > 1) {

            $retArr = array_merge($retArr, [
                "totalindata" => count($data),
            ]);
        }

        if (is_array($data) && count($data) > 0) {
            $retArr['data'] = $data;
        }

        if (is_array($params)) {
            foreach ($params as $name => $value) {
                if (!in_array($value, self::$_forbidenNames)) {
                    $retArr[] = $value;
                }
            }
        }

        if($index){
            $retArr = array(
                "success" => $success,
                "code"    => $code,
                "msg"     => $message,
                "include" => $include,
            );

            $retArr = array_merge($retArr, $data[0]);
        }
        // ========================================

        return $retArr;
    }

    public static function successMessage($message, $code, $params = [], $data = [])
    {
        return self::getMessage(
            true,
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
            $message,
            $code,
            $params,
            $data
        );
    }

    public static function makeMessage($success, $message, $code, $data = null)
    {
        $retArr = array(
            "success"   => $success,
            "code"      => $code,
            "msg"       => $message,
        );

        if (isset($data)) {
            $retArr['data'] = $data;
        }

        return (object) $retArr;
    }
}