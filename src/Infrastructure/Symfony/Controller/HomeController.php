<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Domain\Organization\OrganizationRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/', name: 'app_home')]
#[AsController]
final class HomeController extends AbstractController
{
    public function __construct(
        private readonly OrganizationRepositoryInterface $repository,
    ) {

    }
    public function __invoke(): Response
    {
        return $this->render('home/index.html.twig', [
            'organization' => [],
        ]);
    }
}
