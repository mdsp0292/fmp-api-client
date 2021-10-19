<?php

namespace App\Http\Controllers;

use App\Exception\CustomException;
use App\Interfaces\ApiInterface;
use App\Http\Request;

class AbstractApi implements ApiInterface
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

        throw new CustomException(405, "Method not allowed");

    }

    /**
     * @param array $path
     * @param Request $request
     * @return bool|string
     */
    protected function get(array $path, Request $request)
    {
        return true;
    }



}
