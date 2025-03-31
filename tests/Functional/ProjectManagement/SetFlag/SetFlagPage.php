<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\SetFlag;

use App\Domain\Organization\Organization;
use App\Domain\Project\Environment;
use App\Domain\Project\Feature;
use App\Domain\Project\Project;
use App\Tests\Functional\AbstractPageObject;
use Symfony\Component\DomCrawler\Crawler;

final class SetFlagPage extends AbstractPageObject
{
    private const FORM_SELECTOR = '#set_flag_request_add';
    private const ROUTE = 'app_project_set_flag';

    public function visit(Organization $forOrganization, Project $withProject): Crawler
    {
        return self::$testCase->get(self::ROUTE, [
            'organization_slug' => $forOrganization->slug(),
            'project_slug' => $withProject->slug(),
        ]);
    }

    public function submit(
        Organization $withOrganization,
        Project $withProject,
        Feature $withFeature,
        Environment $withEnvironment,
        bool $withValue,
    ): void {
        $crawler = $this->visit(
            $withOrganization,
            $withProject
        );
        file_put_contents('test.html', self::$testCase::$client->getResponse()->getContent());
        $form = $crawler->filter(self::FORM_SELECTOR)->form();

        self::$testCase::$client->submit($form, [
            'set_flag_request[project_id]' => $withProject->id(),
            'set_flag_request[feature_id]' => $withFeature->id(),
            'set_flag_request[environment_id]' => $withEnvironment->id(),
            'set_flag_request[value]' => $withValue,
        ]);
    }
}
