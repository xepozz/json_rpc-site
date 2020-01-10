<?php

namespace App\Http\Rpc;

use Phalcon\Di\Injectable;

class ResponseConverter extends Injectable
{
    public function toObject(?array $result): Response
    {
        if ($result === null) {
            return new Response(
                null,
                [
                    'message' => 'Invalid response',
                ]
            );
        }

        return new Response(
            $result['result'],
            $result['error']
        );
    }
}
