<?php

declare(strict_types=1);

namespace App\Domain\Organization;

use App\Domain\User\User;

final class PermissionChecker
{
    public function check(User $user, Permission $can, Organization $in): bool
    {
        $organization = $in;
        $permission = $can;
        $role = $organization->role(for: $user);

        return $role instanceof Role && $role->can($permission);
    }
}
