<?php

class Api{

	protected $endpoint = '';

    function response($data, $status = 200) {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode($data);
    }

    function requestStatus($code) {
        $status = array(  
            200 => 'OK',
            205 => 'Reset Content',
            404 => 'Not Found',   
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500]; 
    }
}