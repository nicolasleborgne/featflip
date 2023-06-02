<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Repository;

use App\Domain\Project\ProjectRepositoryInterface;

final class InMemoryProjectRepository implements ProjectRepositoryInterface
{
    private array $projects = [];

    public function get($projectId)
    {
        foreach ($this->projects as $project) {
            if ($project->id() === $projectId) {
                return $project;
            }
        }

        return null;
    }

    public function add($object): void
    {
        $key = array_search($object, $this->projects, true);
        if (false === $key) {
            $this->projects[] = $object;

            return;
        }

        $this->projects[$key] = $object;
    }

    public function all(): array
    {
        return $this->projects;
    }
}
