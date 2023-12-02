<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\ParamConverter;

use App\Domain\Organization\FindOrganizationFromSlug;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[CodeCoverageIgnore]
final readonly class SlugToOrganization implements ParamConverterInterface
{
    public const NAME = 'slug_to_organization';

    public function __construct(
        private FindOrganizationFromSlug $query
    ) {
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $options = $configuration->getOptions();
        $propertyName = $options['slug'] ?? 'slug';
        $slug = $request->attributes->get($propertyName, null);
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
