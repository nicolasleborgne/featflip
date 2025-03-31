<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Common\AbstractId;

final class UserId extends AbstractId
{
    public function equalTo(UserId $userId): bool
    {
        return $this->__toString() === (string) $userId;
    }
}
