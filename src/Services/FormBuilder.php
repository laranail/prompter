<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Services;

use Laravel\Prompts\FormBuilder as PromptsFormBuilder;
use Simtabi\Laranail\Prompter\Contracts\ValidatorInterface;
use Simtabi\Laranail\Prompter\Enums\FieldType;
use Simtabi\Laranail\Prompter\Exceptions\PrompterException;
use Simtabi\Laranail\Prompter\Validators\{AlphanumericValidator,
    AlphaValidator,
    ArrayValidator,
    ColorValidator,
    NullOrEmptyValidator,
    ObjectValidator,
    PhoneNumberValidator,
    TextFieldValidator,
    NumberFieldValidator,
    EmailFieldValidator,
    PathFieldValidator,
    PasswordFieldValidator,
    TextAreaFieldValidator,
    DateFieldValidator,
    TimeFieldValidator,
    SelectFieldValidator,
    CheckboxFieldValidator,
    RadioFieldValidator,
    UsernameValidator,
    UUIDFieldValidator,
    UuidOrIntegerOrSlugValidator};
use Illuminate\Filesystem\Filesystem;

/**
 * Class FormBuilder
 *
 * Builds a form dynamically with various input fields.
 */
class FormBuilder
{
    protected PromptsFormBuilder $form;
    protected Filesystem $files;
    protected array $fields = [];

    /**
     * FormBuilder constructor.
     *
     * @param PromptsFormBuilder $form The form instance.
     * @param Filesystem $files The filesystem instance.
     */
    public function __construct(PromptsFormBuilder $form, Filesystem $files)
    {
        $this->form  = $form;
        $this->files = $files;
    }

    /**
     * Add a field to the form.
     *
     * @param string $name The name of the form field.
     * @param FormField $formField The configuration for the form field.
     * @return $this
     * @throws PrompterException
     */
    public function addField(string $name, FormField $formField): self
    {
        if (!$formField->validator && !$formField->customValidator) {
            $formField->validator = FieldType::getDefaultValidator($formField->type);
        }
        $this->fields[$name] = $formField;
        return $this;
    }

    /**
     * Build the form by adding all configured fields.
     *
     * @return $this
     * @throws PrompterException
     */
    public function build(): self
    {
        foreach ($this->fields as $name => $formField) {
            $this->addFieldToForm($name, $formField);
        }
        return $this;
    }

    /**
     * Add a field to the form dynamically.
     *
     * @param string $name The name of the form field.
     * @param FormField $formField The configuration for the form field.
     * @throws PrompterException
     */
    protected function addFieldToForm(string $name, FormField $formField): void
    {
        $parameters = [
            'label' => $formField->label,
            'placeholder' => $formField->placeholder,
            'default' => $formField->default ?? '',
            'required' => $formField->required,
            'validate' => function($value) use ($formField) {
                if ($formField->required && empty($value)) {
                    return $formField->customErrorMessage ?? 'This field is required.';
                }
                if (!empty($value)) {
                    return $formField->customValidator ? ($formField->customValidator)($value) : $formField->validator?->validate($value);
                }
                return null;
            },
            'hint' => $formField->hint,
            'name' => $name,
        ];

        if ($formField->type === FieldType::SELECT || $formField->type === FieldType::RADIO) {
            $parameters['options'] = $formField->options ?? [];
        }

        $method = FieldType::getValidatorMethod($formField);
        $this->form->$method(...$parameters);
    }

    /**
     * Submit the form and return the collected input.
     *
     * @return array
     */
    public function submit(): array
    {
        return $this->form->submit();
    }
}
