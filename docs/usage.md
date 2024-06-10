# Usage

## Instantiation
There are several ways to instantiate the `Prompter` repository. You can use the `new` keyword or the `make` method. Here are some examples:

1. **By using the ``prompter()`` helper function**

```php
use function Laravel\Prompts\prompter;

// Instantiates the Prompter instance, and returns the instance
$prompter = prompter();
```

2. **By using the ``Prompter`` facade**

```php
use Prompter;

// Here we will use the facade to instantiate the form instance
$form = Prompter::form();
// then we can chain the methods to build the form from the $form instance. i.e
// $form->text('Enter your name')->confirm('Are you sure?')->note('Thank you for confirming');
```

3. **By using the ``Prompter`` instance**

```php
use Simtabi\Laranail\Prompter\Prompter;

// Here we will use the facade to instantiate the form instance
$prompter = Prompter::getInstance();
$form = $prompter->form();
// then we can chain the methods to build the form from the $form instance. i.e
// $form->text('Enter your name')->confirm('Are you sure?')->note('Thank you for confirming');
```


## Special Functions
This package provides several special functions that you can use to enhance your CLI application development.
These functions include:
```php
use Simtabi\Laranail\Prompter\Prompter;

// Here we will use the facade to instantiate the form instance
$prompter = Prompter::getInstance();

// Retrieve the result of the last prompt
$prompter->getResult();

// Retrieve all prompts, for a fluent and easy method chaining
$prompter->getPrompts();
```

## Building a Form
To build a form, you can use the `form` method of the `Prompter` instance. This method returns a `FormBuilderService` instance that you can use to create a form.

1. **FormBuilderService**

The `FormBuilderService` class is the core class of the `Prompter` package. It provides a fluent API for creating complex CLI forms with ease.

2. **FormFieldService**

The `FormFieldService` class provides for a fluent way to create form fields in the CLI form. It is used internally by the `FormFieldService` class to manage form fields.


```php
// Instantiate required class objects
use Simtabi\Laranail\Prompter\Enums\FieldType;
use Simtabi\Laranail\Prompter\Prompter;
use Simtabi\Laranail\Prompter\Services\FormBuilder\FormBuilderService;
use Simtabi\Laranail\Prompter\Services\FormBuilder\FormFieldService;

// Instantiate the Prompter instance, and pas the form instance to it.
$formBuilder = new FormBuilderService($prompter->form());

// Fluently chain the methods to create a form with multiple fields from the $formBuilder instance
$formBuilder
    ->addField('className', (new FormFieldService(FieldType::TEXT))
        ->label('What is the class name of the setting class?')
        ->placeholder('Class Name')
        ->required(true)
        ->hint('Enter the class name. Leave blank to use the default.'))
    ->addField('groupIdentifier', (new FormFieldService(FieldType::UUID_OR_INTEGER_OR_SLUG))
        ->label('Enter the group identifier (slug/id).')
        ->placeholder('Group Identifier')
        ->default('application-settings')
        ->required(true)
        ->hint('Enter the group identifier. Leave blank to use the default.'))
    ->addField('subgroupIdentifier', (new FormFieldService(FieldType::UUID_OR_INTEGER_OR_SLUG))
        ->label('Enter the subgroup identifier (slug/id).')
        ->placeholder('Subgroup Identifier')
        ->default('general-settings')
        ->required(false)
        ->hint('Enter the subgroup identifier. Leave blank to use the default.'))
    ->addField('ownerableType', (new FormFieldService(FieldType::TEXT))
        ->label('Enter the Owner Type.')
        ->placeholder('Owner Type')
        ->required(true)
        ->hint('Enter the Owner Type.'))
    ->addField('ownerableId', (new FormFieldService(FieldType::UUID))
        ->label('Enter the Owner Id (UUID).')
        ->placeholder('Owner Id')
        ->required(true)
        ->hint('Enter the Owner Id (UUID).'))
    ->addField('namespacePath', (new FormFieldService(FieldType::TEXT))
        ->label('Enter the (namespace) path to write the setting class file to')
        ->placeholder('Namespace Path')
        ->default($this->resolveSettingsPath())
        ->required(true)
        ->hint('Enter the (namespace) path. Leave blank to use the default.')
        ->validator(new PathFieldValidator()))

    ->addField('tenantId', (new FormFieldService(FieldType::UUID))
        ->label('Enter the Tenant ID (UUID)')
        ->placeholder('Tenant ID')
        ->required(false)
        ->hint('Enter the Tenant ID (UUID). Leave blank to ignore.')
        
        // Add a custom error message
        ->customErrorMessage('Invalid UUID format.')
        // Add a custom validator to check if the value is a valid UUID
        ->customValidator(function ($value) {
            return preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){3}-[a-f\d]{12}$/i', $value) ? null : 'Invalid UUID format.';
        })
    );

return $formBuilder->build()->submit();
```




### Creating a Command
To create a command that uses the `Prompter` package, you can extend the `AbstractPrompterCommand` class provided by the package.
This class provides a convenient way to interact with the `Prompter` package and build CLI forms.
```php
use Simtabi\Laranail\Prompter\Console\AbstractPrompterCommand;

```

The `AbstractPrompterCommand` class provides several methods that you can use to build CLI forms, including:
1. `sanitizeInput`: A method that sanitizes the input data.




### Creating a Validator
To create a custom validator, you can extend the `AbstractValidator` class provided by the package.
You can pass a `custom error message` and or `an error message key if using language files` to the constructor, which will be displayed if the validation fails.

**Here is a sample validator class**
```php
use Simtabi\Laranail\Prompter\Validators\AbstractValidator;

class AlphanumericValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'alphanumeric');
    }

    public function validate(mixed $value): ?string
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $value) ? null : $this->errorMessage;
    }
}

```



### Enums

There are several enums that you can use to define the type of field in the form. These enums are used to define the type of field in the form, and include:
1. `FieldType`: An enum that defines the type of field in the form.
2. `UUIDType`: An enum that defines the type of UUID field in the form.


**Here is a sample validator class**
```php
use Simtabi\Laranail\Prompter\Validators\AbstractValidator;

class AlphanumericValidator extends AbstractValidator
{
    public function __construct(?string $errorMessage = null)
    {
        parent::__construct($errorMessage, 'alphanumeric');
    }

    public function validate(mixed $value): ?string
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $value) ? null : $this->errorMessage;
    }
}

```

The `AbstractPrompterCommand` class provides several methods that you can use to build CLI forms, including:
1. `sanitizeInput`: A method that sanitizes the input data.



### Conclusion

This package simplifies the process of creating CLI applications that prompt users for input in a Laravel application. By using static methods and chaining, you can create intuitive and user-friendly prompts, ensuring your application gathers the necessary information efficiently.
