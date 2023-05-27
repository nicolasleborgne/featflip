<?php

declare(strict_types=1);

namespace App\UseCases\CreateOrganization;

final class CreateOrganizationRequest
{
    public function __construct(
        public readonly string $name,
    ) {
    }
}
