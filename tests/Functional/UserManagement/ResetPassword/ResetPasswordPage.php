<?php

declare(strict_types=1);

namespace App\Tests\Functional\UserManagement\ResetPassword;

use App\Tests\Functional\AbstractPageObject;
use Symfony\Component\DomCrawler\Crawler;

final class ResetPasswordPage extends AbstractPageObject
{
    private const FORM_SELECTOR = '#reset';
    private const ROUTE = 'app_forgot_password_request';

    public function visit(): Crawler
    {
        return self::$testCase->get(self::ROUTE);
    }

    public function submit(string $withPassword, string $withConfirmation): void
    {
        $crawler = $this->visit();
        $form = $crawler->filter(self::FORM_SELECTOR)->form();

        self::$testCase::$client->submit($form, [
            'change_password_form[plainPassword][first]' => $withPassword,
            'change_password_form[plainPassword][second]' => $withConfirmation,
        ]);
    }
}
