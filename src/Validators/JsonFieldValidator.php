<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class JsonFieldValidator
 *
 * Validates JSON fields.
 */
class JsonFieldValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'json');
    }

    public function validate(mixed $value): ?string
    {
        json_decode($value);
        return json_last_error() === JSON_ERROR_NONE ? null : $this->errorMessage;
    }
}
