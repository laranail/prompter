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
            $formField->validator = $this->getDefaultValidator($formField->type);
        }
        $this->fields[$name] = $formField;
        return $this;
    }

    /**
     * Get the default validator for a given field type.
     *
     * @param FieldType $type The type of the form field.
     * @return ValidatorInterface
     * @throws PrompterException
     */
    protected function getDefaultValidator(FieldType $type): ValidatorInterface
    {
        return match ($type) {
            FieldType::TEXT => new TextFieldValidator(),
            FieldType::NUMBER => new NumberFieldValidator(),
            FieldType::EMAIL => new EmailFieldValidator(),
            FieldType::PASSWORD => new PasswordFieldValidator(),
            FieldType::TEXTAREA => new TextAreaFieldValidator(),
            FieldType::DATE => new DateFieldValidator(),
            FieldType::TIME => new TimeFieldValidator(),
            FieldType::SELECT => new SelectFieldValidator([]),
            FieldType::CHECKBOX => new CheckboxFieldValidator(),
            FieldType::RADIO => new RadioFieldValidator([]),
            FieldType::PATH => new PathFieldValidator(),
            FieldType::USERNAME => new UsernameValidator(),
            FieldType::PHONE => new PhoneNumberValidator(),
            FieldType::COLOR => new ColorValidator(),
            FieldType::NULL_OR_EMPTY => new NullOrEmptyValidator(),
            FieldType::ARRAY => new ArrayValidator(),
            FieldType::OBJECT => new ObjectValidator(),
            FieldType::UUID => new UUIDFieldValidator(),
            FieldType::ALPHA => new AlphaValidator(),
            FieldType::ALPHANUMERIC => new AlphanumericValidator(),
            FieldType::UUID_OR_INTEGER_OR_SLUG => new UuidOrIntegerOrSlugValidator(),
            default => throw PrompterException::triggerErrorMessage('unsupported_input_type', ['type' => $type]),
        };
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
        $methods = [
            FieldType::TEXT->value => 'text',
            FieldType::NUMBER->value => 'number',
            FieldType::EMAIL->value => 'email',
            FieldType::PASSWORD->value => 'password',
            FieldType::TEXTAREA->value => 'textarea',
            FieldType::DATE->value => 'date',
            FieldType::TIME->value => 'time',
            FieldType::SELECT->value => 'select',
            FieldType::CHECKBOX->value => 'checkbox',
            FieldType::RADIO->value => 'radio',
            FieldType::PATH->value => 'text',
            FieldType::USERNAME->value => 'text', // Assuming form method supports text for username
            FieldType::PHONE->value => 'text', // Assuming form method supports text for phone
            FieldType::COLOR->value => 'text', // Assuming form method supports text for color
            FieldType::NULL_OR_EMPTY->value => 'text', // Assuming form method supports text for null/empty
            FieldType::ARRAY->value => 'textarea', // Assuming form method supports textarea for array
            FieldType::OBJECT->value => 'textarea', // Assuming form method supports textarea for object
            FieldType::UUID->value => 'text', // Assuming form method supports text for uuid
            FieldType::ALPHA->value => 'text', // Assuming form method supports text for alpha
            FieldType::ALPHANUMERIC->value => 'text', // Assuming form method supports text for alphanumeric
            FieldType::UUID_OR_INTEGER_OR_SLUG->value => 'text', // Assuming form method supports text for uuid_or_integer_or_slug
        ];

        if (!isset($methods[$formField->type->value])) {
            throw PrompterException::triggerErrorMessage('unsupported_input_type', ['type' => $formField->type->value]);
        }

        $method = $methods[$formField->type->value];
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
