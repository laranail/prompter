<?php declare(strict_types=1);

namespace Simtabi\Laranail\Prompter\Providers;

use Illuminate\Support\ServiceProvider;
use Simtabi\Laranail\Prompter\Prompter;

class PrompterServiceProvider extends ServiceProvider
{

    private string $packageName = 'prompter';

    private function getPath(string $path): string
    {
        return __DIR__ . '/../../' . $path;
    }

    private function getNamespace(): string
    {
        return $this->packageName;
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->bootPublishing();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->loadResources();

        $this->registerBindings();
    }

    private function bootPublishing(): void
    {

        $getPrefix = function ($name) {
            return $this->getNamespace() . "::" . $name;
        };

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->getPath('config/config.php') => $this->app->configPath($this->getNamespace().'.php'),
            ], $getPrefix('config'));

            $this->publishes([
                $this->getPath('resources/lang/en') => $this->app->resourcePath('lang/en'),
            ], $getPrefix('lang'));
        }

    }

    private function loadResources(): void
    {
        // Load translations, views, migrations, and config files
        $this->loadTranslationsFrom($this->getPath('resources/lang/'), $this->packageName);
        $this->loadMigrationsFrom($this->getPath('database/migrations'));
        $this->loadViewsFrom($this->getPath('resources/views'), $this->packageName);
        $this->mergeConfigFrom($this->getPath('config/config.php'), $this->packageName);
    }

    private function registerBindings(): void
    {
        $this->app->singleton(Prompter::class, function () {
            return Prompter::getInstance();
        });
    }

}
