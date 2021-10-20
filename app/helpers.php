<?php


if (! function_exists('json_response')) {

    function json_response(string $message = null, int $statusCode = 200, array $data = [])
    {
        header('Content-Type: application/json');
        header('Status: '. $statusCode);

        //always put status code
        $responseArray['status'] = $statusCode;

        if(!is_null($message)){
            $responseArray['message'] = $message;
        }

        if(!empty($data)){
            $responseArray['data'] = $data;
        }

        return json_encode($responseArray, JSON_PRETTY_PRINT);
    }
}
