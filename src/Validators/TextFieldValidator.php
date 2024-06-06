<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class TextFieldValidator
 *
 * Validates text fields.
 */
class TextFieldValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'text');
    }

    public function validate(mixed $value): ?string
    {
        return is_string($value) && strlen($value) <= 255 ? null : $this->errorMessage;
    }
}
