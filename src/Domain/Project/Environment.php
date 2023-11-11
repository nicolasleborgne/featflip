<?php

declare(strict_types=1);

namespace App\Domain\Project;

final class Environment
{
    private readonly EnvironmentId $id;
    private string $name;
    private string $slug;

    public function __construct(
        string $name,
        string $slug,
    ) {
        $this->id = EnvironmentId::generate();
        $this->name = $name;
        $this->slug = $slug;
    }

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

    public function __toString(): string
    {
        return sprintf('%s{%s}', self::class, $this->id);
    }
}
