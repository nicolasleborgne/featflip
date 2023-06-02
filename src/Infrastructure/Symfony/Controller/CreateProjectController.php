<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Infrastructure\Symfony\Form\Type\CreateProjectRequestType;
use App\UseCases\CreateProject\CreateProjectRequest;
use App\UseCases\CreateProject\CreateProjectUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/organizations/{slug}/projects/create', name: 'app_project_create')]
#[AsController]
final class CreateProjectController extends AbstractController
{
    public function __construct(
        private readonly CreateProjectUseCase $createProjectUseCase,
    ) {
    }

    public function __invoke(Request $request, string $slug): Response
    {
        $form = $this->createForm(CreateProjectRequestType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CreateProjectRequest $data */
            $data = $form->getData();
            $this->createProjectUseCase->execute($data);

            return $this->redirectToRoute('app_project_create', [
                'slug' => $slug,
            ]);
        }

        return $this->render('projects/create.html.twig', [
            'form' => $form,
        ]);
    }
}
