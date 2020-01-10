<?php

declare(strict_types=1);

namespace App\Forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Callback;
use Phalcon\Validation\Validator\PresenceOf;

class CreateLinkForm extends Form
{
    public function initialize()
    {
        $password = new Text('link');
        $password->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'The :field is required',
                    ]
                ),
                new Callback(
                    [
                        'callback' => function ($data) {
                            $pattern = '#^https?://[\w\-.]+/?[.*]#';

                            return preg_match($pattern, $data['link']) === 1;
                        },
                        'message' => ':field contain invalid url',
                    ]
                ),
            ]
        );
        $this->add($password);
    }
}
