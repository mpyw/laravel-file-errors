<?php

namespace Mpyw\LaravelFileErrors;

use Illuminate\Http\UploadedFile;

/**
 * Class IncludesFileErrorDetails
 *
 * @mixin \Illuminate\Validation\Validator
 */
trait IncludesFileErrorDetails
{
    /**
     * Add a failed rule and error message to the collection.
     *
     * @param string $attribute
     * @param string $rule
     * @param array  $parameters
     */
    public function addFailure($attribute, $rule, $parameters = [])
    {
        if ($rule === 'uploaded' && ($value = $this->getValue($attribute)) instanceof UploadedFile) {
            $rule = 'uploaded.' . UploadError::fromFile($value);
        }

        parent::addFailure($attribute, $rule, $parameters);
    }
}
