<?php

declare(strict_types=1);

namespace App\Domain\Organization;

use App\Domain\Common\IdGenerator;
use App\Domain\User\User;

final class UserRole
{
    private string $id;
    private Organization $organization;
    private User $user;
    private Role $role;

    public function __construct(
        Organization $organization,
        User $user,
        Role $role,
    ) {
        $this->id = IdGenerator::generate();
        $this->organization = $organization;
        $this->user = $user;
        $this->role = $role;
    }

    public function role(): Role
    {
        return $this->role;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function grant(Role $role): void
    {
        $this->role = $role;
    }
}
