<?php

require_once(dirname(__FILE__, 2) . '/config/init.php');

use App\Exception\CustomException;
use App\Interfaces\ApiInterface;
use App\Http\Request;

$request = new Request($_SERVER);

try {
    $controller = $request->getController();
    $reflectionClass = new ReflectionClass($controller);

    if ($reflectionClass->implementsInterface(ApiInterface::class)) {
        $apiClass = $reflectionClass->newInstance();
        $result = $apiClass->invoke($request->getMethodParams(), $request);
        if (false !== $result && null !== $result) {
            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
            return true;
        }

        throw new CustomException(404, null, "Resource not found");
    }

} catch (Exception $e) {
    echo $e->getStatus() . ' ' . $e->getMessage();
}

