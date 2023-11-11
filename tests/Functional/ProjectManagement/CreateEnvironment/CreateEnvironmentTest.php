<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\CreateEnvironment;

use App\Tests\Assertions\Assert;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class CreateEnvironmentTest extends FunctionalTestCase
{
    #[Test]
    public function it_create_environment(): void
    {
        $anOrganization = anOrganization();
        $aProject = aProject(withOrganization: $anOrganization);

        createEnvironmentPage()->submit(
            withOrganization: $anOrganization,
            withProject: $aProject,
            withName: 'test'
        );

        Assert::thatProject($aProject)
            ->hasEnvironment('test')
        ;
    }
}
