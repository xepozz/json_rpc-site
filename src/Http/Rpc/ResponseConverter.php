<?php

namespace App\Http\Rpc;

use Phalcon\Di\Injectable;

class ResponseConverter extends Injectable
{
    public function toObject(array $result): Response
    {
        return new Response(
            $result['result'],
            $result['error']
        );
    }
}
