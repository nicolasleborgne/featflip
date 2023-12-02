<?php

declare(strict_types=1);

namespace App\UseCases\SetFlag;

use App\Domain\Project\ProjectRepositoryInterface;

final readonly class SetFlagUseCase
{
    public function __construct(
        private ProjectRepositoryInterface $repository,
    ) {
    }

    public function execute(SetFlagRequest $request): void
    {
        $project = $this->repository->get($request->projectId);
        $project->setFlag(
            $request->feature,
            $request->environment,
            $request->value
        );
    }
}
