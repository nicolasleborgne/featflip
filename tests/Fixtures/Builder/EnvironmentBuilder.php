<?php

declare(strict_types=1);

namespace App\Tests\Fixtures\Builder;

use App\Domain\Project\Environment;
use App\Domain\Project\Project;

final class EnvironmentBuilder extends Builder
{
    private ?Project $project = null;

    public function build(): Environment
    {
        $environment = new Environment(
            'test',
            'test',
            $this->project ?? aProject()
        );

        return $environment;
    }

    public function withProject(Project $project): self
    {
        $this->project = $project;

        return $this;
    }
}
