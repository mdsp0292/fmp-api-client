<?php

namespace App\Integrations\FinancialModelingPrep;

use App\Exception\CustomException;
use App\Interfaces\FMPIInterface;

class FinancialModelingPrepApi implements FMPIInterface
{
    const API_URL = 'https://financialmodelingprep.com/api/';
    const API_VERSION = 'v3';
    const API_KEY = '20afce5c7a2e0f38939917c463e18a30';

    /**
     * @throws CustomException
     */
    public function getProfile(string $companyKey)
    {
        return $this->request('profile', $companyKey);
    }

    /**
     * @throws CustomException
     */
    public function getQuote(string $companyKey)
    {
        return $this->request('quote', $companyKey);
    }

    /**
     * @param string $method
     * @param string $companyKey
     * @return mixed
     * @throws CustomException
     */
    public function request(string $method, string $companyKey)
    {
        $url = $this->getApiUrl($method, $companyKey);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_AUTOREFERER    => true,
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ]);
        $ret = curl_exec($curl);

        if (curl_error($curl)) {
            throw new CustomException('500', null, curl_error($curl));
        }

        return json_decode($ret);
    }


    /**
     * @param string $method
     * @param string $companyKey
     * @return string
     */
    public function getApiUrl(string $method, string $companyKey): string
    {
        return sprintf(
            "%s/%s/%s/%s?apikey=%s",
            rtrim(self::API_URL, '/'),
            rtrim(self::API_VERSION, '/'),
            trim($method, '/'),
            trim($companyKey, '/'),
            self::API_KEY
        );
    }
}
