<?php

declare(strict_types=1);

namespace App\Tests\PHPUnit\Extension;

use PHPUnit\Event;
use Symfony\Component\Process\PhpSubprocess;

final readonly class SetupDatabase implements Event\Application\StartedSubscriber
{
    public function __construct(
        private Mode $mode,
    ) {
    }

    public function notify(Event\Application\Started $event): void
    {
        $this->run(cmd: ['./bin/console', 'doctrine:database:drop', '--if-exists', '--force']);
        $this->run(cmd: ['./bin/console', 'doctrine:database:create', '--if-not-exists']);

        if (Mode::Migration === $this->mode) {
            $this->run(cmd: ['./bin/console', 'doctrine:migrations:migrate', '-n', '-q', '--allow-no-migration']);
        }

        if (Mode::Schema === $this->mode) {
            $this->run(cmd: ['./bin/console', 'doctrine:schema:create', '-n', '-q']);
        }
    }

    /**
     * @param array<int, string> $cmd
     */
    private function run(array $cmd): void
    {
        $process = new PhpSubprocess($cmd);
        $process->run();

        if (($errorCode = $process->getExitCode()) > 0) {
            echo 'An error occurred while performing database setup: '.PHP_EOL;
            echo $process->getErrorOutput();

            exit($errorCode);
        }
    }
}
