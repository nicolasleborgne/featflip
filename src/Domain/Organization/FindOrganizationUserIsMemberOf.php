<?php

declare(strict_types=1);

namespace App\Domain\Organization;

use App\Domain\Common\QueryInterface;
use App\Domain\User\UserId;

interface FindOrganizationUserIsMemberOf extends QueryInterface
{
    public function execute(UserId $userId): ?Organization;
}
