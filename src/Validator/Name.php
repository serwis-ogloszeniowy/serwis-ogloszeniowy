<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Name extends Constraint
{
    public $message = 'Imie może zawierać tylko litery';
}
