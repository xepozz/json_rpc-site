<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Actions\ShortenLinkAction;
use App\Exceptions\BadRequestException;
use App\Forms\CreateLinkForm;
use App\Http\Rpc\Response;
use Phalcon\Http\RequestInterface;
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        if ($this->request->isPost()) {
            $this->processRequest($this->request);
            return $this->response->redirect();
        }

        $this->view->setLayout('create');
        $form = new CreateLinkForm();
        $this->view->setVar('form', $form);
        $this->view->setTemplateBefore('public');
    }

    private function processRequest(RequestInterface $request): void
    {
        $link = $request->get('link');

        /* @var $action \App\Actions\ShortenLinkAction */
        $action = $this->getDI()->get(ShortenLinkAction::class);

        try {
            $result = $action->shorten($link);
        } catch (BadRequestException $e) {
            $this->flashSession->error($e->getMessage());

            return;
        }

        if ($result->hasErrors()) {
            $this->showErrors($result);
        } else {
            $config = $this->di->get('config');
            $url = $config['application']['publicUrl'];

            $result = $result->getResult();
            $code = reset($result);
            $this->flashSession->success(
                sprintf(
                    'Your link: %s was successfully shortened to %s',
                    $link,
                    $url . '/' . $code
                )
            );
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
