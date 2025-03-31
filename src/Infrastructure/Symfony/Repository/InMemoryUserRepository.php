<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Repository;

use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Symfony\Entity\User;

final class InMemoryUserRepository implements UserRepositoryInterface
{
    /** @var User[] */
    private array $users = [];

    public function get($userId)
    {
        foreach ($this->users as $user) {
            if ($user->id()->equalTo($userId)) {
                return $user;
            }
        }

        return null;
    }

    public function add($object): void
    {
        $key = array_search($object, $this->users, true);
        if (false === $key) {
            $this->users[] = $object;

            return;
        }

        $this->users[$key] = $object;
    }

    /**
     * @return User[]
     */
    public function all(): array
    {
        return $this->users;
    }

    public function fromEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->email() === $email) {
                return $user;
            }
        }

        return null;
    }
}
