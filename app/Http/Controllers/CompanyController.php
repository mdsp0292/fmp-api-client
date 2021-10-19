<?php


namespace App\Http\Controllers;

use App\Http\Request;
use App\Integrations\FinancialModelingPrep\FinancialModelingPrepApi;
use App\Integrations\Provider;

class CompanyController extends AbstractApi
{
    /**
     * @param array $path
     * @param Request $request
     * @return mixed
     */
    public function get(array $path, Request $request)
    {
        $method = strtolower(array_shift($path));
        $provider = Provider::getAPIProvider();

        if(!$provider){
            return false;
        }

        switch ($method) {
            case 'profile' :
                return $provider->getProfile($path[0]);
            case 'quote' :
                return $provider->getQuote($path[0]);
            default :
                return false;
        }
    }


}
