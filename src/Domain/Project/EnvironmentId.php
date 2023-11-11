<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\Common\IdGenerator;

final class EnvironmentId implements \Stringable
{
    public static function generate(): EnvironmentId
    {
        return new self(IdGenerator::generate());
    }

    public static function fromString(string $value): EnvironmentId
    {
        return new self($value);
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
