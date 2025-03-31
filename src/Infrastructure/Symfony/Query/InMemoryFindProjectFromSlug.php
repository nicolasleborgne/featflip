<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Query;

use App\Domain\Project\FindProjectFromSlug;
use App\Domain\Project\Project;
use App\Domain\Project\ProjectRepositoryInterface;

final readonly class InMemoryFindProjectFromSlug implements FindProjectFromSlug
{
    public function __construct(
        private ProjectRepositoryInterface $repository,
    ) {
    }

    public function execute(string $slug): ?Project
    {
        foreach ($this->repository->all() as $project) {
            if ($project->slug() === $slug) {
                return $project;
            }
        }

        return null;
    }
}
