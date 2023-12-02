<?php

declare(strict_types=1);

namespace App\UseCases\CreateFeature;

use App\Domain\Project\ProjectId;

final readonly class CreateFeatureRequest
{
    public function __construct(
        public string $key,
        public ProjectId $projectId,
    ) {
    }
}
