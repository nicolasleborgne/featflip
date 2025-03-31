<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Domain\Clock;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;
use SymfonyCasts\Bundle\ResetPassword\Persistence\ResetPasswordRequestRepositoryInterface;

abstract class AbstractResetPasswordRequestRepositoryTestCase extends UnitTestCase
{
    protected ResetPasswordRequestRepositoryInterface $repository;

    #[Test]
    public function it_get_user_identifier(): void
    {
        $user = aUser(withLogin: false);

        $id = $this->repository->getUserIdentifier($user);

        self::assertEquals($id, $user->id());
    }

    #[Test]
    public function it_add_and_find_reset_password_request(): void
    {
        $user = aUser(withLogin: false);
        $request = $this->repository->createResetPasswordRequest($user, Clock::now('+1 month'), 'selector', 'token');
        $this->repository->persistResetPasswordRequest($request);

        $result = $this->repository->findResetPasswordRequest('selector');

        self::assertNotNull($result);
    }

    #[Test]
    public function it_get_most_recent_non_expired_request_date(): void
    {
        $user = aUser(withLogin: false);
        Clock::setNow(new \DateTimeImmutable('+2 day'));
        $expected = Clock::now();
        $this->repository->persistResetPasswordRequest($request = $this->repository->createResetPasswordRequest(
            $user,
            Clock::now('+1 month'),
            'selector',
            'token'
        ));
        Clock::setNow(new \DateTimeImmutable('+1 day'));
        $this->repository->persistResetPasswordRequest($this->repository->createResetPasswordRequest(
            $user,
            Clock::now('+1 month'),
            'selector',
            'token'
        ));

        $mostRecent = $this->repository->getMostRecentNonExpiredRequestDate($user);

        self::assertEquals($expected, $mostRecent);
    }

    #[Test]
    public function it_do_not_get_most_recent_non_expired_request_date_when_expired(): void
    {
        $user = aUser(withLogin: false);
        Clock::setNow(new \DateTimeImmutable('+2 day'));
        $this->repository->persistResetPasswordRequest($request = $this->repository->createResetPasswordRequest(
            $user,
            Clock::now('-1 month'),
            'selector',
            'token'
        ));
        Clock::setNow(new \DateTimeImmutable('+1 day'));
        $this->repository->persistResetPasswordRequest($this->repository->createResetPasswordRequest(
            $user,
            Clock::now('+1 month'),
            'selector',
            'token'
        ));

        $mostRecent = $this->repository->getMostRecentNonExpiredRequestDate($user);

        self::assertNull($mostRecent);
    }

    #[Test]
    public function it_remove_reset_password_request(): void
    {
        $user = aUser(withLogin: false);
        $request = $this->repository->createResetPasswordRequest($user, Clock::now('+1 month'), 'selector', 'token');
        $this->repository->persistResetPasswordRequest($request);

        $this->repository->removeResetPasswordRequest($request);
        $result = $this->repository->findResetPasswordRequest('selector');

        self::assertNull($result);
    }

    #[Test]
    public function it_remove_expired_reset_password_request(): void
    {
        $user = aUser(withLogin: false);
        Clock::setNow(new \DateTimeImmutable('+2 day'));
        $this->repository->persistResetPasswordRequest($request = $this->repository->createResetPasswordRequest(
            $user,
            Clock::now('-1 month'),
            'selector',
            'token'
        ));

        $removedCount = $this->repository->removeExpiredResetPasswordRequests();

        self::assertEquals(1, $removedCount);
    }
}
