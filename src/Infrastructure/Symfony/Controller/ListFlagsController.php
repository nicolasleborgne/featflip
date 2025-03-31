<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use App\Domain\Organization\Organization;
use App\Domain\Project\Project;
use App\Infrastructure\Symfony\ParamConverter\SlugToOrganization;
use App\Infrastructure\Symfony\ParamConverter\SlugToProject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @codeCoverageIgnore
 */
#[Route(path: '/organizations/{organization_slug}/projects/{project_slug}/{environment_slug}/flags', name: 'app_flags_list')]
#[AsController]
final class ListFlagsController extends AbstractController
{
    public function __invoke(
        #[ValueResolver(SlugToOrganization::class)]
        Organization $organization,
        #[ValueResolver(SlugToProject::class)]
        Project $project,
        string $environment_slug
    ): Response
    {
        return $this->render('projects/flags/list.html.twig', [
            'flag_list' => $project->flags(),
        ]);
    }
}
