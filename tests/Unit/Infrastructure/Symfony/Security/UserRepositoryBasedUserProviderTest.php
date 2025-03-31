<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Security;

use App\Infrastructure\Symfony\Security\UserRepositoryBasedUserProvider;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

final class UserRepositoryBasedUserProviderTest extends UnitTestCase
{
    #[Test]
    public function it_throws_when_upgrading_password_on_non_user(): void
    {
        /** @var UserRepositoryBasedUserProvider $provider */
        $provider = self::container()->get(UserRepositoryBasedUserProvider::class);

        $notUser = $this->createMock(PasswordAuthenticatedUserInterface::class);

        self::expectException(\Exception::class);
        $provider->upgradePassword($notUser, 'password');
    }

    #[Test]
    public function it_upgrade_password(): void
    {
        $aUser = aUser(withPassword: 'old-password', withLogin: false);

        /** @var UserRepositoryBasedUserProvider $provider */
        $provider = self::container()->get(UserRepositoryBasedUserProvider::class);
        $provider->upgradePassword($aUser, 'new-password');

        self::assertEquals($aUser->getPassword(), 'new-password');
    }
}
