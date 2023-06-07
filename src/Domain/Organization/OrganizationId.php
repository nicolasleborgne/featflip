<?php

declare(strict_types=1);

namespace App\Domain\Organization;

use App\Domain\Common\IdGenerator;

final class OrganizationId implements \Stringable
{
    public static function generate(): OrganizationId
    {
        return new self(IdGenerator::generate());
    }

    public static function fromString(string $value): OrganizationId
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
