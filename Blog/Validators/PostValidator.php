<?php

namespace Modules\Blog\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PostValidator.
 *
 * @package namespace App\Validators;
 */
class PostValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:65000',
            'image' => 'required|string|max:255'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:65000',
            'image' => 'required|string|max:255'
        ],
    ];

    protected $messages = [
        'image.required' => 'We need to know your image url!',
    ];

    protected $attributes = [
        'image' => 'Image',
        'title' => 'Title',
    ];
}
