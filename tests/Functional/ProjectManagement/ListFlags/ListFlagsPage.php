<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\ListFlags;

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Tests\Functional\AbstractPageObject;
use Symfony\Component\DomCrawler\Crawler;

final class ListFlagsPage extends AbstractPageObject
{
    private const ROUTE = 'app_flags_list';

    public function visit(
        Organization $withOrganization,
        Project $withProject,
        string $withEnvironment,
    ): Crawler {
        return self::$testCase->get(self::ROUTE, [
            'organization_slug' => $withOrganization->slug(),
            'project_slug' => $withProject->slug(),
            'environment_slug' => $withEnvironment,
        ]);
    }
}
