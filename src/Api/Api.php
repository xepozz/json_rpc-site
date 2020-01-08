<?php

namespace App\Api;

use Datto\JsonRpc\Evaluator;
use Datto\JsonRpc\Examples\Library\Math;
use Datto\JsonRpc\Exceptions\ArgumentException;
use Datto\JsonRpc\Exceptions\MethodException;

class Api implements Evaluator
{
    public function evaluate($method, $arguments)
    {
        if ($method === 'add') {
            return self::add($arguments);
        }
        throw new MethodException();
    }

    private static function add($arguments)
    {
        @list($a, $b) = $arguments;
        if (!is_int($a) || !is_int($b)) {
            throw new ArgumentException();
        }

        return Math::add($a, $b);
    }
}
