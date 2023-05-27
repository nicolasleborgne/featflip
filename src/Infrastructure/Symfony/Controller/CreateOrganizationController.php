<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Infrastructure\Symfony\Form\Type\CreateOrganizationRequestType;
use App\UseCases\CreateOrganization\CreateOrganizationRequest;
use App\UseCases\CreateOrganization\CreateOrganizationUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/organizations/create', name: 'app_organization_create')]
#[AsController]
final class CreateOrganizationController extends AbstractController
{
    public function __construct(
        private readonly CreateOrganizationUseCase $createOrganizationUseCase,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(CreateOrganizationRequestType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CreateOrganizationRequest $data */
            $data = $form->getData();
            $this->createOrganizationUseCase->execute($data);

            return $this->redirectToRoute('app_organization_create');
        }

        return $this->render('organizations/create.html.twig', [
            'form' => $form,
        ]);
    }
}
