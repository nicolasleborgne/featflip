<?php

declare(strict_types=1);

namespace App\Tests\Functional\UserManagement\Login;

use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class LoginTest extends FunctionalTestCase
{
    #[Test]
    public function itLogsIn(): void
    {
        aUser(withEmail: 'test@test.com', withPassword: 'password', withLogin: false);

        loginPage()->submit(withEmail: 'test@test.com', withPassword: 'password');

        self::assertResponseIsSuccessful();
        self::assertEquals('http://localhost/', self::$client->getHistory()->current()->getUri());
    }

    #[Test]
    public function it_deny_when_user_unknown(): void
    {
        loginPage()->submit(withEmail: 'test@test.com', withPassword: 'test');

        self::assertResponseIsSuccessful();
        self::assertEquals('http://localhost/login', self::$client->getHistory()->current()->getUri());
    }
}
