<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class NameFieldValidator
 *
 * Validates name fields (full name / first and/or last name).
 */
class NameFieldValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'name');
    }

    public function validate(mixed $value): ?string
    {
        return preg_match('/^[\p{L} \'-]+$/u', $value) ? null : $this->errorMessage;
    }
}
