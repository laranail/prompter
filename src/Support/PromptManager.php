<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Support;

use Closure;
use Illuminate\Support\Collection;
use BadMethodCallException;
use Laravel\Prompts\ConfirmPrompt;
use Laravel\Prompts\FormBuilder;
use Laravel\Prompts\MultiSearchPrompt;
use Laravel\Prompts\MultiSelectPrompt;
use Laravel\Prompts\PasswordPrompt;
use Laravel\Prompts\PausePrompt;
use Laravel\Prompts\Progress;
use Laravel\Prompts\SearchPrompt;
use Laravel\Prompts\SelectPrompt;
use Laravel\Prompts\Spinner;
use Laravel\Prompts\SuggestPrompt;
use Laravel\Prompts\Table;
use Laravel\Prompts\TextareaPrompt;
use Laravel\Prompts\TextPrompt;
use Simtabi\Laranail\Prompter\Exceptions\PrompterException;
use Simtabi\Laranail\Prompter\Enums\ContextType;

/**
 * Class PromptManager
 *
 * This class manages various prompt types for user input.
 *
 * Usage example:
 * $prompts = new PromptManager(
 *     new TextPrompt(),
 *     new TextareaPrompt(),
 *     new PasswordPrompt(),
 *     new SelectPrompt(),
 *     new MultiSelectPrompt(),
 *     new ConfirmPrompt(),
 *     new PausePrompt(),
 *     new SuggestPrompt(),
 *     new SearchPrompt(),
 *     new MultiSearchPrompt(),
 *     new Spinner(),
 *     new Table(),
 *     new Progress(),
 *     new FormBuilder(),
 *     new ContextBuilder()
 * );
 * $userName = $prompts->text('Enter your name');
 *
 * @method string text(string $label, string $placeholder = '', string $default = '', bool|string $required = false, mixed $validate = null, string $hint = '')
 * @method string textarea(string $label, string $placeholder = '', string $default = '', bool|string $required = false, ?Closure $validate = null, string $hint = '', int $rows = 5)
 * @method string password(string $label, string $placeholder = '', bool|string $required = false, mixed $validate = null, string $hint = '')
 * @method int|string select(string $label, array|Collection $options, int|string|null $default = null, int $scroll = 5, mixed $validate = null, string $hint = '', bool|string $required = true)
 * @method array multiselect(string $label, array|Collection $options, array|Collection $default = [], int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = 'Use the space bar to select options.')
 * @method bool confirm(string $label, bool $default = true, string $yes = 'Yes', string $no = 'No', bool|string $required = false, mixed $validate = null, string $hint = '')
 * @method bool pause(string $message = 'Press enter to continue...')
 * @method string suggest(string $label, array|Collection|Closure $options, string $placeholder = '', string $default = '', int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = '')
 * @method int|string search(string $label, Closure $options, string $placeholder = '', int $scroll = 5, mixed $validate = null, string $hint = '', bool|string $required = true)
 * @method array multisearch(string $label, Closure $options, string $placeholder = '', int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = 'Use the space bar to select options.')
 * @method mixed spin(Closure $callback, string $message = '')
 * @method void table(array|Collection $headers = [], array|Collection|null $rows = null)
 * @method Progress|array progress(string $label, iterable|int $steps, ?Closure $callback = null, string $hint = '')
 * @method FormBuilder form()
 */
class PromptManager
{
    public const string TEXT = 'text';
    public const string TEXTAREA = 'textarea';
    public const string PASSWORD = 'password';
    public const string SELECT = 'select';
    public const string MULTISELECT = 'multiselect';
    public const string CONFIRM = 'confirm';
    public const string PAUSE = 'pause';
    public const string SUGGEST = 'suggest';
    public const string SEARCH = 'search';
    public const string MULTISEARCH = 'multisearch';
    public const string SPIN = 'spin';
    public const string TABLE = 'table';
    public const string PROGRESS = 'progress';
    public const string FORM = 'form';

    /**
     * @var array<string, callable>
     */
    protected array $methods;

    /**
     * @var ContextBuilder
     */
    protected ContextBuilder $contextBuilder;

