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
        aUser();
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

    #[Test]
    public function create_environment_leads_to_flag_creation(): void
    {
        aUser();
        $organization = anOrganization();
        $project = aProject(withOrganization: $organization);
        $project->addFeature('feat1');
        $project->addFeature('feat2');

        createEnvironmentPage()->submit(
            withOrganization: $organization,
            withProject: $project,
            withName: 'test'
        );

        Assert::thatProject($project)
            ->hasFlag(withFeature: 'feat1', withEnvironment: 'test', withValue: false)
            ->hasFlag(withFeature: 'feat2', withEnvironment: 'test', withValue: false)
        ;
    }
}
