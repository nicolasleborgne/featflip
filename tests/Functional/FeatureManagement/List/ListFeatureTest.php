<?php

declare(strict_types=1);

namespace App\Tests\Functional\FeatureManagement\List;

use App\Domain\Feature\Feature;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class ListFeatureTest extends FunctionalTestCase
{
    #[Test]
    public function it_list_features(): void
    {
        $anOrganization = anOrganization();
        $aProject = aProject(withOrganization: $anOrganization);
        $aFeature = aFeature(withProject: $aProject);
        $anotherFeature = aFeature(withProject: $aProject);

        listFeaturePage()->visit(withOrganization: $anOrganization, withProject: $aProject);

        self::assertThatFeatureListed($aFeature);
        self::assertThatFeatureListed($anotherFeature);
    }

    public static function assertThatFeatureListed(Feature $feature): void
    {
        self::assertSelectorExists('ul li#feature_'.$feature->id());
    }
}
