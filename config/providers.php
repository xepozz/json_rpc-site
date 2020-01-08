<?php

declare(strict_types=1);

use App\Providers\ConfigProvider;
use App\Providers\DispatcherProvider;
use App\Providers\FlashProvider;
use App\Providers\LoggerProvider;
use App\Providers\RouterProvider;
use App\Providers\ViewProvider;

return [
    ConfigProvider::class,
    DispatcherProvider::class,
    FlashProvider::class,
    LoggerProvider::class,
    RouterProvider::class,
    ViewProvider::class,
];
