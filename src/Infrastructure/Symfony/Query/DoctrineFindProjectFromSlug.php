<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Query;

use App\Domain\Project\FindProjectFromSlug;
use App\Domain\Project\Project;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineFindProjectFromSlug implements FindProjectFromSlug
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function execute(string $slug): ?Project
    {
        return $this->em->getRepository(Project::class)->findOneBy(['slug' => $slug]);
    }
}
