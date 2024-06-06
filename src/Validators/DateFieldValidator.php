<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class DateFieldValidator
 *
 * Validates date fields.
 */
class DateFieldValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'date');
    }

    public function validate(mixed $value): ?string
    {
        return (bool)strtotime($value) ? null : $this->errorMessage;
    }
}
