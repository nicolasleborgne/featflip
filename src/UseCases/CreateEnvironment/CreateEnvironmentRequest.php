<?php

declare(strict_types=1);

namespace App\UseCases\CreateEnvironment;

use App\Domain\Project\ProjectId;

final readonly class CreateEnvironmentRequest
{
    public function __construct(
        public string $name,
        public ProjectId $projectId,
    ) {
    }
}
