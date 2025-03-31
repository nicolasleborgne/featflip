<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\Common\AbstractEntity;

final class Feature extends AbstractEntity
{
    private FeatureId $id;
    private Project $project;
    private string $key;

    public function __construct(
        Project $project,
        string $key,
    ) {
        $this->id = FeatureId::generate();
        $this->project = $project;
        $this->key = $key;
    }

    #[\Override]
    public function id(): FeatureId
    {
        return $this->id;
    }

    public function key(): string
    {
        return $this->key;
    }

    //    public function project(): Project
    //    {
    //        return $this->project;
    //    }

    public function equalTo(Feature $feature): bool
    {
        return $this->id() === $feature->id();
    }
}
