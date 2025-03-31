<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Domain\User\UserId;
use App\Domain\User\UserRepositoryInterface;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

abstract class AbstractUserRepositoryTestCase extends UnitTestCase
{
    protected UserRepositoryInterface $repository;

    #[Test]
    public function it_add_and_get(): void
    {
        $aUser = aUser(withLogin: false);
        $this->repository->add($aUser);

        self::assertEquals($aUser, $this->repository->get($aUser->id()));
    }

    #[Test]
    public function it_add_and_get_from_email(): void
    {
        $aUser = aUser(withLogin: false, withEmail: 'test@test.com');
        $this->repository->add($aUser);

        self::assertEquals($aUser, $this->repository->fromEmail($aUser->email()));
    }

    #[Test]
    public function it_add_already_existing(): void
    {
        $aUser = aUser(withLogin: false);
        $this->repository->add($aUser);
        $this->repository->add($aUser);

        self::assertCount(1, $this->repository->all());
    }

    #[Test]
    public function it_return_null_when_getting_unknown(): void
    {
        self::assertNull($this->repository->get(UserId::generate()));
    }

    #[Test]
    public function it_get_all(): void
    {
        $aUser = aUser(withLogin: false);
        $anotherUser = aUser(withLogin: false);
        $this->repository->add($aUser);
        $this->repository->add($anotherUser);

        $actualUsers = $this->repository->all();
        self::assertContains($aUser, $actualUsers);
        self::assertContains($anotherUser, $actualUsers);
    }
}
