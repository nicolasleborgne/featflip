<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\Creation;

use App\Domain\Organization\Organization;
use App\Tests\Functional\AbstractPageObject;
use Symfony\Component\DomCrawler\Crawler;

final class CreateProjectPage extends AbstractPageObject
{
    private const FORM_SELECTOR = '#create_project_request_add';
    private const ROUTE = 'app_project_create';

    public function visit(Organization $forOrganization): Crawler
    {
        return self::$testCase->get(self::ROUTE, ['slug' => $forOrganization->slug()]);
    }

    public function submit(Organization $withOrganization, string $withName): void
    {
        $crawler = $this->visit($withOrganization);

        $form = $crawler->filter(self::FORM_SELECTOR)->form();

        self::$testCase::$client->submit($form, [
            'create_project_request[name]' => $withName,
        ]);
    }
}

function createProjectPage(): CreateProjectPage
{
    return new CreateProjectPage();
}
