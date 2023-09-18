<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Infrastructure\Symfony\Repository\DoctrineFeatureRepository;

final class DoctrineFeatureRepositoryTest extends AbstractFeatureRepositoryTestCaseCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = self::getContainer()->get(DoctrineFeatureRepository::class);
    }
}
