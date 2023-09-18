<?php

declare(strict_types=1);

namespace App\Tests\Functional\FeatureManagement\Creation;

use App\Domain\Feature\FeatureRepositoryInterface;
use App\Tests\Assertions\Assert;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class CreateFeatureTest extends FunctionalTestCase
{
    private FeatureRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = static::getContainer()->get(FeatureRepositoryInterface::class);
    }

    #[Test]
    public function it_create_feature()
    {
        $organization = anOrganization();
        $project = aProject(withOrganization: $organization);

        createFeaturePage()->submit(withOrganization: $organization, withProject: $project, withKey: 'turn_on_feature');

        $feature = $this->repository->all()[0];
        Assert::thatFeature($feature)
            ->hasKey('turn_on_feature')
            ->hasProject($project);
    }
}
