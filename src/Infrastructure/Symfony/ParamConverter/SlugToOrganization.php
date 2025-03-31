<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\ParamConverter;

use App\Domain\Organization\FindOrganizationFromSlug;
use App\Domain\Organization\Organization;
use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

#[CodeCoverageIgnore]
final readonly class SlugToOrganization implements ValueResolverInterface
{
    public function __construct(
        private FindOrganizationFromSlug $query,
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();
        if (
            !$argumentType instanceof Organization
        ) {
            return [];
        }

        $value = $request->attributes->get($argument->getName());
        $organization = $this->query->execute($value);


        return [$organization];
    }
}
