<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Repository;

use App\Domain\Organization\OrganizationRepositoryInterface;

final class InMemoryOrganizationRepository implements OrganizationRepositoryInterface
{
    private array $organizations = [];

    public function get($featureId)
    {
        foreach ($this->organizations as $organization) {
            if ($organization->id() === $featureId) {
                return $organization;
            }
        }

        return null;
    }

    public function add($object): void
    {
        $key = array_search($object, $this->organizations, true);
        if (false === $key) {
            $this->organizations[] = $object;

            return;
        }

        $this->organizations[$key] = $object;
    }

    public function all(): array
    {
        return $this->organizations;
    }
}
