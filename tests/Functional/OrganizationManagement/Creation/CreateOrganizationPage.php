<?php

declare(strict_types=1);

namespace App\Tests\Functional\OrganizationManagement\Creation;

use App\Tests\Functional\AbstractPageObject;
use Symfony\Component\DomCrawler\Crawler;

final class CreateOrganizationPage extends AbstractPageObject
{
    private const FORM_SELECTOR = '#create_organization_request_add';
    private const ROUTE = 'app_organization_create';

    public function visit(): Crawler
    {
        return self::$testCase->get(self::ROUTE);
    }

    public function submit(string $withName): void
    {
        $crawler = $this->visit();
        $form = $crawler->filter(self::FORM_SELECTOR)->form();

        self::$testCase::$client->submit($form, [
            'create_organization_request[name]' => $withName,
        ]);
    }
}

function createOrganizationPage(): CreateOrganizationPage
{
    return new CreateOrganizationPage();
}
