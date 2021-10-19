<?php

namespace App\Integrations;

use App\Integrations\FinancialModelingPrep\FinancialModelingPrepApi;
use App\Interfaces\FMPIInterface;
use ReflectionClass;
use ReflectionException;

class Provider
{
    const DEFAULT_FMP_API_PROVIDER = FinancialModelingPrepApi::class;

    /**
     * @param string|null $class
     * @return FMPIInterface|false
     */
    public static function getAPIProvider(string $class = null)
    {
        try {
            $class = $class ?? self::DEFAULT_FMP_API_PROVIDER;
            $providerClass = (new ReflectionClass($class))->newInstance();
            if ($providerClass instanceof FMPIInterface) {
                return $providerClass;
            }
        } catch (ReflectionException $e) {
            return false;
        }
        return false;
    }
}
