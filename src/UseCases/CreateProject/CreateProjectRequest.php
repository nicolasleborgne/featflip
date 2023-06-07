<?php

declare(strict_types=1);

namespace App\UseCases\CreateProject;

use App\Domain\Organization\OrganizationId;

final class CreateProjectRequest
{
    public function __construct(
        public readonly string $name,
        public readonly OrganizationId $organizationId,
    ) {
    }
}
