<?php

declare(strict_types=1);

namespace App\UseCases\SetFlag;

use App\Domain\Project\EnvironmentId;
use App\Domain\Project\FeatureId;
use App\Domain\Project\ProjectId;

final readonly class SetFlagRequest
{
    public function __construct(
        public ProjectId $projectId,
        public EnvironmentId $environment,
        public FeatureId $feature,
        public bool $value
    ) {
    }
}
