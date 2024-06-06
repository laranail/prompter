<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter;

use Closure;
use Illuminate\Support\Collection;
use Laravel\Prompts\FormBuilder;
use Simtabi\Laranail\Prompter\Exceptions\PrompterException;
use Simtabi\Laranail\Prompter\Services\PromptManager;

/**
 * Class Prompter
 *
 * This class provides a fluent interface for chaining prompt method calls.
 *
 * @method static self text(string $label, string $placeholder = '', string $default = '', bool|string $required = false, mixed $validate = null, string $hint = '')
 * @method static self textarea(string $label, string $placeholder = '', string $default = '', bool|string $required = false, ?Closure $validate = null, string $hint = '', int $rows = 5)
 * @method static self password(string $label, string $placeholder = '', bool|string $required = false, mixed $validate = null, string $hint = '')
 * @method static self select(string $label, array|Collection $options, int|string|null $default = null, int $scroll = 5, mixed $validate = null, string $hint = '', bool|string $required = true)
 * @method static self multiselect(string $label, array|Collection $options, array|Collection $default = [], int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = 'Use the space bar to select options.')
 * @method static self confirm(string $label, bool $default = true, string $yes = 'Yes', string $no = 'No', bool|string $required = false, mixed $validate = null, string $hint = '')
 * @method static self pause(string $message = 'Press enter to continue...')
 * @method static self suggest(string $label, array|Collection|Closure $options, string $placeholder = '', string $default = '', int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = '')
 * @method static self search(string $label, Closure $options, string $placeholder = '', int $scroll = 5, mixed $validate = null, string $hint = '', bool|string $required = true)
 * @method static self multisearch(string $label, Closure $options, string $placeholder = '', int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = 'Use the space bar to select options.')
 * @method static self spin(Closure $callback, string $message = '')
 * @method static self note(string $message, ?string $type = null)
 * @method static self error(string $message)
 * @method static self warning(string $message)
 * @method static self alert(string $message)
 * @method static self info(string $message)
 * @method static self intro(string $message)
 * @method static self outro(string $message)
 * @method static self table(array|Collection $headers = [], array|Collection|null $rows = null)
 * @method static self progress(string $label, iterable|int $steps, ?Closure $callback = null, string $hint = '')
 */
class Prompter
{

    protected PromptManager $promptManager;

    protected mixed $result;

    private static ?self $instance = null;

    /**
     * Prompter constructor.
     */
    private function __construct()
    {
        $this->promptManager = new PromptManager();
        $this->result = null;
    }

    /**
     * Create a new instance of Prompter.
     *
     * @return Prompter|null
     */
    public static function getInstance(): ?self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Magic method to dynamically call prompt methods.
     *
     * @param string $method The name of the method.
     * @param array $arguments The arguments to pass to the method.
     * @return self
     * @throws PrompterException
     */
    public function __call(string $method, array $arguments): self
    {
        $this->result = $this->promptManager->__call($method, $arguments);
        return $this;
    }

    /**
     * Magic static method to dynamically call prompt methods.
     *
     * @param string $method The name of the method.
     * @param array $arguments The arguments to pass to the method.
     * @return self
     *
     * @throws PrompterException If the method does not exist.
     */
    public static function __callStatic(string $method, array $arguments): self
    {
        $instance = new self();
        if (!method_exists($instance->promptManager, $method)) {
            throw PrompterException::triggerErrorMessage('method_does_not_exist', ['method' => $method, 'class' => static::class]);
        }
        $instance->result = $instance->promptManager->$method(...$arguments);
        return $instance;
    }

    /**
     * Get the result of the last prompt.
     *
     * @return mixed
     */
    public function getResult(): mixed
    {
        return $this->result;
    }

    /**
     * Get the PromptManager instance.
     *
     * @return PromptManager
     */
    public function getPrompts(): PromptManager
    {
        return $this->promptManager;
    }


    /**
     * Create a new FormBuilder instance.
     *
     * @return FormBuilder
     */
    public static function form(): FormBuilder
    {
        return (new PromptManager())->form();
    }

}
