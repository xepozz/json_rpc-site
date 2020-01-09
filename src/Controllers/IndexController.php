<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Actions\ShortenLinkAction;
use App\Forms\CreateLinkForm;
use App\Http\Rpc\Response;
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

        /* @var $action \App\Actions\ShortenLinkAction */
        $action = $this->getDI()->get(ShortenLinkAction::class);
        $result = $action->shorten($code);
        if ($result->hasErrors()) {
            $this->showErrors($result);
        } else {
            $this->flash->success('Action result: ' . reset($result->getResult()));
        }
    }

    /**
     * @param \App\Http\Rpc\Response $result
     */
    private function showErrors(Response $result): void
    {
        $error = $result->getError();
        $this->flash->error($error['message']);

        $errors = $error['data'] ?? [];
        foreach ($errors as $error) {
            $this->flash->error($error['message']);
        }
    }
}
