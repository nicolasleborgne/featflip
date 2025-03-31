<?php

declare(strict_types=1);

namespace App\Tests\Fixtures\Builder;

use App\Domain\Project\Feature;
use App\Domain\Project\Project;

final class FeatureBuilder extends Builder
{
    private ?Project $project = null;

    public function build(): Feature
    {
        $feature = new Feature(
            $this->project ?? aProject(),
            'feat'
        );

        return $feature;
    }

    public function withProject(Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
