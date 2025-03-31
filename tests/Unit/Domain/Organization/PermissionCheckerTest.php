<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Organization;

use App\Domain\Organization\Permission;
use App\Domain\Organization\PermissionChecker;
use App\Domain\Organization\Role;
use App\Domain\User\User;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class PermissionCheckerTest extends UnitTestCase
{
    private PermissionChecker $permissionChecker;

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->permissionChecker = new PermissionChecker();
    }

    #[Test]
    #[DataProvider('permissions')]
    public function it_check_permissions(Role $role, Permission $permission, bool $expectation): void
    {
        $user = aUser();
        $organization = organizationBuilder()
            ->withGrant($user, $role)
            ->build();

        self::assertEquals(
            $expectation,
            $this->permissionChecker->check($user, can: $permission, in: $organization),
            sprintf('Failed asserting that %s %s %s.', $user, $expectation ? 'can' : 'cannot', $permission->name),
        );
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function permissions(): array
    {
        return [
            // Owners
            'Owner can list organizations' => [Role::Owner, Permission::ListOrganizations, true],
            'Owner can edit organization' => [Role::Owner, Permission::EditOrganization, true],
            'Owner can list projects' => [Role::Owner, Permission::ListProjects, true],
            'Owner can create environment' => [Role::Owner, Permission::CreateEnvironment, true],
            'Owner can edit environment' => [Role::Owner, Permission::EditEnvironment, true],
            'Owner can create feature' => [Role::Owner, Permission::CreateFeature, true],
            'Owner can edit feature' => [Role::Owner, Permission::EditFeature, true],
            'Owner can add user to organization' => [Role::Owner, Permission::AddUserToOrganization, true],
            // Member
            'Member can list organizations' => [Role::Member, Permission::ListOrganizations, true],
            'Member can edit organization' => [Role::Member, Permission::EditOrganization, false],
            'Member can list projects' => [Role::Member, Permission::ListProjects, true],
            'Member can create environment' => [Role::Member, Permission::CreateEnvironment, false],
            'Member can edit environment' => [Role::Member, Permission::EditEnvironment, false],
            'Member can create feature' => [Role::Member, Permission::CreateFeature, true],
            'Member can edit feature' => [Role::Member, Permission::EditFeature, true],
            'Member can add user to organization' => [Role::Member, Permission::AddUserToOrganization, false],
            // Reporter
            'Reporter can list organizations' => [Role::Reporter, Permission::ListOrganizations, true],
            'Reporter can edit organization' => [Role::Reporter, Permission::EditOrganization, false],
            'Reporter can list projects' => [Role::Reporter, Permission::ListProjects, true],
            'Reporter can create environment' => [Role::Reporter, Permission::CreateEnvironment, false],
            'Reporter can edit environment' => [Role::Reporter, Permission::EditEnvironment, false],
            'Reporter can create feature' => [Role::Reporter, Permission::CreateFeature, false],
            'Reporter can edit feature' => [Role::Reporter, Permission::EditFeature, false],
            'Reporter can add user to organization' => [Role::Reporter, Permission::AddUserToOrganization, false],
        ];
    }

    public function it_guard_permissions(User $user, Permission $permission, bool $expectation): void
    {
    }
}
