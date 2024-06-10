<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Support\Form;

use Closure;
use Simtabi\Laranail\Prompter\Contracts\ValidatorInterface;
use Simtabi\Laranail\Prompter\Enums\FieldType;

/**
 * Class FormField
 *
 * Represents a form field configuration with method chaining.
 */
class FormFieldBuilder
{
    public FieldType $type;
    public string $label = '';
    public string $placeholder = '';
    public bool $required = false;
    public string $hint = '';
    public ?string $default = null;
    public ?array $options = null;
    public ?ValidatorInterface $validator = null;
    public ?Closure $customValidator = null;
    public ?string $customErrorMessage = null;

    /**
     * FormField constructor.
     *
     * @param FieldType $type The type of the form field.
     */
    public function __construct(FieldType $type)
    {
        $this->type = $type;
    }

    /**
     * Set the label of the form field.
     *
     * @param string $label The label of the form field.
     * @return $this
     */
    public function label(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Set the placeholder of the form field.
     *
     * @param string $placeholder The placeholder of the form field.
     * @return $this
     */
    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * Set whether the form field is required.
     *
     * @param bool $required Whether the form field is required.
     * @return $this
     */
    public function required(bool $required): self
    {
        $this->required = $required;
        return $this;
    }

    /**
     * Set the hint of the form field.
     *
     * @param string $hint The hint of the form field.
     * @return $this
     */
    public function hint(string $hint): self
    {
        $this->hint = $hint;
        return $this;
    }

    /**
     * Set the default value of the form field.
     *
     * @param ?string $default The default value of the form field.
     * @return $this
     */
    public function default(?string $default): self
    {
        $this->default = $default;
        return $this;
    }

    /**
     * Set the options of the form field.
     *
     * @param ?array $options The options of the form field.
     * @return $this
     */
    public function options(?array $options): self
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Set the validator of the form field.
     *
     * @param ?ValidatorInterface $validator The validator of the form field.
     * @return $this
     */
    public function validator(?ValidatorInterface $validator): self
    {
        $this->validator = $validator;
        return $this;
    }

    /**
     * Set the custom validator of the form field.
     *
     * @param ?Closure $customValidator The custom validator of the form field.
     * @return $this
     */
    public function customValidator(?Closure $customValidator): self
    {
        $this->customValidator = $customValidator;
        return $this;
    }

    /**
     * Set the custom error message for the form field.
     *
     * @param ?string $customErrorMessage The custom error message of the form field.
     * @return $this
     */
    public function customErrorMessage(?string $customErrorMessage): self
    {
        $this->customErrorMessage = $customErrorMessage;
        return $this;
    }
}
