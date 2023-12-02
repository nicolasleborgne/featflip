<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\ListFeature;

use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class ListFeatureTest extends FunctionalTestCase
{
    #[Test]
    public function it_list_features(): void
    {
        $anOrganization = anOrganization();
        $aProject = projectBuilder()
            ->withOrganizationId($anOrganization->id())
            ->withFeatures('a_feature', 'another_feature')
            ->build();

        listFeaturePage()->visit(withOrganization: $anOrganization, withProject: $aProject);

        self::assertThatFeaturesListed('a_feature', 'another_feature');
    }

    public static function assertThatFeaturesListed(string ...$featureKey): void
    {
        foreach ($featureKey as $key) {
            self::assertSelectorExists('ul li#feature_'.$key);
        }
    }
}
