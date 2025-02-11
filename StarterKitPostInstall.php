<?php

use Facades\Statamic\Console\Processes\Composer;
use Illuminate\Support\Facades\Storage;
use Laravel\Prompts\Prompt;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use function Laravel\Prompts\error;
use function Laravel\Prompts\info;
use function Laravel\Prompts\spin;

class StarterKitPostInstall
{
    protected string $env = '';

    protected string $readme = '';

    protected string $app = '';

    protected string $sites = '';

    protected bool $interactive = true;

    public function handle($console): void
    {
        $this->applyInteractivity($console);
        $this->loadFiles();
        $this->installNodeDependencies();
        $this->writeFiles();
        $this->cleanUp();
        $this->finish();
    }

    protected function applyInteractivity($console): void
    {
        $this->interactive = ! $console->option('no-interaction');

        /**
         * Interactivity should be inherited but seems like there is a bug in Prompts where it stays
         * without interaction when a command was run before with `--no-interaction` flag.
         */
        Prompt::interactive($this->interactive);
    }

    protected function loadFiles(): void
    {
        $this->env = app('files')->get(base_path('.env.example'));
        $this->readme = app('files')->get(base_path('README.md'));
        $this->app = app('files')->get(base_path('config/app.php'));
        $this->sites = app('files')->get(base_path('resources/sites.yaml'));
    }

    protected function installNodeDependencies(): void
    {
        $this->run(
            command: 'npm i',
            processingMessage: 'Installing npm dependencies...',
            successMessage: 'npm dependencies installed.',
        );
    }

    protected function writeFiles(): void
    {
        app('files')->put(base_path('.env'), $this->env);
        app('files')->put(base_path('README.md'), $this->readme);
        app('files')->put(base_path('config/app.php'), $this->app);
        app('files')->put(base_path('resources/sites.yaml'), $this->sites);
    }

    protected function cleanUp(): void
    {
        app('files')->exists(base_path('tailwind.config.js')) && app('files')->delete(base_path('tailwind.config.js'));
        app('files')->exists(base_path('postcss.config.js')) && app('files')->delete(base_path('postcss.config.js'));

        $this->withSpinner(
            fn() => $this->cleanUpComposerPackages(),
            'Cleaning up composer packages...',
            'Composer packages cleaned up.'
        );

        $this->withSpinner(
            fn() => $this->removePostInstallCommands(),
            'Removing post install commands...',
            'Post install commands removed.'
        );
    }

    protected function finish(): void
    {
        info('[✓] Statamic Starter is installed. Enjoy!');
    }

    protected function run(string $command, string $processingMessage = '', string $successMessage = '', ?string $errorMessage = null, bool $tty = false, bool $spinner = true, int $timeout = 120): bool
    {
        $process = new Process(explode(' ', $command));
        $process->setTimeout($timeout);

        if ($tty) {
            $process->setTty(true);
        }

        try {
            $spinner ?
                $this->withSpinner(
                    fn() => $process->mustRun(),
                    $processingMessage,
                    $successMessage
                ) :
                $this->withoutSpinner(
                    fn() => $process->mustRun(),
                    $successMessage
                );

            return true;
        } catch (ProcessFailedException $exception) {
            error($errorMessage ?? $exception->getMessage());

            return false;
        }
    }

    protected function replaceInSites(string $search, string $replace): void
    {
        $this->sites = str_replace($search, $replace, $this->sites);
    }

    protected function replaceInEnv(string $search, string $replace): void
    {
        $this->env = str_replace($search, $replace, $this->env);
    }

    protected function appendToGitignore(string $toIgnore): void
    {
        app('files')->append(base_path('.gitignore'), "\n{$toIgnore}");
    }

    protected function withSpinner(callable $callback, string $processingMessage = '', string $successMessage = ''): void
    {
        spin($callback, $processingMessage);

        if ($successMessage) {
            info("[✓] $successMessage");
        }
    }

    protected function cleanUpComposerPackages(): void
    {
        if ($packages = []) {
            Composer::removeMultiple($packages);
        }
    }

    protected function removePostInstallCommands(): void
    {
        Storage::build([
            'driver' => 'local',
            'root' => app_path(),
        ])->deleteDirectory('Console/Commands/PostInstall');

        usleep(500000);
    }

    protected function withoutSpinner(callable $callback, string $successMessage = ''): void
    {
        $callback();

        if ($successMessage) {
            info("[✓] $successMessage");
        }
    }
}
