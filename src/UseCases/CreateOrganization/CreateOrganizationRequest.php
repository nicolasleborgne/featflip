<?php

declare(strict_types=1);

namespace App\UseCases\CreateOrganization;

use App\Domain\User\User;

final readonly class CreateOrganizationRequest
{
    public function __construct(
        public string $name,
        public User $owner,
    ) {
    }
}
