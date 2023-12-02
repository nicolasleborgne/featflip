<?php

declare(strict_types=1);

namespace App\UseCases\CreateFeature;

use App\Domain\Project\ProjectRepositoryInterface;

final readonly class CreateFeatureUseCase
{
    public function __construct(
        private ProjectRepositoryInterface $repository,
    ) {
    }

    public function execute(CreateFeatureRequest $request): void
    {
        $project = $this->repository->get($request->projectId);
        $project->addFeature($request->key);
    }
}
