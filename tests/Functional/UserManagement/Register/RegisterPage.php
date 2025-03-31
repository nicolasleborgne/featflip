<?php

declare(strict_types=1);

namespace App\Tests\Functional\UserManagement\Register;

use App\Tests\Functional\AbstractPageObject;
use Symfony\Component\DomCrawler\Crawler;

final class RegisterPage extends AbstractPageObject
{
    private const FORM_SELECTOR = '#register';
    private const ROUTE = 'app_register';

    public function visit(): Crawler
    {
        return self::$testCase->get(self::ROUTE);
    }

    public function submit(
        string $withEmail,
        string $withPassword,
        string $withConfirmationPassword,
        bool $withAgreeTerms,
    ): void {
        $crawler = $this->visit();
        $form = $crawler->filter(self::FORM_SELECTOR)->form();

        self::$testCase::$client->submit($form, [
            'registration_form[email]' => $withEmail,
            'registration_form[plainPassword][first]' => $withPassword,
            'registration_form[plainPassword][second]' => $withConfirmationPassword,
            'registration_form[agreeTerms]' => $withAgreeTerms,
        ]);
    }
}
