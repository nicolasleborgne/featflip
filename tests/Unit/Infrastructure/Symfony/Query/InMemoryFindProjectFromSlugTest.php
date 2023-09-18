<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Query;

use App\Infrastructure\Symfony\Query\InMemoryFindProjectFromSlug;

final class InMemoryFindProjectFromSlugTest extends AbstractFindProjectFromSlugTestCaseCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->query = self::getContainer()->get(InMemoryFindProjectFromSlug::class);
    }
}
