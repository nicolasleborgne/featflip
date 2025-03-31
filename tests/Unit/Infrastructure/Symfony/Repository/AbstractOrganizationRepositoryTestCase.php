<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Domain\Organization\OrganizationId;
use App\Domain\Organization\OrganizationRepositoryInterface;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

abstract class AbstractOrganizationRepositoryTestCase extends UnitTestCase
{
    protected OrganizationRepositoryInterface $repository;

    #[Test]
    public function it_add_and_get(): void
    {
        $anOrganization = anOrganization();
        $this->repository->add($anOrganization);

        self::assertEquals($anOrganization, $this->repository->get($anOrganization->id()));
    }

    #[Test]
    public function it_add_already_existing(): void
    {
        $anOrganization = anOrganization();
        $this->repository->add($anOrganization);
        $this->repository->add($anOrganization);

        self::assertCount(1, $this->repository->all());
    }

    #[Test]
    public function it_return_null_when_getting_unknown(): void
    {
        self::assertNull($this->repository->get(OrganizationId::generate()));
    }

    #[Test]
    public function it_get_all(): void
    {
        $anOrganization = anOrganization();
        $anotherOrganization = anOrganization();
        $this->repository->add($anOrganization);
        $this->repository->add($anotherOrganization);

        $actualOrganizations = $this->repository->all();
        self::assertContains($anOrganization, $actualOrganizations);
        self::assertContains($anotherOrganization, $actualOrganizations);
    }
}