    /**
     * Constructor to initialize prompt methods and context service.
     *
     */
    public function __construct() {
        $this->methods = [
            self::TEXT => function (string $label, string $placeholder = '', string $default = '', bool|string $required = false, mixed $validate = null, string $hint = '') use ($textPrompt): string {
                return (new TextPrompt($label, $placeholder, $default, $required, $validate, $hint))->prompt();
            },

            self::TEXTAREA => function (string $label, string $placeholder = '', string $default = '', bool|string $required = false, ?Closure $validate = null, string $hint = '', int $rows = 5) use ($textareaPrompt): string {
                return (new TextareaPrompt($label, $placeholder, $default, $required, $validate, $hint, $rows))->prompt();
            },

            self::PASSWORD => function (string $label, string $placeholder = '', bool|string $required = false, mixed $validate = null, string $hint = '') use ($passwordPrompt): string {
                return (new PasswordPrompt($label, $placeholder, $required, $validate, $hint))->prompt();
            },

            self::SELECT => function (string $label, array|Collection $options, int|string|null $default = null, int $scroll = 5, mixed $validate = null, string $hint = '', bool|string $required = true) use ($selectPrompt): int|string {
                return (new SelectPrompt($label, $options, $default, $scroll, $validate, $hint, $required))->prompt();
            },

            self::MULTISELECT => function (string $label, array|Collection $options, array|Collection $default = [], int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = 'Use the space bar to select options.') use ($multiSelectPrompt): array {
                return (new MultiSelectPrompt($label, $options, $default, $scroll, $required, $validate, $hint))->prompt();
            },

            self::CONFIRM => function (string $label, bool $default = true, string $yes = 'Yes', string $no = 'No', bool|string $required = false, mixed $validate = null, string $hint = '') use ($confirmPrompt): bool {
                return (new ConfirmPrompt($label, $default, $yes, $no, $required, $validate, $hint))->prompt();
            },

            self::PAUSE => function (string $message = 'Press enter to continue...') use ($pausePrompt): bool {
                return (new PausePrompt($message))->prompt();
            },

            self::SUGGEST => function (string $label, array|Collection|Closure $options, string $placeholder = '', string $default = '', int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = '') use ($suggestPrompt): string {
                return (new SuggestPrompt($label, $options, $placeholder, $default, $scroll, $required, $validate, $hint))->prompt();
            },

            self::SEARCH => function (string $label, Closure $options, string $placeholder = '', int $scroll = 5, mixed $validate = null, string $hint = '', bool|string $required = true) use ($searchPrompt): int|string {
                return (new SearchPrompt($label, $options, $placeholder, $scroll, $validate, $hint, $required))->prompt();
            },

            self::MULTISEARCH => function (string $label, Closure $options, string $placeholder = '', int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = 'Use the space bar to select options.') use ($multiSearchPrompt): array {
                return (new MultiSearchPrompt($label, $options, $placeholder, $scroll, $required, $validate, $hint))->prompt();
            },

            self::SPIN => function (Closure $callback, string $message = '') use ($spinner): mixed {
                return (new Spinner($message))->spin($callback);
            },

            self::TABLE => function (array|Collection $headers = [], array|Collection|null $rows = null) use ($table): void {
                (new Table($headers, $rows))->display();
            },

            self::PROGRESS => function (string $label, iterable|int $steps, ?Closure $callback = null, string $hint = '') use ($progress): Progress|array {
                return (new Progress($label, $steps, $hint))->map($callback);
            },

            self::FORM => function (): FormBuilder {
                return new FormBuilder();
            },
        ];

        $this->contextBuilder = new ContextBuilder();
    }

    /**
     * Magic method to dynamically call prompt methods.
     *
     * @param string $method The name of the method.
     * @param array $arguments The arguments to pass to the method.
     * @return mixed The result of the method call.
     *
     * @throws BadMethodCallException|PrompterException If the method does not exist.
     */
    public function __call(string $method, array $arguments): mixed
    {
        if (isset($this->methods[$method])) {
            return $this->methods[$method](...$arguments);
        }

        throw PrompterException::triggerErrorMessage('method_does_not_exist', ['method' => $method, 'class' => static::class]);
    }

    /**
     * Provides access to context-related methods.
     *
     * @return ContextBuilder An instance of ContextBuilder with context-related methods.
     */
    public function context(): ContextBuilder
    {
        return $this->contextBuilder;
    }
}
