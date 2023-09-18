<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Infrastructure\Symfony\Repository\InMemoryFeatureRepository;

final class InMemoryFeatureRepositoryTest extends AbstractFeatureRepositoryTestCaseCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new InMemoryFeatureRepository();
    }
}
