<?php

declare(strict_types=1);

namespace App\Tests\Assertions;

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;

final class AssertProject extends Assert
{
    public function __construct(
        readonly Project $project,
    ) {
    }

    public function hasName(string $name): self
    {
        parent::$testCase::assertEquals(
            $name,
            $this->project->name(),
            sprintf('Failed asserting that project has name %s.', $name)
        );

        return $this;
    }

    public function hasSlug(string $slug): self
    {
        parent::$testCase::assertEquals(
            $slug,
            $this->project->slug(),
            sprintf('Failed asserting that project has slug %s.', $slug)
        );

        return $this;
    }

    public function hasOrganization(Organization $organization): self
    {
        parent::$testCase::assertEquals(
            $organization->id(),
            $this->project->organizationId(),
            sprintf('Failed asserting that project has organization %s.', $organization),
        );

        return $this;
    }

    public function hasEnvironment(string $withName): self
    {
        parent::$testCase::assertTrue(
            $this->project->hasEnvironment($withName),
            sprintf('Failed asserting that project has environment name %s.', $withName),
        );

        return $this;
    }
}
