<?php

declare(strict_types=1);

namespace App\Tests\Functional\UserManagement\Logout;

use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class LogoutRouteTest extends FunctionalTestCase
{
    #[Test]
    public function it_logout_user(): void
    {
        aUser(withLogin: true);

        self::$client->followRedirects(true);
        $this->get('app_logout');
        self::$client->followRedirects(false);

        self::assertEquals('http://localhost/login', self::$client->getHistory()->current()->getUri());
    }
}
