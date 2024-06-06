<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Console;

use Illuminate\Console\Command;
use Simtabi\Laranail\Prompter\Helpers\Helpers;

abstract class AbstractPrompterCommand extends Command
{

    public function __construct()
    {
        parent::__construct();
    }

    protected function sanitizeInput(?string $input, ?string $default = ''): string
    {
        return Helpers::sanitizeInput($input, $default);
    }

}
