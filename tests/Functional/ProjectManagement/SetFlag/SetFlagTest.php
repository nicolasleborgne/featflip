<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\SetFlag;

use App\Tests\Assertions\Assert;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class SetFlagTest extends FunctionalTestCase
{
    #[Test]
    public function it_set_flag_value(): void
    {
        $anOrganization = anOrganization();
        $aProject = aProject(
            withOrganization: $anOrganization,
            withEnvironment: 'test',
            withFeature: 'track_parcel',
        );

        setFlagPage()->submit(
            withOrganization: $anOrganization,
            withProject: $aProject,
            withFeature: $aProject->features()->first(),
            withEnvironment: $aProject->environments()->first(),
            withValue: true,
        );

        Assert::thatProject($aProject)
            ->hasFlag(
                withFeature: 'track_parcel',
                withEnvironment: 'test',
                withValue: true
            )
        ;
    }

    #[Test]
    public function flag_is_false_when_unset(): void
    {
        $anOrganization = anOrganization();
        $aProject = aProject(
            withOrganization: $anOrganization,
            withEnvironment: 'test',
            withFeature: 'track_parcel',
        );

        Assert::thatProject($aProject)
            ->hasFlag(
                withFeature: 'track_parcel',
                withEnvironment: 'test',
                withValue: false
            )
        ;
    }

    #[Test]
    public function unset_an_already_set_flag(): void
    {
        $anOrganization = anOrganization();
        $aProject = aProject(
            withOrganization: $anOrganization,
            withEnvironment: 'test',
            withFeature: 'track_parcel',
        );

        setFlagPage()->submit(
            withOrganization: $anOrganization,
            withProject: $aProject,
            withFeature: $aProject->features()->first(),
            withEnvironment: $aProject->environments()->first(),
            withValue: true,
        );

        setFlagPage()->submit(
            withOrganization: $anOrganization,
            withProject: $aProject,
            withFeature: $aProject->features()->first(),
            withEnvironment: $aProject->environments()->first(),
            withValue: false,
        );

        Assert::thatProject($aProject)
            ->hasFlag(
                withFeature: 'track_parcel',
                withEnvironment: 'test',
                withValue: false
            )
        ;
    }
}
