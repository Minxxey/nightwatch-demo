<?php

namespace App\Exceptions;

use Exception;

class NewCandybarFetchException extends Exception
{
    public function __construct(string $message = '', int $code = 200)
    {
        parent::__construct($message, $code);
    }
}
