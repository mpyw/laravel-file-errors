<?php

namespace Mpyw\LaravelFileErrors;

use Illuminate\Validation\Validator as BaseValidator;

/**
 * Class Validator
 */
class Validator extends BaseValidator
{
    use IncludesFileErrorDetails;
}
