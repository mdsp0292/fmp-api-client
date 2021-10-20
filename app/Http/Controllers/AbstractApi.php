<?php

namespace App\Http\Controllers;

use App\Exception\CustomException;
use App\Interfaces\ApiInterface;
use App\Http\Request;

abstract class AbstractApi implements ApiInterface
{
    /**
     * @param array $path
     * @param Request $request
     * @return false
     * @throws CustomException
     */
    public function invoke(array $path, Request $request)
    {
        if($request->getMethodType() == "GET"){
            return $this->get($path, $request);
        }

        throw new CustomException(405, "Request method not allowed");

    }

    abstract public function get(array $path, Request $request);

}
