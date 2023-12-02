<?php

declare(strict_types=1);

namespace App\Tests\Fixtures\Builder;

use App\Domain\Organization\OrganizationId;
use App\Domain\Project\Project;
use App\Infrastructure\Symfony\Repository\DoctrineProjectRepository;
use App\Infrastructure\Symfony\Repository\InMemoryProjectRepository;

final class ProjectBuilder extends Builder
{
    private ?OrganizationId $organizationId = null;
    private ?string $name = null;
    private ?string $slug = null;

    private ?string $environment = null;

    /** @var array<int, string>|null */
    private ?array $features = null;

    #[\Override]
    public function build(): Project
    {
        $project = new Project(
            $this->name ?? 'A project',
            $this->slug ?? 'a-project',
            $this->organizationId ?? anOrganization()->id(),
        );

        $project->addEnvironment($this->environment ?? 'test');
        foreach ($this->features ?? ['track_parcel'] as $featureKey) {
            $project->addFeature($featureKey);
        }

        $this->add($project, DoctrineProjectRepository::class, InMemoryProjectRepository::class);

        return $project;
    }

    public function withOrganizationId(?OrganizationId $organizationId): self
    {
        $this->organizationId = $organizationId;

        return $this;
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

    public function withEnvironment(string $name): self
    {
        $this->environment = $name;

        return $this;
    }

    public function withFeatures(string ...$key): self
    {
        $this->features = $key;

        return $this;
    }
}
