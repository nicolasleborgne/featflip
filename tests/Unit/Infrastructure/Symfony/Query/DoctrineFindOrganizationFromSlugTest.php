<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Query;

use App\Infrastructure\Symfony\Query\DoctrineFindOrganizationFromSlug;

final class DoctrineFindOrganizationFromSlugTest extends AbstractFindOrganizationFromSlugTestCaseCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->query = self::getContainer()->get(DoctrineFindOrganizationFromSlug::class);
    }
}
