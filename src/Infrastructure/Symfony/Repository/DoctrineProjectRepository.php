<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Repository;

use App\Domain\Project\Project;
use App\Domain\Project\ProjectRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineProjectRepository implements ProjectRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function get($objectId)
    {
        return $this->em->getRepository(Project::class)->find($objectId);
    }

    public function add($object): void
    {
        $this->em->persist($object);
        $this->em->flush();
    }

    public function all(): array
    {
        return $this->em->getRepository(Project::class)->findAll();
    }
}
