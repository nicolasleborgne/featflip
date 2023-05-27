<?php

declare(strict_types=1);

namespace App\Domain\Common;

use Ramsey\Uuid\Uuid;

final class IdGenerator
{
    public static function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
