<?php

require_once(dirname(__FILE__, 2) . '/config/init.php');

use App\Exception\CustomException;
use App\Http\Request;
use App\Interfaces\ApiInterface;

$request = new Request($_SERVER);

try {
    $controller = $request->getController();
    $reflectionClass = new ReflectionClass($controller);

    if ($reflectionClass->implementsInterface(ApiInterface::class)) {
        $apiClass = $reflectionClass->newInstance();
        $result = $apiClass->invoke($request->getMethodParams(), $request);

        if(!$result){
            throw new CustomException(404, null, "Resource not found");
        }

        echo $result;
    }

} catch (Exception $e) {
    echo json_response($e->getMessage(), $e->getStatus());
}

