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

namespace App\Controllers;

use Phalcon\Mvc\Controller;

/**
 * Display the default index page.
 */
class IndexController extends Controller
{
    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function indexAction(): void
    {
        $this->view->setTemplateBefore('public');
    }
}
