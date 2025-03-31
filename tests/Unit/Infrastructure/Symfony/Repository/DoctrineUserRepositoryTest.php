<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Infrastructure\Symfony\Repository\DoctrineUserRepository;

final class DoctrineUserRepositoryTest extends AbstractUserRepositoryTestCase
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = self::getContainer()->get(DoctrineUserRepository::class);
    }
}
