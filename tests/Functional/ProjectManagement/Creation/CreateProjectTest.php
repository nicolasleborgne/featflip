<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\Creation;

use App\Domain\Project\ProjectRepositoryInterface;
use App\Tests\Assertions\Assert;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class CreateProjectTest extends FunctionalTestCase
{
    private ProjectRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = static::getContainer()->get(ProjectRepositoryInterface::class);
    }

    #[Test]
    public function can_create_a_project(): void
    {
        $organization = anOrganization();

        createProjectPage()->submit(withOrganization: $organization, withName: 'Featswitches');

        $project = $this->repository->all()[0];
        Assert::that($project)
            ->hasName('Featswitches');
    }
}
