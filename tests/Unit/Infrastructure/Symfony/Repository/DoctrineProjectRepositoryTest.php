<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Infrastructure\Symfony\Repository\DoctrineProjectRepository;

final class DoctrineProjectRepositoryTest extends AbstractProjectRepositoryTestCase
{
    protected function setUp(): void
    {
        $this->repository = self::getContainer()->get(DoctrineProjectRepository::class);
    }
}