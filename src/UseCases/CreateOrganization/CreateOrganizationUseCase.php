<?php

declare(strict_types=1);

namespace App\UseCases\CreateOrganization;

use App\Domain\Common\Slug;
use App\Domain\Organization\Organization;
use App\Domain\Organization\OrganizationRepositoryInterface;

final readonly class CreateOrganizationUseCase
{
    public function __construct(
        private OrganizationRepositoryInterface $repository,
    ) {
    }

    public function execute(CreateOrganizationRequest $request): void
    {
        $slug = Slug::from($request->name);
        $this->repository->add(new Organization(
            $request->name,
            $slug,
        ));
    }
}
