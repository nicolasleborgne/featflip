<?php

declare(strict_types=1);

namespace App\Tests\Fixtures\Builder;

use App\Domain\Organization\Organization;
use App\Infrastructure\Symfony\Repository\DoctrineOrganizationRepository;
use App\Infrastructure\Symfony\Repository\InMemoryOrganizationRepository;

final class OrganizationBuilder extends Builder
{
    private ?string $name = null;
    private ?string $slug = null;

    #[\Override]
    public function build(): Organization
    {
        $organization = new Organization(
            $this->name ?? 'An Organization',
            $this->slug ?? 'an-organization',
        );

        $this->add($organization, DoctrineOrganizationRepository::class, InMemoryOrganizationRepository::class);

        return $organization;
    }

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
