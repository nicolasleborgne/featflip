<?php

declare(strict_types=1);

namespace App\Domain\Common;

/**
 * @template T
 * @template U
 */
interface RepositoryInterface
{
    /**
     * @param U $objectId
     *
     * @return T|null
     */
    public function get($objectId);

    /**
     * @param T $object
     */
    public function add($object): void;

    /**
     * @return array<int, T>
     */
    public function all(): array;
}
