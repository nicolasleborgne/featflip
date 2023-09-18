<?php

declare(strict_types=1);

namespace App\Domain\Feature;

use App\Domain\Common\IdGenerator;

final class FeatureId
{
    public static function generate(): FeatureId
    {
        return new self(IdGenerator::generate());
    }

    public function __construct(
        private readonly string $value
    ) {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
