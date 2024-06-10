<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Support;

use BadMethodCallException;
use Laravel\Prompts\Note;
use Simtabi\Laranail\Prompter\Enums\ContextType;
use Simtabi\Laranail\Prompter\Exceptions\PrompterException;

/**
 * Class ContextBuilder
 *
 * This class manages context-related methods.
 */
class ContextBuilder
{
    /**
     * @var array<string, callable>
     */
    private array $contexts;

    /**
     * Constructor to initialize context methods.
     */
    public function __construct()
    {
        $this->contexts = array_reduce(
            ContextType::cases(),
            function ($carry, ContextType $type) {
                $carry[$type->value] = function (string $message) use ($type): void {
                    (new Note($message, $type->value))->display();
                };
                return $carry;
            },
            []
        );
    }

    /**
     * Magic method to dynamically call context methods.
     *
     * @param string $method The name of the method.
     * @param array $arguments The arguments to pass to the method.
     * @return mixed The result of the method call.
     *
     * @throws PrompterException If the context method does not exist.
     */
    public function __call(string $method, array $arguments): mixed
    {
        if (isset($this->contexts[$method])) {
            return $this->contexts[$method](...$arguments);
        }

        throw PrompterException::badMethodCall([
            'method'  => $method,
            'methods' => rtrim(implode(', ', array_keys($this->contexts)), ', '),
        ]);
    }
}
