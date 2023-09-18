<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Repository;

use App\Domain\Feature\Feature;
use App\Domain\Feature\FeatureRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineFeatureRepository implements FeatureRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function get($objectId)
    {
        return $this->em->getRepository(Feature::class)->find($objectId);
    }

    public function add($object): void
    {
        $this->em->persist($object);
        $this->em->flush();
    }

    public function all(): array
    {
        return $this->em->getRepository(Feature::class)->findAll();
    }
}
