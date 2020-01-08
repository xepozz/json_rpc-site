<?php
declare(strict_types=1);


use Phalcon\Mvc\Router;

/**
 * @var $router Router
 */

$router->add('/confirm/{code}/{email}', [
    'controller' => 'user_control',
    'action'     => 'confirmEmail',
]);

$router->add('/reset-password/{code}/{email}', [
    'controller' => 'user_control',
    'action'     => 'resetPassword',
]);
