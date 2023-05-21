<?php

declare(strict_types=1);

namespace App\Tests\PHPUnit\Extension;

use PHPUnit\Runner;
use PHPUnit\Runner\Extension\Facade;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\TextUI\Configuration\Configuration;

final class Extension implements Runner\Extension\Extension
{
    public function bootstrap(Configuration $configuration, Facade $facade, ParameterCollection $parameters): void
    {
        $mode = Mode::Migration;
        if ($parameters->has('mode')) {
            $mode = Mode::from($parameters->get('mode'));
        }

        $facade->registerSubscribers(
            new SetupDatabase($mode),
        );
    }
}
