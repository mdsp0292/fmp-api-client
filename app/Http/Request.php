<?php

namespace App\Http;

use App\Exception\CustomException;
use Exception;

class Request
{
    private $server;

    public function __construct(array $server = [])
    {
        $this->server = $server;
    }

    /**
     * get controller from URL
     *
     * @return string
     * @throws Exception
     */
    public function getController(): string
    {
        $urlParts = $this->getUrlParts();

        // If controller name is not set in URL return default one
        if (!isset($urlParts[0])) {
            return APP_CONTROLLER_NAMESPACE . APP_DEFAULT_CONTROLLER;
        }

        // If controller exists in system then return it
        $controller = APP_CONTROLLER_NAMESPACE . ucfirst($urlParts[0]) . APP_CONTROLLER_SUFFIX;
        if (class_exists($controller)) {
            return $controller;
        }

        // Otherwise
        throw new CustomException(404, null, sprintf('Route not found: [%s]', $urlParts[0]));
    }

    /**
     * @return false|string[]
     */
    public function getUrlParts()
    {
        $urlParts = explode('/', $this->getServer('REQUEST_URI'));
        $urlParts = array_filter($urlParts);
        return array_values($urlParts);
    }

    /**
     * @param null $index
     * @return array|mixed
     */
    public function getServer($index = null)
    {
        return !is_null($index) && isset($this->server[$index]) ? $this->server[$index] : $this->server;
    }

    /**
     * @return array|false|string[]
     */
    public function getMethodParams()
    {
        $urlParts = $this->getUrlParts();
        //first element is controller and second element is method
        if (count($urlParts) < 2) {
            return [];
        }
        return array_slice($urlParts, 1);
    }

    /**
     * @return array|mixed
     */
    public function getMethodType()
    {
        return $this->getServer('REQUEST_METHOD');
    }
}
