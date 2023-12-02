<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Repository;

use App\Domain\Organization\Organization;
use App\Domain\Organization\OrganizationRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DoctrineOrganizationRepository implements OrganizationRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    public function get($objectId)
    {
        return $this->em->getRepository(Organization::class)->find($objectId);
    }

    public function add($object): void
    {
        $this->em->persist($object);
        $this->em->flush();
    }

    /** @return Organization[] */
    public function all(): array
    {
        return $this->em->getRepository(Organization::class)->findAll();
    }
}
