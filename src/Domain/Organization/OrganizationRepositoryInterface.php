<?php

declare(strict_types=1);

namespace App\Domain\Organization;

use App\Domain\Common\RepositoryInterface;

/**
 *  @implements RepositoryInterface<Organization, OrganizationId>
 */
interface OrganizationRepositoryInterface extends RepositoryInterface
{
    public function get($objectId);

    public function add($object): void;

    public function all(): array;
}
