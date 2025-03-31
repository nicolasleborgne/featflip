<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Query;

use App\Domain\Organization\FindOrganizationFromSlug;
use App\Domain\Organization\Organization;
use App\Domain\Organization\OrganizationRepositoryInterface;

final readonly class InMemoryFindOrganizationFromSlug implements FindOrganizationFromSlug
{
    public function __construct(
        private OrganizationRepositoryInterface $repository,
    ) {
    }

    public function execute(string $slug): ?Organization
    {
        foreach ($this->repository->all() as $organization) {
            if ($organization->slug() === $slug) {
                return $organization;
            }
        }

        return null;
    }
}
