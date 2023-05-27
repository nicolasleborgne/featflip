<?php

declare(strict_types=1);

namespace App\Tests\Functional\OrganizationManagement\Creation;

use App\Infrastructure\Symfony\Repository\InMemoryOrganizationRepository;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class CreateOrganizationTest extends FunctionalTestCase
{
    #[Test]
    public function can_create_an_organization(): void
    {
        createOrganizationPage()->submit(withName: 'Featswitches &co');

        self::assertOrganizationExists(withName: 'Featswitches &co');
    }

    private static function assertOrganizationExists(?string $withName = null): void
    {
        $repository = self::getContainer()->get(InMemoryOrganizationRepository::class);
        $organizations = $repository->all();

        self::assertNotEmpty($organizations, 'Failed asserting organization exists');

        foreach ($organizations as $organization) {
            if (null !== $withName) {
                self::assertEquals(
                    $withName,
                    $organization->name(),
                    sprintf('Failed asserting organization has name %s', $withName)
                );
            }
        }
    }
}
