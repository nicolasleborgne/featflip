<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\CreateProject;

use App\Domain\Project\ProjectRepositoryInterface;
use App\Tests\Assertions\Assert;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class CreateProjectTest extends FunctionalTestCase
{
    private ProjectRepositoryInterface $repository;

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = static::getContainer()->get(ProjectRepositoryInterface::class);
    }

    #[Test]
    public function it_create_a_project(): void
    {
        aUser();
        $organization = anOrganization();

        createProjectPage()->submit(withOrganization: $organization, withName: 'Featswitches');

        $project = $this->repository->all()[0];
        Assert::thatProject($project)
            ->hasName('Featswitches')
            ->hasSlug('featswitches')
            ->hasOrganization($organization)
        ;
    }
}
