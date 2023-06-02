<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Infrastructure\Symfony\Repository\InMemoryProjectRepository;

final class InMemoryProjectRepositoryTest extends AbstractProjectRepositoryTestCase
{
    protected function setUp(): void
    {
        $this->repository = new InMemoryProjectRepository();
    }
}
