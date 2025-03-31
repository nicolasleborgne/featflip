<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\CreateFeature;

use App\Tests\Assertions\Assert;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class CreateFeatureTest extends FunctionalTestCase
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
    }

    #[Test]
    public function it_create_feature(): void
    {
        aUser();
        $organization = anOrganization();
        $project = aProject(withOrganization: $organization);

        createFeaturePage()->submit(withOrganization: $organization, withProject: $project, withKey: 'turn_on_feature');

        Assert::thatProject($project)
            ->hasFeature(withKey: 'turn_on_feature')
        ;
    }

    #[Test]
    public function create_feature_leads_to_flag_creation(): void
    {
        aUser();
        $organization = anOrganization();
        $project = aProject(withOrganization: $organization);
        $project->addEnvironment('test');
        $project->addEnvironment('staging');

        createFeaturePage()->submit(withOrganization: $organization, withProject: $project, withKey: 'turn_on_feature');

        Assert::thatProject($project)
            ->hasFlag(withFeature: $project->features()->first()->key(), withEnvironment: 'test', withValue: false)
            ->hasFlag(withFeature: $project->features()->first()->key(), withEnvironment: 'staging', withValue: false)
        ;
    }
}
