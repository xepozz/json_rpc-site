<?php

declare(strict_types=1);

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
        $this->view->setVar('form', new UsersForm());
        $this->view->setTemplateBefore('public');
    }
}
