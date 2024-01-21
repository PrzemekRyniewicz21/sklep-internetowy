<?php

namespace App\Exceptions;

use Exception;

class ShopExcetion extends Exception
{
    // obecnie tylko testujemy
    public function msg()
    {
        echo "ERROR";
    }
}
