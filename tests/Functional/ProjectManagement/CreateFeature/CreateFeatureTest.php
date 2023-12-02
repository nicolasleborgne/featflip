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
        $organization = anOrganization();
        $project = aProject(withOrganization: $organization);

        createFeaturePage()->submit(withOrganization: $organization, withProject: $project, withKey: 'turn_on_feature');

        Assert::thatProject($project)
            ->hasFeature(withKey: 'turn_on_feature')
        ;
    }
}
