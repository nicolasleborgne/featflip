<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\Common\AbstractEntity;

final class Environment extends AbstractEntity
{
    private EnvironmentId $id;
    private string $name;
    private string $slug;

    private readonly Project $project;

    public function __construct(
        string $name,
        string $slug,
        Project $project,
    ) {
        $this->id = EnvironmentId::generate();
        $this->name = $name;
        $this->slug = $slug;
        $this->project = $project;
    }

    #[\Override]
    public function id(): EnvironmentId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function equalTo(Environment $environment): bool
    {
        return $this->id() === $environment->id();
    }
}
