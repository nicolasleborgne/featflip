<?php

declare(strict_types=1);

namespace App\UseCases\CreateOrganization;

final readonly class CreateOrganizationRequest
{
    public function __construct(
        public string $name,
    ) {
    }
}
