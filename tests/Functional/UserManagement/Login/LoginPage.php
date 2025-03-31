<?php

declare(strict_types=1);

namespace App\Tests\Functional\UserManagement\Login;

use App\Tests\Functional\AbstractPageObject;
use Symfony\Component\DomCrawler\Crawler;

final class LoginPage extends AbstractPageObject
{
    private const FORM_SELECTOR = '#login';
    private const ROUTE = 'app_login';

    public function visit(): Crawler
    {
        return self::$testCase->get(self::ROUTE);
    }

    public function submit(
        string $withEmail,
        string $withPassword,
    ): void {
        $crawler = $this->visit();
        $form = $crawler->filter(self::FORM_SELECTOR)->form();

        self::$testCase::$client->followRedirects();
        self::$testCase::$client->submit($form, [
            '_username' => $withEmail,
            '_password' => $withPassword,
        ]);
        self::$testCase::$client->followRedirects(false);
    }
}
