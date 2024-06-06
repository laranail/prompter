<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

use Simtabi\Laranail\Prompter\Contracts\ValidatorInterface;

/**
 * Abstract Class AbstractValidator
 *
 * Abstract base class for validators.
 */
abstract class AbstractValidator implements ValidatorInterface
{
    protected string $errorMessage;

    /**
     * AbstractValidator constructor.
     *
     * @param string|null $errorMessage The error message to use if validation fails.
     * @param string $defaultMessageKey The default message key for translation.
     * @param array $replace
     * @param string|null $locale
     */
    public function __construct(?string $errorMessage = null, string $defaultMessageKey = '', array $replace = [], ?string $locale = null)
    {
        $this->errorMessage = $errorMessage ?? __('prompter::validators.' . $defaultMessageKey, $replace, $locale);
    }

    /**
     * Validate the given value.
     *
     * @param mixed $value The value to validate.
     * @return string|null The error message if validation fails, or null if validation passes.
     */
    abstract public function validate(mixed $value): ?string;
}
