<?php

declare(strict_types=1);

namespace App\Domain\Common;

abstract class AbstractId implements \Stringable
{
    public static function generate(): static
    {
        return new static(IdGenerator::generate());
    }

    public static function fromString(string $value): static
    {
        return new static($value);
    }

    final public function __construct(
        private readonly string $value
    ) {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
