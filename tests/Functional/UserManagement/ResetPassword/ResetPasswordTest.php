<?php

declare(strict_types=1);

namespace App\Tests\Functional\UserManagement\ResetPassword;

use App\Domain\User\UserId;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;

final class ResetPasswordTest extends FunctionalTestCase
{
    #[Test]
    public function it_send_reset_password_email(): void
    {
        $user = aUser(withLogin: true);

        self::$client->followRedirects(false);
        requestResetPasswordPage()->submit(withEmail: $user->email());
        self::$client->followRedirects(true);

        self::assertEmailCount(1);
    }

    #[Test]
    public function it_redirect_to_check_email_page_even_when_user_does_not_exist(): void
    {
        requestResetPasswordPage()->submit(withEmail: 'not-existing-user@test.com');

        self::assertEquals('http://localhost/reset-password/check-email', self::$client->getHistory()->current()->getUri());
    }

    #[Test]
    public function it_redirect_to_password_reset_when_token_invalid(): void
    {
        self::get('app_reset_password', ['token' => 'invalid']);

        self::assertEquals('http://localhost/reset-password', self::$client->getHistory()->current()->getUri());
    }

    #[Test]
    public function it_404_when_token_invalid(): void
    {
        self::$client->followRedirects(false);
        self::get('app_reset_password', ['token' => null]);
        self::$client->followRedirects(true);

        self::assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }

    #[Test]
    public function it_reset_password(): void
    {
        $user = aUser(withLogin: true);

        self::$client->followRedirects(false);
        requestResetPasswordPage()->submit(withEmail: $user->email());
        self::$client->followRedirects(true);

        self::clickOnReceivedResetLink();

        $form = self::$client->getCrawler()->filter('#reset')->form();

        self::$client->submit($form, [
            'change_password_form[plainPassword][first]' => 'new-password',
            'change_password_form[plainPassword][second]' => 'new-password',
        ]);

        self::assertEquals('http://localhost/', self::$client->getHistory()->current()->getUri());
    }

    #[Test]
    public function it_does_not_reset_password_when_confirmation_does_not_match(): void
    {
        $user = aUser(withLogin: false);

        self::$client->followRedirects(false);
        requestResetPasswordPage()->submit(withEmail: $user->email());
        self::$client->followRedirects(true);

        self::clickOnReceivedResetLink();

        $form = self::$client->getCrawler()->filter('#reset')->form();

        self::$client->submit($form, [
            'change_password_form[plainPassword][first]' => 'new-password',
            'change_password_form[plainPassword][second]' => 'not-same-password',
        ]);

        self::assertSelectorTextContains(
            'li',
            'The password fields must match.',
            'Failed asserting that mismatch password error is shown.'
        );
    }

    public static function clickOnReceivedResetLink(): void
    {
        $message = self::getMailerMessage();
        assert($message instanceof Email);
        $crawler = new Crawler($message->getHtmlBody());
        $uri = $crawler->filter('a')->link()->getUri();
        self::$client->request(Request::METHOD_GET, $uri);
    }

    #[Test]
    public function it_redirect_to_register_when_no_id(): void
    {
        self::$client->followRedirects(false);
        self::get('app_verify_email');
        self::$client->followRedirects(true);

        self::assertResponseRedirects('/register');
    }

    #[Test]
    public function it_redirect_to_register_when_no_user(): void
    {
        self::$client->followRedirects(false);
        self::get('app_verify_email', [], ['id' => (string) UserId::generate()]);
        self::$client->followRedirects(true);

        self::assertResponseRedirects('/register');
    }

    #[Test]
    public function it_redirect_to_register_when_email_verification_fail(): void
    {
        $aUser = aUser(withLogin: false);

        self::$client->followRedirects(false);
        self::get('app_verify_email', [], ['id' => $aUser->id(), 'token' => 'invalid']);
        self::$client->followRedirects(true);

        self::assertResponseRedirects('/register');
    }
}
