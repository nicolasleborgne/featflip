<?php

declare(strict_types=1);

namespace App\UseCases\CreateProject;

use App\Domain\Project\ProjectId;

final class CreateProjectEnvironmentRequest
{
    public function __construct(
        public readonly string $name,
        public readonly ProjectId $projectId,
    ) {
    }
}
