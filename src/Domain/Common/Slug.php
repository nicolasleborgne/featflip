<?php

declare(strict_types=1);

namespace App\Domain\Common;

use App\Infrastructure\Transliterator;

final class Slug
{
    public static function from(string $subject): string
    {
        return Transliterator::urlize($subject);
    }
}
