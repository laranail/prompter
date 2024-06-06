<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class CheckboxFieldValidator
 *
 * Validates checkbox fields.
 */
class CheckboxFieldValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'checkbox');
    }

    public function validate(mixed $value): ?string
    {
        return is_bool($value) ? null : $this->errorMessage;
    }
}
