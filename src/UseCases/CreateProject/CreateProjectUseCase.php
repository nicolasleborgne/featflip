<?php

declare(strict_types=1);

namespace App\UseCases\CreateProject;

use App\Domain\Project\Project;
use App\Domain\Project\ProjectRepositoryInterface;

final class CreateProjectUseCase
{
    public function __construct(
        private readonly ProjectRepositoryInterface $repository,
    ) {
    }

    public function execute(CreateProjectRequest $request): void
    {
        $this->repository->add(new Project(
            $request->name,
        ));
    }
}
