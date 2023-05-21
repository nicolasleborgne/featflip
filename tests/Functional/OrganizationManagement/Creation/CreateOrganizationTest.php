<?php

declare(strict_types=1);

namespace App\Tests\Functionnal\OrganizationManagement\Creation;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use function App\Tests\Functionnal\OrganizationManagement\createOrganizationPage;

final class CreateOrganizationTest extends KernelTestCase
{
    #[Test]
    public function can_create_an_organization(): void
    {
        createOrganizationPage()->submit();

        self::assertOrganizationExists();
    }

    private static function assertOrganizationExists()
    {

    }
}
