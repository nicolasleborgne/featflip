<?php

declare(strict_types=1);

namespace App\UseCases\CreateFeature;

use App\Domain\Project\ProjectId;

final class CreateFeatureRequest
{
    public function __construct(
        public readonly string $key,
        public readonly ProjectId $project,
    ) {
    }
}
