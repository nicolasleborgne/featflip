<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Query;

use App\Infrastructure\Symfony\Query\InMemoryFindOrganizationFromSlug;

final class InMemoryFindOrganizationFromSlugTestCase extends AbstractFindOrganizationFromSlugTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->query = self::getContainer()->get(InMemoryFindOrganizationFromSlug::class);
    }
}
