<?php

declare(strict_types=1);

namespace App\Tests\Assertions;

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use PHPUnit\Framework\TestCase;

abstract class Assert
{
    public static TestCase $testCase;

    public static function thatOrganization(Organization $organization): AssertOrganization
    {
        return new AssertOrganization($organization);
    }

    public static function thatProject(Project $project): AssertProject
    {
        return new AssertProject($project);
    }
}
