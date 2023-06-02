<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Repository;

use App\Domain\Project\ProjectRepositoryInterface;

final class InMemoryProjectRepository implements ProjectRepositoryInterface
{
    private array $projects = [];

    public function get($projectId)
    {
        if (isset($this->projects[(string) $projectId])) {
            return $this->projects[(string) $projectId];
        }

        return null;
    }

    public function add($object): void
    {
        $this->projects[(string) $object->id()] = $object;
    }

    public function all(): array
    {
        return $this->projects;
    }
}
