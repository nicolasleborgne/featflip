<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Repository;

use App\Domain\Feature\FeatureRepositoryInterface;

final class InMemoryFeatureRepository implements FeatureRepositoryInterface
{
    private array $features = [];

    public function get($featureId)
    {
        foreach ($this->features as $feature) {
            if ($feature->id() === $featureId) {
                return $feature;
            }
        }

        return null;
    }

    public function add($object): void
    {
        $key = array_search($object, $this->features, true);
        if (false === $key) {
            $this->features[] = $object;

            return;
        }

        $this->features[$key] = $object;
    }

    public function all(): array
    {
        return $this->features;
    }
}
