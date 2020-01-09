<?php

namespace App\Actions;

use App\Exceptions\BadRequestException;
use GuzzleHttp\Client;
use Phalcon\Di\Injectable;
use Psr\Http\Message\StreamInterface;
use Throwable;

abstract class AbstractAction extends Injectable
{
    public function request(array $params)
    {
        $config = $this->di->get('config');
        $url = $config['application']['jsonRpcUrl'];

        try {
            $client = new Client(
                [
                    'base_uri' => 'http://' . $url,
                    'timeout' => 3,
                    'allow_redirects' => false,
                ]
            );

            $response = $client
                ->post(
                    'rpc',
                    [
                        'form_params' => [
                            'jsonrpc' => '2.0',
                            'id' => $this->generateId(),
                            'params' => $params,
                            'method' => $this->getActionName(),
                        ],
                    ]
                );

            $body = $response
                ->getBody();

            print_r($body->getContents());
            exit();

            return $this->decode($body);
        } catch (Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    abstract public function getActionName(): string;

    private function decode(StreamInterface $body)
    {
        $options = JSON_UNESCAPED_UNICODE;

        return json_decode($body, true, 512, $options)['result'] ?? 'error';
    }

    private function generateId()
    {
        return random_int(100, 10000);
    }
}
