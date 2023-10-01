<?php

declare(strict_types=1);

namespace App\Tests\Functional\FeatureManagement\List;

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Tests\Functional\AbstractPageObject;
use Symfony\Component\DomCrawler\Crawler;

final class ListFeaturePage extends AbstractPageObject
{
    private const ROUTE = 'app_feature_list';

    public function visit(Organization $withOrganization, Project $withProject): Crawler
    {
        return self::$testCase->get(self::ROUTE, [
            'organization_slug' => $withOrganization->slug(),
            'project_slug' => $withProject->slug(),
        ]);
    }
}
