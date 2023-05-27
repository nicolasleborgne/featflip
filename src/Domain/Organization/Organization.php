<?php

declare(strict_types=1);

namespace App\Domain\Organization;

final class Organization
{
    private readonly OrganizationId $id;
    private string $name;

    public function __construct(
        string $name,
    ) {
        $this->id = OrganizationId::generate();
        $this->name = $name;
    }

    public function id(): OrganizationId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
