<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Infrastructure\Symfony\Form\Type\CreateFeatureRequestType;
use App\Infrastructure\Symfony\ParamConverter\SlugToOrganization;
use App\Infrastructure\Symfony\ParamConverter\SlugToProject;
use App\UseCases\CreateFeature\CreateFeatureRequest;
use App\UseCases\CreateFeature\CreateFeatureUseCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/organizations/{organization_slug}/projects/{project_slug}/features/create', name: 'app_feature_create')]
#[ParamConverter('organization', options: ['slug' => 'organization_slug'], converter: SlugToOrganization::NAME)]
#[ParamConverter('project', options: ['slug' => 'project_slug'], converter: SlugToProject::NAME)]
#[AsController]
final class CreateFeatureController extends AbstractController
{
    public function __construct(
        private readonly CreateFeatureUseCase $createFeatureUseCase,
    ) {
    }

    public function __invoke(Request $request, Organization $organization, Project $project): Response
    {
        $form = $this->createForm(CreateFeatureRequestType::class, [
            'project_id' => $project->id(),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CreateFeatureRequest $data */
            $data = $form->getData();
            $this->createFeatureUseCase->execute($data);

            return $this->redirectToRoute('app_feature_create', [
                'organization_slug' => $organization->slug(),
                'project_slug' => $project->slug(),
            ]);
        }

        return $this->render('features/create.html.twig', [
            'form' => $form,
        ]);
    }
}
