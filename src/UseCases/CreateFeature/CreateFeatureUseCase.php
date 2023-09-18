<?php

declare(strict_types=1);

namespace App\UseCases\CreateFeature;

use App\Domain\Feature\Feature;
use App\Domain\Feature\FeatureRepositoryInterface;

final class CreateFeatureUseCase
{
    public function __construct(
        private readonly FeatureRepositoryInterface $repository,
    ) {
    }

    public function execute(CreateFeatureRequest $request): void
    {
        $this->repository->add(new Feature(
            $request->project,
            $request->key,
        ));
    }
}
