<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Infrastructure\Symfony\Repository\InMemoryOrganizationRepository;

final class InMemoryOrganizationRepositoryTest extends AbstractOrganizationRepositoryTestCase
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new InMemoryOrganizationRepository();
    }
}
