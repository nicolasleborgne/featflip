<?php

declare(strict_types=1);

namespace App\Presentation\CreateOrganization;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/organizations/create', name: 'app_organization_create')]
#[AsController]
final class CreateOrganizationController extends AbstractController
{
    public function __invoke(): Response
    {
        return new Response('ok');
    }
}
