<?php

declare(strict_types=1);

namespace App\Tests\Functional\UserManagement\Register;

use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Symfony\Entity\User;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\MailerAssertionsTrait;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;

final class RegisterPageTest extends FunctionalTestCase
{
    use MailerAssertionsTrait;

    #[Test]
    public function it_register_user(): void
    {
        registerUserPage()->submit(
            withEmail: 'test@test.com',
            withPassword: 'password',
            withConfirmationPassword: 'password',
            withAgreeTerms: true,
        );

        $user = self::container()->get(UserRepositoryInterface::class)->fromEmail('test@test.com');
        self::assertNotNull($user, 'Failed asserting that user does exist');
    }

    #[Test]
    public function it_show_error_when_already_existing_user(): void
    {
        aUser(withEmail: 'test@test.com', withLogin: false);

        self::$client->followRedirects(false);
        registerUserPage()->submit(
            withEmail: 'test@test.com',
            withPassword: 'password',
            withConfirmationPassword: 'password',
            withAgreeTerms: true,
        );

        self::assertSelectorTextContains(
            'li',
            'User with email test@test.com already exists.',
            'Failed asserting that already existing user error is shown.'
        );
    }

    #[Test]
    public function it_show_error_when_password_mismatch(): void
    {
        self::$client->followRedirects(false);
        registerUserPage()->submit(
            withEmail: 'test@test.com',
            withPassword: 'password',
            withConfirmationPassword: 'another-password',
            withAgreeTerms: true,
        );

        self::assertSelectorTextContains(
            'li',
            'The password fields must match.',
            'Failed asserting that password mismatch error is shown.'
        );
    }

    #[Test]
    public function it_show_error_when_terms_not_agreed(): void
    {
        self::$client->followRedirects(false);
        registerUserPage()->submit(
            withEmail: 'test@test.com',
            withPassword: 'password',
            withConfirmationPassword: 'password',
            withAgreeTerms: false,
        );

        self::assertSelectorTextContains(
            'li',
            'You should agree to our terms.',
            'Failed asserting that terms not agreed error is shown.'
        );
    }

    #[Test]
    public function it_show_error_when_invalid_email(): void
    {
        self::$client->followRedirects(false);
        registerUserPage()->submit(
            withEmail: 'test.com',
            withPassword: 'password',
            withConfirmationPassword: 'password',
            withAgreeTerms: true,
        );

        self::assertSelectorTextContains(
            'li',
            'This value is not a valid email address.',
            'Failed asserting that invalid email error is shown.'
        );
    }

    #[Test]
    public function on_registration_it_send_confirmation_email(): void
    {
        self::$client->followRedirects(false);
        registerUserPage()->submit(
            withEmail: 'test2@test.com',
            withPassword: 'password',
            withConfirmationPassword: 'password',
            withAgreeTerms: true,
        );
        self::$client->followRedirects(true);

        self::assertEmailCount(1);
    }

    #[Test]
    public function user_that_click_on_confirmation_link_is_verified(): void
    {
        self::$client->followRedirects(false);
        registerUserPage()->submit(
            withEmail: 'test@test.com',
            withPassword: 'password',
            withConfirmationPassword: 'password',
            withAgreeTerms: true,
        );
        self::$client->followRedirects(true);

        self:self::clickOnReceivedVerificationLink();

        /** @var User $user */
        $user = self::container()->get(UserRepositoryInterface::class)->fromEmail('test@test.com');
        self::assertTrue($user->isVerified(), 'Failed asserting user is verified.');
    }

    public static function clickOnReceivedVerificationLink(): void
    {
        $message = self::getMailerMessage();
        assert($message instanceof Email);
        $crawler = new Crawler($message->getHtmlBody());
        $uri = $crawler->filter('a')->link()->getUri();
        self::$client->request(Request::METHOD_GET, $uri);
    }
}
