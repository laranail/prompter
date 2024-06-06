<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class AlphaValidator
 *
 * Validates fields that should contain only alphabetic characters.
 */
class AlphaValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'alpha');
    }

    public function validate(mixed $value): ?string
    {
        return preg_match('/^[a-zA-Z]+$/', $value) ? null : $this->errorMessage;
    }
}
