<?php

namespace App\Exception;

use Exception;

class CustomException extends Exception
{
    private $status;
    private $data;

    public function __construct($status, $data = null, $message = '')
    {
        parent::__construct($message);
        $this->status = $status;
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

}
