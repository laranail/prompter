<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Services;

use Closure;
use Illuminate\Support\Collection;
use BadMethodCallException;
use Laravel\Prompts\ConfirmPrompt;
use Laravel\Prompts\FormBuilder;
use Laravel\Prompts\MultiSearchPrompt;
use Laravel\Prompts\MultiSelectPrompt;
use Laravel\Prompts\Note;
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

/**
 * Class PromptManager
 *
 * This class manages various prompt types for user input.
 *
 * Usage example:
 * $prompts = new PromptManager();
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
 * @method void note(string $message, ?string $type = null)
 * @method void error(string $message)
 * @method void warning(string $message)
 * @method void alert(string $message)
 * @method void info(string $message)
 * @method void intro(string $message)
 * @method void outro(string $message)
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
    public const string NOTE = 'note';
    public const string ERROR = 'error';
    public const string WARNING = 'warning';
    public const string ALERT = 'alert';
    public const string INFO = 'info';
    public const string INTRO = 'intro';
    public const string OUTRO = 'outro';
    public const string TABLE = 'table';
    public const string PROGRESS = 'progress';
    public const string FORM = 'form';

    /**
     * @var array<string, callable>
     */
    protected array $methods;

    public function __construct()
    {
        $this->methods = [
            self::TEXT => function (string $label, string $placeholder = '', string $default = '', bool|string $required = false, mixed $validate = null, string $hint = ''): string {
                return (new TextPrompt($label, $placeholder, $default, $required, $validate, $hint))->prompt();
            },

            self::TEXTAREA => function (string $label, string $placeholder = '', string $default = '', bool|string $required = false, ?Closure $validate = null, string $hint = '', int $rows = 5): string {
                return (new TextareaPrompt($label, $placeholder, $default, $required, $validate, $hint, $rows))->prompt();
            },

            self::PASSWORD => function (string $label, string $placeholder = '', bool|string $required = false, mixed $validate = null, string $hint = ''): string {
                return (new PasswordPrompt($label, $placeholder, $required, $validate, $hint))->prompt();
            },

            self::SELECT => function (string $label, array|Collection $options, int|string|null $default = null, int $scroll = 5, mixed $validate = null, string $hint = '', bool|string $required = true): int|string {
                return (new SelectPrompt($label, $options, $default, $scroll, $validate, $hint, $required))->prompt();
            },

            self::MULTISELECT => function (string $label, array|Collection $options, array|Collection $default = [], int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = 'Use the space bar to select options.'): array {
                return (new MultiSelectPrompt($label, $options, $default, $scroll, $required, $validate, $hint))->prompt();
            },

            self::CONFIRM => function (string $label, bool $default = true, string $yes = 'Yes', string $no = 'No', bool|string $required = false, mixed $validate = null, string $hint = ''): bool {
                return (new ConfirmPrompt($label, $default, $yes, $no, $required, $validate, $hint))->prompt();
            },

            self::PAUSE => function (string $message = 'Press enter to continue...'): bool {
                return (new PausePrompt($message))->prompt();
            },

            self::SUGGEST => function (string $label, array|Collection|Closure $options, string $placeholder = '', string $default = '', int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = ''): string {
                return (new SuggestPrompt($label, $options, $placeholder, $default, $scroll, $required, $validate, $hint))->prompt();
            },

            self::SEARCH => function (string $label, Closure $options, string $placeholder = '', int $scroll = 5, mixed $validate = null, string $hint = '', bool|string $required = true): int|string {
                return (new SearchPrompt($label, $options, $placeholder, $scroll, $validate, $hint, $required))->prompt();
            },

            self::MULTISEARCH => function (string $label, Closure $options, string $placeholder = '', int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = 'Use the space bar to select options.'): array {
                return (new MultiSearchPrompt($label, $options, $placeholder, $scroll, $required, $validate, $hint))->prompt();
            },

            self::SPIN => function (Closure $callback, string $message = ''): mixed {
                return (new Spinner($message))->spin($callback);
            },

            self::NOTE => function (string $message, ?string $type = null): void {
                (new Note($message, $type))->display();
            },

            self::ERROR => function (string $message): void {
                (new Note($message, 'error'))->display();
            },

            self::WARNING => function (string $message): void {
                (new Note($message, 'warning'))->display();
            },

            self::ALERT => function (string $message): void {
                (new Note($message, 'alert'))->display();
            },

            self::INFO => function (string $message): void {
                (new Note($message, 'info'))->display();
            },

            self::INTRO => function (string $message): void {
                (new Note($message, 'intro'))->display();
            },

            self::OUTRO => function (string $message): void {
                (new Note($message, 'outro'))->display();
            },

            self::TABLE => function (array|Collection $headers = [], array|Collection|null $rows = null): void {
                (new Table($headers, $rows))->display();
            },

            self::PROGRESS => function (string $label, iterable|int $steps, ?Closure $callback = null, string $hint = ''): Progress|array {
                return (new Progress($label, $steps, $hint))->map($callback);
            },

            self::FORM => function (): FormBuilder {
                return new FormBuilder();
            },
        ];
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

}
