<?php

namespace  App\Exceptions;

use Exception;
class ControllerNotFoundException extends  Exception
{
    public function __construct($message = null, $code = 0, Exception $oldException = null) {
        if($message == null){
            $message = $this->getMessage();
        }
        parent::__construct($message, $code, $oldException);
    }
}