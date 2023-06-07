<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Query;

use App\Domain\Organization\FindOrganizationFromSlug;
use App\Domain\Organization\Organization;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineFindOrganizationFromSlug implements FindOrganizationFromSlug
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function execute(string $slug): ?Organization
    {
        return $this->em->getRepository(Organization::class)->findOneBy(['slug' => $slug]);
    }
}
