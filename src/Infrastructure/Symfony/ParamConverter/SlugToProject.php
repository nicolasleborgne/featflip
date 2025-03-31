<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\ParamConverter;

use App\Domain\Project\FindProjectFromSlug;
use App\Domain\Project\Project;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[CodeCoverageIgnore]
final readonly class SlugToProject implements ValueResolverInterface
{
    public function __construct(
        private FindProjectFromSlug $query,
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();
        if (
            !$argumentType instanceof Project
        ) {
            return [];
        }

        $project = $this->query->execute($slug);

        return [$project];
    }
}
