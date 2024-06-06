<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class ObjectValidator
 *
 * Validates object fields.
 */
class ObjectValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'object');
    }

    public function validate(mixed $value): ?string
    {
        return is_object($value) ? null : $this->errorMessage;
    }
}
