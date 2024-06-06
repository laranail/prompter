# Validators Documentation

## Table of Contents
1. [Introduction](#introduction)
2. [Validators List](#validators-list)
3. [Detailed Descriptions](#detailed-descriptions)

## Introduction

This documentation provides an overview and detailed descriptions of the validators included in the `Prompter` package. Each validator extends an abstract class and includes specific parameters and functionalities to validate different types of input.

## Validators List

| #  | Validator                    | Description                                              | Parameters          |
|----|------------------------------|----------------------------------------------------------|---------------------|
| 1  | AlphanumericValidator | Validates that the input contains only alphanumeric characters. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 2  | AlphaValidator | Validates that the input contains only alphabetic characters. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 3  | ArrayValidator | Validates that the input is an array. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 4  | BooleanFieldValidator | Validates that the input is a boolean value. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 5  | CheckboxFieldValidator | Validates that the input is a valid checkbox value. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 6  | ColorValidator | Validates that the input is a valid color code. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 7  | DateFieldValidator | Validates that the input is a valid date. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 8  | EmailFieldValidator | Validates that the input is a valid email address. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 9  | JsonFieldValidator | Validates that the input is a valid JSON string. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 10 | NameFieldValidator | Validates that the input is a valid name. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 11 | NullOrEmptyValidator | Validates that the input is null or empty. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 12 | NumberFieldValidator | Validates that the input is a valid number. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 13 | ObjectValidator | Validates that the input is a valid object. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 14 | PasswordFieldValidator | Validates that the input meets password requirements. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 15 | PathFieldValidator | Validates that the input is a valid file path. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 16 | PhoneNumberValidator | Validates that the input is a valid phone number. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 17 | RadioFieldValidator | Validates that the input is a valid radio button value. | array $options (Required), ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 18 | SelectFieldValidator | Validates that the input is a valid select field value. | array $options (Required), ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 19 | StringFieldValidator | Validates that the input is a string. | int $minLength = 0 (Optional), int $maxLength = 255 (Optional), ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 20 | TextAreaFieldValidator | Validates that the input is a valid text area value. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 21 | TextFieldValidator | Validates that the input is a valid text field value. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 22 | TimeFieldValidator | Validates that the input is a valid time. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 23 | UsernameValidator | Validates that the input is a valid username. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 24 | UUIDFieldValidator | Validates that the input is a valid UUID. | ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |
| 25 | UuidOrIntegerOrSlugValidator | Validates that the input is a UUID, integer, or slug. | string $uuidVersion = 'uuid' (Optional), ?string $errorMessage = null (Optional), array $replace = [] (Optional), ?string $locale = null (Optional) |




# Advanced Validators Usage Documentation

## Base Class

### AbstractValidator

Abstract base class for validators. This class implements the `ValidatorInterface` and provides a constructor to set error messages and an abstract `validate` method that each validator must implement.

**Constructor Parameters:**
- **$errorMessage**: (string, Optional) The error message to use if validation fails.
- **$defaultMessageKey**: (string, Optional) The default message key for translation.
- **$replace**: (array, Optional) Array of values to replace in the message.
- **$locale**: (string, Optional) The locale for translation.

**Methods:**
- **validate(mixed $value): ?string**: Validates the given value.

### AlphanumericValidator

**Description**: Validates that the input contains only alphanumeric characters.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new AlphanumericValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### AlphaValidator

**Description**: Validates that the input contains only alphabetic characters.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new AlphaValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### ArrayValidator

**Description**: Validates that the input is an array.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new ArrayValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### BooleanFieldValidator

**Description**: Validates that the input is a boolean value.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new BooleanFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### CheckboxFieldValidator

**Description**: Validates that the input is a valid checkbox value.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new CheckboxFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### ColorValidator

**Description**: Validates that the input is a valid color code.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new ColorValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### DateFieldValidator

**Description**: Validates that the input is a valid date.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new DateFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### EmailFieldValidator

**Description**: Validates that the input is a valid email address.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new EmailFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### JsonFieldValidator

**Description**: Validates that the input is a valid JSON string.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new JsonFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### NameFieldValidator

**Description**: Validates that the input is a valid name.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new NameFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### NullOrEmptyValidator

**Description**: Validates that the input is null or empty.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new NullOrEmptyValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### NumberFieldValidator

**Description**: Validates that the input is a valid number.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new NumberFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### ObjectValidator

**Description**: Validates that the input is a valid object.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new ObjectValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### PasswordFieldValidator

**Description**: Validates that the input meets password requirements.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new PasswordFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### PathFieldValidator

**Description**: Validates that the input is a valid file path.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new PathFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### PhoneNumberValidator

**Description**: Validates that the input is a valid phone number.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new PhoneNumberValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### RadioFieldValidator

**Description**: Validates that the input is a valid radio button value.

**Constructor Parameters:**
- **$options**: (array, Required)
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new RadioFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### SelectFieldValidator

**Description**: Validates that the input is a valid select field value.

**Constructor Parameters:**
- **$options**: (array, Required)
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new SelectFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### StringFieldValidator

**Description**: Validates that the input is a string.

**Constructor Parameters:**
- **0**: (int, Optional)
- **255**: (int, Optional)
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new StringFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### TextAreaFieldValidator

**Description**: Validates that the input is a valid text area value.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new TextAreaFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### TextFieldValidator

**Description**: Validates that the input is a valid text field value.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new TextFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### TimeFieldValidator

**Description**: Validates that the input is a valid time.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new TimeFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### UsernameValidator

**Description**: Validates that the input is a valid username.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new UsernameValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### UUIDFieldValidator

**Description**: Validates that the input is a valid UUID.

**Constructor Parameters:**
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new UUIDFieldValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```

### UuidOrIntegerOrSlugValidator

**Description**: Validates that the input is a UUID, integer, or slug.

**Constructor Parameters:**
- **'uuid'**: (string, Optional)
- **null**: (?string, Optional)
- **[]**: (array, Optional)
- **null**: (?string, Optional)

**Example Usage:**
```php
$validator = new UuidOrIntegerOrSlugValidator();
$error = $validator->validate('your_value_here');
if ($error) {
    echo $error;
}
```
