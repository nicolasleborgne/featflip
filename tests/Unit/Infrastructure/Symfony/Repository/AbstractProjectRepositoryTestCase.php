<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Repository;

use App\Domain\Project\ProjectId;
use App\Domain\Project\ProjectRepositoryInterface;
use App\Tests\Unit\UnitTest;
use PHPUnit\Framework\Attributes\Test;

abstract class AbstractProjectRepositoryTestCase extends UnitTest
{
    protected ProjectRepositoryInterface $repository;

    #[Test]
    public function it_add_and_get(): void
    {
        $aProject = aProject();
        $this->repository->add($aProject);

        self::assertEquals($aProject, $this->repository->get($aProject->id()));
    }

    #[Test]
    public function it_add_already_existing(): void
    {
        $aProject = aProject();
        $this->repository->add($aProject);
        $this->repository->add($aProject);

        self::assertCount(1, $this->repository->all());
    }

    #[Test]
    public function it_return_null_when_getting_unknown(): void
    {
        self::assertNull($this->repository->get(ProjectId::generate()));
    }

    #[Test]
    public function it_get_all(): void
    {
        $aProject = aProject();
        $anotherProject = aProject();
        $this->repository->add($aProject);
        $this->repository->add($anotherProject);

        $actualProjects = $this->repository->all();
        self::assertContains($aProject, $actualProjects);
        self::assertContains($anotherProject, $actualProjects);
    }
}
