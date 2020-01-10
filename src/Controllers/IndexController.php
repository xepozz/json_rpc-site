<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Actions\ShortenLinkAction;
use App\Exceptions\BadRequestException;
use App\Forms\CreateLinkForm;
use App\Http\Rpc\Response;
use Phalcon\Escaper;
use Phalcon\Http\RequestInterface;
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $form = new CreateLinkForm();

        if ($this->request->isPost() && $form->isValid($this->request->getPost())) {
            $this->processRequest($this->request);

            return $this->response->redirect();
        }

        if (count($messages = $form->getMessages()) > 0) {
            $this->flashSession->error('Validation error');
            foreach ($messages as $message) {
                $this->flashSession->error($message->getMessage());
            }
        }

        $this->view->setLayout('create');
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

            return;
        }

        $config = $this->di->get('config');
        $url = $config['application']['publicUrl'];

        $escaper = new Escaper();
        $result = $result->getResult();
        $code = reset($result);
        $this->flashSession->success(
            sprintf(
                'Your link: %s was successfully shortened to %s',
                $link,
                $escaper->escapeHtml($url . '/' . $code)
            )
        );
    }

    /**
     * @param \App\Http\Rpc\Response $result
     */
    private function showErrors(Response $result): void
    {
        $error = $result->getError();
        $this->flashSession->error($error['message']);

        $errors = $error['data'] ?? [];
        foreach ($errors as $error) {
            $this->flashSession->error($error['message']);
        }
    }
}
