<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

/**
 * Class AlphanumericValidator
 *
 * Validates fields that should contain only alphanumeric characters.
 */
class AlphanumericValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null, array $replace = [], ?string $locale = null)
    {
        parent::__construct($errorMessage, 'alphanumeric', $replace, $locale);
    }

    public function validate(mixed $value): ?string
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $value) ? null : $this->errorMessage;
    }
}
