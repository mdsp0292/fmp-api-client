<?php

namespace App\Http\Controllers;

use App\Interfaces\ApiInterface;
use App\Http\Request;



class HomeController implements ApiInterface
{

    public function invoke(array $path, Request $request)
    {
        return json_response('OK',200, ['app' => APP_NAME]);
    }
}
