<?php

namespace App\Actions;

use App\Http\Rpc\Response;

class ShortenLinkAction extends AbstractAction
{
    public function shorten(string $link): Response
    {
        return $this->request(['link' => $link]);
    }

    public function getActionName(): string
    {
        return 'shorten';
    }
}
