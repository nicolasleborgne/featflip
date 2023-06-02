<?php

declare(strict_types=1);

namespace App\Domain\Project;

final class Project
{
    private readonly ProjectId $id;
    private string $name;

    public function __construct(
        string $name,
    ) {
        $this->id = ProjectId::generate();
        $this->name = $name;
    }

    public function id(): ProjectId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
