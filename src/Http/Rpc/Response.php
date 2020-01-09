<?php

namespace App\Http\Rpc;

class Response
{
    private $result;
    private $error;

    public function __construct($result, ?array $error)
    {
        $this->result = $result;
        $this->error = $error;
    }

    public function hasErrors(): bool
    {
        return $this->error !== null;
    }

    public function getError(): array
    {
        return (array)$this->error;
    }

    public function getResult(): array
    {
        return (array)$this->result;
    }
}
