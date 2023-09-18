<?php

declare(strict_types=1);

namespace App\Tests\Fixtures\Builder;

use App\Domain\Feature\Feature;
use App\Domain\Project\ProjectId;
use App\Infrastructure\Symfony\Repository\DoctrineFeatureRepository;
use App\Infrastructure\Symfony\Repository\InMemoryFeatureRepository;

final class FeatureBuilder extends Builder
{
    private ?ProjectId $projectId = null;
    private ?string $key = null;

    public function build(): Feature
    {
        $feature = new Feature(
            $this->projectId ?? aProject()->id(),
            $this->key ?? 'some_feature',
        );

        $this->add($feature, DoctrineFeatureRepository::class, InMemoryFeatureRepository::class);

        return $feature;
    }

    public function withProjectId(?ProjectId $projecftId): self
    {
        $this->projectId = $projecftId;

        return $this;
    }

    public function withkey(string $key): self
    {
        $this->key = $key;

        return $this;
    }
}
