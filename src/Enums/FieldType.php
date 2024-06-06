<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Enums;

/**
 * Enum FieldType
 *
 * Represents various form field types.
 */
enum FieldType: string
{
    case TEXT = 'text';
    case NUMBER = 'number';
    case EMAIL = 'email';
    case PASSWORD = 'password';
    case TEXTAREA = 'textarea';
    case DATE = 'date';
    case TIME = 'time';
    case SELECT = 'select';
    case CHECKBOX = 'checkbox';
    case RADIO = 'radio';
    case PATH = 'path';
    case USERNAME = 'username';
    case PHONE = 'phone';
    case COLOR = 'color';
    case NULL_OR_EMPTY = 'null_or_empty';
    case ARRAY = 'array';
    case OBJECT = 'object';
    case UUID = 'uuid';
    case ALPHA = 'alpha';
    case ALPHANUMERIC = 'alphanumeric';
    case UUID_OR_INTEGER_OR_SLUG = 'uuid_or_integer_or_slug';


    /**
     * Get all enum values as array keys with custom labels.
     *
     * @return array
     */
    public static function keysWithLabels(): array
    {
        return [
            self::TEXT->value => 'Text',
            self::NUMBER->value => 'Number',
            self::EMAIL->value => 'Email',
            self::PASSWORD->value => 'Password',
            self::TEXTAREA->value => 'Textarea',
            self::DATE->value => 'Date',
            self::TIME->value => 'Time',
            self::SELECT->value => 'Select',
            self::CHECKBOX->value => 'Checkbox',
            self::RADIO->value => 'Radio',
            self::PATH->value => 'Path',
            self::USERNAME->value => 'Username',
            self::PHONE->value => 'Phone',
            self::COLOR->value => 'Color',
            self::NULL_OR_EMPTY->value => 'Null or Empty',
            self::ARRAY->value => 'Array',
            self::OBJECT->value => 'Object',
            self::OBJECT->value => 'Object',
            self::UUID->value => 'UUID',
            self::ALPHA->value => 'Alpha',
            self::ALPHANUMERIC->value => 'Alphanumeric',
            self::UUID_OR_INTEGER_OR_SLUG->value => 'UUID or Integer or Slug',
        ];
    }

    /**
     * Get all enum values as array keys.
     *
     * @return array
     */
    public static function keys(): array
    {
        $keys = [];
        foreach (self::cases() as $case) {
            $keys[$case->value] = $case->name;
        }
        return $keys;
    }

    /**
     * Get the label for a specific enum value.
     *
     * @return string
     */
    public function label(): string
    {
        return self::keysWithLabels()[$this->value] ?? $this->name;
    }
}
