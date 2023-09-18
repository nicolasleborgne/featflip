<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\ParamConverter;

use App\Domain\Project\FindProjectFromSlug;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[CodeCoverageIgnore]
final class SlugToProject implements ParamConverterInterface
{
    public const NAME = 'slug_to_project';

    public function __construct(
        private readonly FindProjectFromSlug $query
    ) {
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $options = $configuration->getOptions();
        $propertyName = $options['slug'] ?? 'slug';
        $slug = $request->attributes->get($propertyName, null);
        $project = $this->query->execute($slug);

        if (null === $project) {
            throw new NotFoundHttpException('Unable to found project with slug %s', $slug);
        }

        $request->attributes->set('project', $project);

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
