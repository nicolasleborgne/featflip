<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Query;

use App\Infrastructure\Symfony\Query\DoctrineFindProjectFromSlug;

final class DoctrineFindProjectFromSlugTest extends AbstractFindProjectFromSlugTestCaseCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->query = self::getContainer()->get(DoctrineFindProjectFromSlug::class);
    }
}
