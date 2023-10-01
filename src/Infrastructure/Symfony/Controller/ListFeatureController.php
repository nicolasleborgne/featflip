<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Domain\Feature\Feature;
use App\Domain\Feature\FeatureRepositoryInterface;
use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Infrastructure\Symfony\ParamConverter\SlugToOrganization;
use App\Infrastructure\Symfony\ParamConverter\SlugToProject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/organizations/{organization_slug}/projects/{project_slug}/features', name: 'app_feature_list')]
#[ParamConverter('organization', options: ['slug' => 'organization_slug'], converter: SlugToOrganization::NAME)]
#[ParamConverter('project', options: ['slug' => 'project_slug'], converter: SlugToProject::NAME)]
#[AsController]
final class ListFeatureController extends AbstractController
{
    public function __construct(
        private readonly FeatureRepositoryInterface $featureRepository,
    ) {
    }

    public function __invoke(Request $request, Organization $organization, Project $project): Response
    {
        return $this->render('features/list.html.twig', [
            'feature_list' => array_map(fn (Feature $f) => ['id' => $f->id(), 'name' => $f->key()], $this->featureRepository->all()),
        ]);
    }
}
