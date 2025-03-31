<?php

namespace App\Domain\Organization;

enum Role: string
{
    case Owner = 'owner';
    case Member = 'member';
    case Reporter = 'reporter';

    private const PERMISSIONS = [
        self::Owner->value => [
            Permission::ListOrganizations->name => true,
            Permission::EditOrganization->name => true,
            Permission::ListProjects->name => true,
            Permission::EditProjects->name => true,
            Permission::CreateEnvironment->name => true,
            Permission::EditEnvironment->name => true,
            Permission::CreateFeature->name => true,
            Permission::EditFeature->name => true,
            Permission::AddUserToOrganization->name => true,
        ],
        self::Member->value => [
            Permission::ListOrganizations->name => true,
            Permission::EditOrganization->name => false,
            Permission::ListProjects->name => true,
            Permission::EditProjects->name => false,
            Permission::CreateEnvironment->name => false,
            Permission::EditEnvironment->name => false,
            Permission::CreateFeature->name => true,
            Permission::EditFeature->name => true,
            Permission::AddUserToOrganization->name => false,
        ],
        self::Reporter->value => [
            Permission::ListOrganizations->name => true,
            Permission::EditOrganization->name => false,
            Permission::ListProjects->name => true,
            Permission::EditProjects->name => false,
            Permission::CreateEnvironment->name => false,
            Permission::EditEnvironment->name => false,
            Permission::CreateFeature->name => false,
            Permission::EditFeature->name => false,
            Permission::AddUserToOrganization->name => false,
        ],
    ];

    public function can(Permission $permission): bool
    {
        return self::PERMISSIONS[$this->value][$permission->name];
    }
}
