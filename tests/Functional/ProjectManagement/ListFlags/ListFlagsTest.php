<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\ListFlags;

use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class ListFlagsTest extends FunctionalTestCase
{
    #[Test]
    public function it_list_features(): void
    {
        aUser();
        $anOrganization = anOrganization();
        $aProject = projectBuilder()
            ->withOrganizationId($anOrganization->id())
            ->withFeatures('a_feature', 'another_feature')
            ->withEnvironment('test')
            ->build();

        listFlagsPage()->visit(
            withOrganization: $anOrganization,
            withProject: $aProject,
            withEnvironment: 'test'
        );

        self::debugHtml();

        self::assertThatFlagsListed('a_feature', 'another_feature');
    }

    public static function assertThatFlagsListed(string ...$featureKey): void
    {
        foreach ($featureKey as $key) {
            self::assertSelectorExists('ul li#feature_'.$key);
        }
    }
}
