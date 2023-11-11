<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\CreateEnvironment;

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Tests\Functional\AbstractPageObject;
use Symfony\Component\DomCrawler\Crawler;

final class CreateEnvironmentPage extends AbstractPageObject
{
    private const ROUTE = 'app_project_environment_create';
    private const FORM_SELECTOR = '#create_project_environment_request_add';

    private function visit(Organization $withOrganization, Project $withProject): Crawler
    {
        return self::$testCase->get(self::ROUTE, [
            'organization_slug' => $withOrganization->slug(),
            'project_slug' => $withProject->slug(),
        ]);
    }

    public function submit(Organization $withOrganization, Project $withProject, string $withName): void
    {
        $crawler = $this->visit($withOrganization, $withProject);
        $form = $crawler->filter(self::FORM_SELECTOR)->form();

        self::$testCase::$client->submit($form, [
            'create_project_environment_request[name]' => $withName,
        ]);
    }
}
