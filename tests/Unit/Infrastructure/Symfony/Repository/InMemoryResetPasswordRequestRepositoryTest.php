<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Infrastructure\Symfony\Repository\InMemoryResetPasswordRequestRepository;

final class InMemoryResetPasswordRequestRepositoryTest extends AbstractResetPasswordRequestRepositoryTestCase
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new InMemoryResetPasswordRequestRepository();
    }
}
