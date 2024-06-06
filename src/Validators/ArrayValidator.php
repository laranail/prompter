<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class ArrayValidator
 *
 * Validates array fields.
 */
class ArrayValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'array');
    }

    public function validate(mixed $value): ?string
    {
        return is_array($value) ? null : $this->errorMessage;
    }
}
