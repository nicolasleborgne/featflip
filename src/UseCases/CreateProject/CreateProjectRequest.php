<?php

declare(strict_types=1);

namespace App\UseCases\CreateProject;

final class CreateProjectRequest
{
    public function __construct(
        public readonly string $name,
    ) {
    }
}
