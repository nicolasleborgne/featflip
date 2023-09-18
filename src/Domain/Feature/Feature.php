<?php

declare(strict_types=1);

namespace App\Domain\Feature;

use App\Domain\Project\ProjectId;

final class Feature
{
    private readonly FeatureId $id;
    private readonly ProjectId $projectId;
    private string $key;

    public function __construct(
        ProjectId $projectId,
        string $key,
    ) {
        $this->id = FeatureId::generate();
        $this->projectId = $projectId;
        $this->key = $key;
    }

    public function id(): FeatureId
    {
        return $this->id;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function projectId(): ProjectId
    {
        return $this->projectId;
    }
}
