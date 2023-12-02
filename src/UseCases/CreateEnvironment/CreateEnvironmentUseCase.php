<?php

declare(strict_types=1);

namespace App\UseCases\CreateEnvironment;

use App\Domain\Project\ProjectRepositoryInterface;

final readonly class CreateEnvironmentUseCase
{
    public function __construct(
        private ProjectRepositoryInterface $repository,
    ) {
    }

    public function execute(CreateEnvironmentRequest $request): void
    {
        $project = $this->repository->get($request->projectId);
        $project->addEnvironment($request->name);
    }
}
