<?php

declare(strict_types=1);

namespace App\Domain\Organization;

enum Permission
{
    case ListOrganizations;
    case EditOrganization;
    case ListProjects;
    case EditProjects;
    case CreateEnvironment;
    case EditEnvironment;
    case CreateFeature;
    case EditFeature;
    case AddUserToOrganization;
}
