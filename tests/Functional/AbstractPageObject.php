<?php

declare(strict_types=1);

namespace App\Tests\Functional;

abstract class AbstractPageObject implements TestCaseAwareInterface
{
    protected static FunctionalTestCase $testCase;

    public static function setTestCase(FunctionalTestCase $testCase): void
    {
        self::$testCase = $testCase;
    }
}
