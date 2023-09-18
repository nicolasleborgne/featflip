<?php

declare(strict_types=1);

namespace App\Tests\Unit\Infrastructure\Symfony\Query;

use App\Domain\Project\FindProjectFromSlug;
use App\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

abstract class AbstractFindProjectFromSlugTestCaseCase extends UnitTestCase
{
    protected FindProjectFromSlug $query;

    #[Test]
    public function it_found_from_slug(): void
    {
        aProject(withSlug: 'a-project');

        $project = $this->query->execute('a-project');

        self::assertEquals($project->slug(), 'a-project');
    }

    #[Test]
    public function it_return_null_when_unknown(): void
    {
        $project = $this->query->execute('a-project');

        self::assertNull($project);
    }
}
