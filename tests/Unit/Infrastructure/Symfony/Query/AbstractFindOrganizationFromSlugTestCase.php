<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Query;

use App\Domain\Organization\FindOrganizationFromSlug;
use App\Tests\Unit\UnitTest;
use PHPUnit\Framework\Attributes\Test;

abstract class AbstractFindOrganizationFromSlugTestCase extends UnitTest
{
    protected FindOrganizationFromSlug $query;

    #[Test]
    public function it_found_from_slug(): void
    {
        anOrganization(withSlug: 'an-organization');

        $organization = $this->query->execute('an-organization');

        self::assertEquals($organization->slug(), 'an-organization');
    }

    #[Test]
    public function it_return_null_when_unknown(): void
    {
        $organization = $this->query->execute('an-organization');

        self::assertNull($organization);
    }
}
