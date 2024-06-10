# Changelog

All notable changes to `prompter` will be documented in this file

## v1.5.0 - June 6, 2024

1. Code refactoring
2. Introduced **Context Methods**: Context methods (`note`, `error`, `warning`, `alert`, `info`, `intro`, `outro`) are accessed exclusively through the `context()` function.
   - Instead of calling `info('Hello World')`, you can now call `context()->info('Hello World')`.

### Usage

```php

use Simtabi\Laranail\Prompter\Prompter;

$prompter = Prompter::getInstance();

// Example usage with method chaining
$result = $prompter->text('Enter your name')
    ->confirm('Is this correct?')
    ->getResult();

// Using the context method
$prompter->context()->info('This is an info message');
$prompter->context()->error('This is an error message');

// Using the form method
$form = $prompter->form();

```


## v1.0.0 - June 6, 2024

1. Initial release
