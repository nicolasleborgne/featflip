<?php

declare(strict_types=1);

namespace App\Tests\Functional\OrganizationManagement\Creation;

use App\Domain\Organization\Organization;
use App\Domain\Organization\OrganizationRepositoryInterface;
use App\Infrastructure\Symfony\Repository\InMemoryOrganizationRepository;
use App\Tests\Assertions\Assert;
use App\Tests\Functional\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;

final class CreateOrganizationTest extends FunctionalTestCase
{
    private OrganizationRepositoryInterface $repository;

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = self::getContainer()->get(InMemoryOrganizationRepository::class);
    }

    #[Test]
    public function it_create_an_organization(): void
    {
        createOrganizationPage()->submit(withName: 'Featswitches &co');

        /** @var Organization $organization */
        $organization = $this->repository->all()[0];
        Assert::thatOrganization($organization)
            ->hasName('Featswitches &co')
            ->hasSlug('featswitches-co');
    }
}
