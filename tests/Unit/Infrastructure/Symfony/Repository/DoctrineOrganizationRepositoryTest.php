<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Infrastructure\Symfony\Repository\DoctrineOrganizationRepository;

final class DoctrineOrganizationRepositoryTest extends AbstractOrganizationRepositoryTestCase
{
    protected function setUp(): void
    {
        $this->repository = self::getContainer()->get(DoctrineOrganizationRepository::class);
    }
}
