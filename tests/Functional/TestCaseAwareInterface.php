<?php

declare(strict_types=1);

namespace App\Tests\Functional;

interface TestCaseAwareInterface
{
    public static function setTestCase(FunctionalTestCase $testCase): void;
}
