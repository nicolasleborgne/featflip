<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Infrastructure\Symfony\Form\Type\CreateProjectEnvironmentRequestType;
use App\Infrastructure\Symfony\ParamConverter\SlugToOrganization;
use App\Infrastructure\Symfony\ParamConverter\SlugToProject;
use App\UseCases\CreateEnvironment\CreateEnvironmentRequest;
use App\UseCases\CreateEnvironment\CreateEnvironmentUseCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/organizations/{organization_slug}/projects/{project_slug}/environment/create', name: 'app_project_environment_create')]
#[ParamConverter('organization', options: ['slug' => 'organization_slug'], converter: SlugToOrganization::NAME)]
#[ParamConverter('project', options: ['slug' => 'project_slug'], converter: SlugToProject::NAME)]
#[AsController]
final class CreateProjectEnvironmentController extends AbstractController
{
    public function __construct(
        private readonly CreateEnvironmentUseCase $createEnvironmentUseCase,
    ) {
    }

    public function __invoke(Request $request, Organization $organization, Project $project): Response
    {
        $form = $this->createForm(CreateProjectEnvironmentRequestType::class, [
            'organization_id' => $organization->id(),
            'project_id' => $project->id(),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CreateEnvironmentRequest $data */
            $data = $form->getData();
            $this->createEnvironmentUseCase->execute($data);

            return $this->redirectToRoute('app_project_create', [
                'slug' => $organization->slug(),
            ]);
        }

        return $this->render('projects/environments/create.html.twig', [
            'form' => $form,
        ]);
    }
}
