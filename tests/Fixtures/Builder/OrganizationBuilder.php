<?php

declare(strict_types=1);

namespace App\Tests\Fixtures\Builder;

use App\Domain\Organization\Organization;
use App\Domain\Organization\Role;
use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Symfony\Repository\DoctrineOrganizationRepository;
use App\Infrastructure\Symfony\Repository\InMemoryOrganizationRepository;

final class OrganizationBuilder extends Builder
{
    private ?string $name = null;
    private ?string $slug = null;

    /**
     * @var array<string, array<Role>>
     */
    private ?array $toGrant = null;

    #[\Override]
    public function build(): Organization
    {
        $organization = new Organization(
            $this->name ?? 'An Organization',
            $this->slug ?? 'an-organization',
            aUser(withLogin: false),
        );

        foreach ($this->toGrant ?? [] as $userId => $roles) {
            /** @var UserRepositoryInterface $userRepository */
            $userRepository = self::$testCase->container()->get(UserRepositoryInterface::class);
            $user = $userRepository->get(UserId::fromString($userId));
            $organization->grant($user, ...$roles);
        }

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

    public function withGrant(User $user, Role $role): self
    {
        $this->toGrant[(string) $user->id()][] = $role;

        return $this;
    }
}
