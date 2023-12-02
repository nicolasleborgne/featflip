<?php

declare(strict_types=1);

namespace App\Domain\Common;

abstract class AbstractEntity implements \Stringable
{
    abstract public function id(): AbstractId;

    /**
     * @codeCoverageIgnore
     */
    public function __toString(): string
    {
        return sprintf('%s{%s}', static::class, $this->id());
    }
}
