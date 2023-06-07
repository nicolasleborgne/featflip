<?php

declare(strict_types=1);

namespace App\Domain\Organization;

use App\Domain\Common\QueryInterface;

interface FindOrganizationFromSlug extends QueryInterface
{
    public function execute(string $slug): ?Organization;
}
