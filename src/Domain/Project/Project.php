<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\Organization\OrganizationId;

final class Project
{
    private readonly ProjectId $id;
    private string $name;
    private string $slug;

    private OrganizationId $organizationId;

    private $environmentList;

    public function __construct(
        string $name,
        string $slug,
        OrganizationId $organizationId,
    ) {
        $this->id = ProjectId::generate();
        $this->name = $name;
        $this->slug = $slug;
        $this->organizationId = $organizationId;
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

    public function organizationId(): OrganizationId
    {
        return $this->organizationId;
    }

    public function hasEnvironment(string $name): bool
    {
        return true;
    }

    public function __toString(): string
    {
        return sprintf('%s{%s}', self::class, $this->id);
    }
}
