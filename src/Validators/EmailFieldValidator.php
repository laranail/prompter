<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class EmailFieldValidator
 *
 * Validates email fields.
 */
class EmailFieldValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'email');
    }

    public function validate(mixed $value): ?string
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) ? null : $this->errorMessage;
    }
}
