<?php

declare(strict_types=1);

namespace App\Tests\Assertions;

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use PHPUnit\Framework\TestCase;

abstract class Assert
{
    public static TestCase $testCase;

    public static function that(object $object): Assert
    {
        if ($object instanceof Project) {
            return new AssertProject($object);
        }

        if ($object instanceof Organization) {
            return new AssertOrganization($object);
        }

        throw new \Exception('Should not be reached.');
    }
}
