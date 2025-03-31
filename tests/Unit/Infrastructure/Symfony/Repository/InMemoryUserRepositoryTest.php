<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Infrastructure\Symfony\Repository\InMemoryUserRepository;

final class InMemoryUserRepositoryTest extends AbstractUserRepositoryTestCase
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new InMemoryUserRepository();
    }
}
