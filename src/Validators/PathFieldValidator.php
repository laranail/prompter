<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Validators;

use Illuminate\Support\Facades\File;

/**
 * Class PathFieldValidator
 *
 * Validates path fields.
 */
class PathFieldValidator extends AbstractValidator
{

    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'path');
    }

    public function validate(mixed $value): ?string
    {
        return File::exists($value) && is_string($value) ? null : $this->errorMessage;
    }
}
