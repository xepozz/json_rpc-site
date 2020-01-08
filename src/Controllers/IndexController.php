<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Forms\CreateLinkForm;
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction(): void
    {
        $this->view->setLayout('create');
        $this->view->setVar('form', new CreateLinkForm());
        $this->view->setTemplateBefore('public');
    }
}
