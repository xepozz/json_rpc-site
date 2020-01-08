<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Actions\ShortLinkDoAction;
use App\Component\ShortLinkAction;
use App\Forms\CreateLinkForm;
use Phalcon\Http\RequestInterface;
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction(): void
    {
        if ($this->request->isPost()) {
            $this->processRequest($this->request);
        }

        $this->view->setLayout('create');
        $form = new CreateLinkForm();
        $this->view->setVar('form', $form);
        $this->view->setTemplateBefore('public');
    }

    private function processRequest(RequestInterface $request): void
    {
        $code = $request->get('link');
        $this->flash->success('Your link: ' . $code);
        $action = $this->getDI()->get(ShortLinkDoAction::class);
        $result = $action->shorten($code);
        $this->flash->success('Action result: ' . $result);
    }
}
