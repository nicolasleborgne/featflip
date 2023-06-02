<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Repository;

use App\Domain\Organization\OrganizationRepositoryInterface;

final class InMemoryOrganizationRepository implements OrganizationRepositoryInterface
{
    private array $organizations = [];

    public function get($organizationId)
    {
        if (isset($this->organizations[(string) $organizationId])) {
            return $this->organizations[(string) $organizationId];
        }

        return null;
    }

    public function add($object): void
    {
        $this->organizations[(string) $object->id()] = $object;
    }

    public function all(): array
    {
        return $this->organizations;
    }
}
