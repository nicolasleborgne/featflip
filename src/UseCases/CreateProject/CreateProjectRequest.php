<?php

declare(strict_types=1);

namespace App\UseCases\CreateProject;

use App\Domain\Organization\OrganizationId;

final readonly class CreateProjectRequest
{
    public function __construct(
        public string $name,
        public OrganizationId $organizationId,
    ) {
    }
}
