<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class TextAreaFieldValidator
 *
 * Validates textarea fields.
 */
class TextAreaFieldValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'textarea');
    }

    public function validate(mixed $value): ?string
    {
        return is_string($value) ? null : $this->errorMessage;
    }
}
