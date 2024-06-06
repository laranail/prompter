<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter;

use Simtabi\Laranail\Prompter\Prompter;

if (! function_exists('prompter')) {
    /**
     * Get the prompter instance.
     * @return Prompter
     */
    function prompter(): Prompter
    {
        return Prompter::getInstance();
    }
}


