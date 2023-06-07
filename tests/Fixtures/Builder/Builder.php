<?php

declare(strict_types=1);

namespace App\Tests\Fixtures\Builder;

use App\Tests\ContainerAwareTestCaseInterface;

abstract class Builder
{
    public static ContainerAwareTestCaseInterface $testCase;

    abstract public function build();

    protected function add(object $object, string ...$repositories)
    {
        foreach ($repositories as $repositoryFqcn) {
            $r = self::$testCase->container()->get($repositoryFqcn);
            $r->add($object);
        }
    }
}
