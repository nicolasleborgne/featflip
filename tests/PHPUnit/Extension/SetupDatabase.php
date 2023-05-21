<?php

declare(strict_types=1);

namespace App\Tests\PHPUnit\Extension;

use PHPUnit\Event;
use Symfony\Component\Process\Process;

final class SetupDatabase implements Event\Application\StartedSubscriber
{
    public function __construct(
        private readonly Mode $mode,
    ) {
    }

    public function notify(Event\Application\Started $event): void
    {
        $process = new Process(['./bin/console', 'doctrine:database:drop', '--if-exists']);
        $process->run();

        $process = new Process(['./bin/console', 'doctrine:database:create', '--if-not-exists']);
        $process->run();

        if (Mode::Migration === $this->mode) {
            $process = new Process(['./bin/console', 'doctrine:migrations:migrate', '-n', '-q', '--allow-no-migration']);
            $process->run();
        }

        if (Mode::Schema === $this->mode) {
            $process = new Process(['./bin/console', 'doctrine:schema:create', '-n', '-q']);
            $process->run();
        }
    }
}
