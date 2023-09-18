<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\Common\QueryInterface;

interface FindProjectFromSlug extends QueryInterface
{
    public function execute(string $slug): ?Project;
}
