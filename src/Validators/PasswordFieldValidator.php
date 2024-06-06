<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class PasswordFieldValidator
 *
 * Validates password fields.
 */
class PasswordFieldValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'password');
    }

    public function validate(mixed $value): ?string
    {
        return is_string($value) && strlen($value) >= 8 ? null : $this->errorMessage;
    }
}
