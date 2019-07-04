<?php


namespace App\Domain;


use Exception;
use Throwable;

class AdNotValidException extends Exception
{
    public function __construct($message = "Ad is not valid", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}