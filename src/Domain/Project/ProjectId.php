<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\Common\AbstractId;

final class ProjectId extends AbstractId
{
    public function equalTo(ProjectId $projectId): bool
    {
        return (string) $projectId === (string) $this;
    }
}
