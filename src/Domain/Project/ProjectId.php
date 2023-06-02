<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\Common\IdGenerator;

final class ProjectId implements \Stringable
{
    public static function generate(): ProjectId
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
