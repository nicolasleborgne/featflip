<?php

declare(strict_types=1);

namespace App\Tests\Functional\ProjectManagement\Creation;

use App\Infrastructure\Symfony\Repository\InMemoryProjectRepository;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class CreateProjectTest extends FunctionalTestCase
{
    #[Test]
    public function can_create_a_project(): void
    {
        createProjectPage()->submit(forOrganization: anOrganization(), withName: 'Featswitches');

        self::assertProjectExists(withName: 'Featswitches');
    }

    private static function assertProjectExists(?string $withName = null): void
    {
        $repository = self::getContainer()->get(InMemoryProjectRepository::class);
        $projects = $repository->all();

        self::assertNotEmpty($projects, 'Failed asserting project exists');

        foreach ($projects as $project) {
            if (null !== $withName) {
                self::assertEquals(
                    $withName,
                    $project->name(),
                    sprintf('Failed asserting project has name %s', $withName)
                );
            }
        }
    }
}
