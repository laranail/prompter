<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class TimeFieldValidator
 *
 * Validates time fields.
 */
class TimeFieldValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'time');
    }

    public function validate(mixed $value): ?string
    {
        return (bool) strtotime($value) ? null : $this->errorMessage;
    }
}
