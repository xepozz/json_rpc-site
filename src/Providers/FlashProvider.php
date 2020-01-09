<?php

declare(strict_types=1);

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Escaper;
use Phalcon\Flash\Session;

class FlashProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'flashSession';

    /**
     * @param DiInterface $di
     * @return void
     */
    public function register(DiInterface $di): void
    {
        $di->set(
            $this->providerName,
            function () {
                $escaper = new Escaper();
                $flash = new Session($escaper);
                $flash->setCssClasses(
                    [
                        'error' => 'alert alert-danger',
                        'success' => 'alert alert-success',
                        'notice' => 'alert alert-info',
                        'warning' => 'alert alert-warning',
                    ]
                );

                return $flash;
            }
        );
    }
}
