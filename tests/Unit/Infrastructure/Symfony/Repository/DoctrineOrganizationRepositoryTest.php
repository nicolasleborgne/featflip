<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Infrastructure\Symfony\Repository\DoctrineOrganizationRepository;

final class DoctrineOrganizationRepositoryTest extends AbstractOrganizationRepositoryTestCaseCase
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = self::getContainer()->get(DoctrineOrganizationRepository::class);
    }
}
