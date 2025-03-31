<?php

declare(strict_types=1);

namespace App\Domain\Organization;

use App\Domain\Common\AbstractEntity;
use App\Domain\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Organization extends AbstractEntity
{
    private OrganizationId $id;
    private string $name;

    private string $slug;
    /** @var Collection<string, UserRole> */
    private Collection $userRoleList;

    public function __construct(
        string $name,
        string $slug,
        User $owner,
    ) {
        $this->id = OrganizationId::generate();
        $this->name = $name;
        $this->slug = $slug;
        $this->userRoleList = new ArrayCollection();
        $this->userRoleList->add(new UserRole($this, $owner, Role::Owner));
    }

    #[\Override]
    public function id(): OrganizationId
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

    /**
     * @return Collection<string, User>
     */
    public function stakeholders(?Role $withRole = null): Collection
    {
        $filtered = $this->userRoleList;
        if (null !== $withRole) {
            $filtered = $this->userRoleList->filter(fn (UserRole $ur) => $ur->role() === $withRole);
        }

        return $filtered->map(fn (UserRole $ur) => $ur->user());
    }

    public function grant(User $user, Role ...$roles): void
    {
        foreach ($roles as $role) {
            $userRole = $this->userRole(for: $user) ?? new UserRole($this, $user, $role);
            $userRole->grant($role);
            if (!$this->userRoleList->contains($userRole)) {
                $this->userRoleList->add($userRole);
            }
        }
    }

    private function userRole(User $for): ?UserRole
    {
        foreach ($this->userRoleList as $userRole) {
            if ($userRole->user()->id()->equalTo($for->id())) {
                return $userRole;
            }
        }

        return null;
    }

    public function role(User $for): ?Role
    {
        return $this->userRole($for)?->role();
    }
}
