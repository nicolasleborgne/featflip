<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\ParamConverter;

use App\Domain\Organization\FindOrganizationFromSlug;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SlugToOrganization implements ParamConverterInterface
{
    public const NAME = 'slug_to_organization';

    public function __construct(
        private readonly FindOrganizationFromSlug $query
    ) {
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $slug = $request->attributes->get('slug', null);
        $organization = $this->query->execute($slug);

        if (null === $organization) {
            throw new NotFoundHttpException('Unable to found organization with slug %s', $slug);
        }

        $request->attributes->set('organization', $organization);

        return true;
    }

    public function supports(ParamConverter $configuration): bool
    {
        if (self::NAME === $configuration->getConverter()) {
            return true;
        }

        return false;
    }
}
