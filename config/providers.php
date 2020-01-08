<?php
declare(strict_types=1);

/**
 * This file is part of the Vökuró.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use App\Providers\ConfigProvider;
use App\Providers\DbProvider;
use App\Providers\DispatcherProvider;
use App\Providers\FlashProvider;
use App\Providers\LoggerProvider;
use App\Providers\ModelsMetadataProvider;
use App\Providers\RouterProvider;
use App\Providers\SessionBagProvider;
use App\Providers\SessionProvider;
use App\Providers\UrlProvider;
use App\Providers\ViewProvider;

return [
    ConfigProvider::class,
    DbProvider::class,
    DispatcherProvider::class,
    FlashProvider::class,
    LoggerProvider::class,
    ModelsMetadataProvider::class,
    RouterProvider::class,
    SessionBagProvider::class,
    SessionProvider::class,
    UrlProvider::class,
    ViewProvider::class,
];
