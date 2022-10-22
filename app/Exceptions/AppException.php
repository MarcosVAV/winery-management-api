<?php

namespace App\Exceptions;

use Exception;

class AppException extends Exception
{
    protected $message;
    protected $status;
    protected $errors;

    public function __construct(string $message = '', int $status = 400, array $errors = [])
    {
        $this->message = $message;
        $this->status = $status;
        $this->errors = $errors;
    }

    public function render()
    {
        $response = [];

        strlen($this->message) && ($response['message'] = $this->message);

        count($this->errors) && ($response['errors'] = $this->errors);

        return response()->json($response, $this->status);
    }
}