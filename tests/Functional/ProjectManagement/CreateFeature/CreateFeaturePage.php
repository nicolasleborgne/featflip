<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\CreateFeature;

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Tests\Functional\AbstractPageObject;
use Symfony\Component\DomCrawler\Crawler;

final class CreateFeaturePage extends AbstractPageObject
{
    private const FORM_SELECTOR = '#create_feature_request_add';
    private const ROUTE = 'app_feature_create';

    public function visit(Organization $withOrganization, Project $withProject): Crawler
    {
        return self::$testCase->get(self::ROUTE, [
            'organization_slug' => $withOrganization->slug(),
            'project_slug' => $withProject->slug(),
        ]);
    }

    public function submit(Organization $withOrganization, Project $withProject, string $withKey): void
    {
        $crawler = $this->visit($withOrganization, $withProject);
        $form = $crawler->filter(self::FORM_SELECTOR)->form();

        self::$testCase::$client->submit($form, [
            'create_feature_request[key]' => $withKey,
        ]);
    }
}
