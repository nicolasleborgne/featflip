<?php

declare(strict_types=1);

namespace App\Domain\Project;

final class Project
{
    private readonly ProjectId $id;
    private string $name;
    private string $slug;

    public function __construct(
        string $name,
        string $slug,
    ) {
        $this->id = ProjectId::generate();
        $this->name = $name;
        $this->slug = $slug;
    }

    public function id(): ProjectId
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
}
