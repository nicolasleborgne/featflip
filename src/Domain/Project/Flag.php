<?php

declare(strict_types=1);

namespace App\Domain\Project;

use App\Domain\Common\AbstractEntity;

final class Flag extends AbstractEntity
{
    private FlagId $id;
    private Environment $environment;
    private Feature $feature;
    private ?Project $project = null;
    private bool $value;

    public function __construct(Environment $environment, Feature $feature, bool $value = false)
    {
        $this->id = FlagId::generate();
        $this->environment = $environment;
        $this->feature = $feature;
        $this->value = $value;
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function setValue(bool $value): void
    {
        $this->value = $value;
    }

    public function feature(): Feature
    {
        return $this->feature;
    }

    public function environment(): Environment
    {
        return $this->environment;
    }

    /**
     * @codeCoverageIgnore
     */
    #[\Override]
    public function id(): FlagId
    {
        return $this->id;
    }
}
