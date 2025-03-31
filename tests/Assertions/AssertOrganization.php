<?php

declare(strict_types=1);

namespace App\Tests\Assertions;

use App\Domain\Organization\Organization;
use App\Domain\Organization\Role;
use App\Domain\User\User;

final class AssertOrganization extends Assert
{
    public function __construct(
        readonly Organization $organization,
    ) {
    }

    public function hasName(string $name): self
    {
        parent::$testCase::assertEquals(
            $name,
            $this->organization->name(),
            sprintf('Failed asserting that organization has name %s.', $name)
        );

        return $this;
    }

    public function hasSlug(string $slug): self
    {
        parent::$testCase::assertEquals(
            $slug,
            $this->organization->slug(),
            sprintf('Failed asserting that organization has slug %s.', $slug)
        );

        return $this;
    }

    public function hasStakeholder(User $user, Role $withRole): self
    {
        parent::$testCase::assertTrue(
            in_array($user, $this->organization->stakeholders($withRole)->toArray()),
            sprintf('Failed asserting that %s is %s of %s.', $user, $withRole->value, $this->organization)
        );

        return $this;
    }
}
