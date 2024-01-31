<?php

namespace App\Exceptions;

use Exception;

class ShopException extends Exception
{
    public function __construct($message = 'error', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
