<?php

namespace App\Interfaces;

use App\Http\Request;

interface ApiInterface
{
    public function invoke(array $path, Request $request);
}
