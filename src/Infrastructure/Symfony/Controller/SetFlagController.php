<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Infrastructure\Symfony\Form\Type\SetFlagRequestType;
use App\Infrastructure\Symfony\ParamConverter\SlugToOrganization;
use App\Infrastructure\Symfony\ParamConverter\SlugToProject;
use App\UseCases\SetFlag\SetFlagRequest;
use App\UseCases\SetFlag\SetFlagUseCase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/organizations/{organization_slug}/projects/{project_slug}/flag', name: 'app_project_set_flag')]
#[ParamConverter('organization', options: ['slug' => 'organization_slug'], converter: SlugToOrganization::NAME)]
#[ParamConverter('project', options: ['slug' => 'project_slug'], converter: SlugToProject::NAME)]
#[AsController]
final class SetFlagController extends AbstractController
{
    public function __construct(
        private readonly SetFlagUseCase $setFlagUseCase,
    ) {
    }

    public function __invoke(Request $request, Organization $organization, Project $project): Response
    {
        $form = $this->createForm(SetFlagRequestType::class, [
            'project_id' => $project->id(),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var SetFlagRequest $data */
            $data = $form->getData();
            $this->setFlagUseCase->execute($data);

            return $this->redirectToRoute('app_project_set_flag', [
                'organization_slug' => $organization->slug(),
                'project_slug' => $project->slug(),
            ]);
        }

        return $this->render('projects/flags/set.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
