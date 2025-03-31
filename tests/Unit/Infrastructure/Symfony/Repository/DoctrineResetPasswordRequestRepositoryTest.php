<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Infrastructure\Symfony\Repository\DoctrineResetPasswordRequestRepository;

final class DoctrineResetPasswordRequestRepositoryTest extends AbstractResetPasswordRequestRepositoryTestCase
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = self::getContainer()->get(DoctrineResetPasswordRequestRepository::class);
    }
}
