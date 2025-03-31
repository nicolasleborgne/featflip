<?php

declare(strict_types=1);

namespace App\Tests\Fixtures\Builder;

use App\Infrastructure\Symfony\Entity\User;
use App\Infrastructure\Symfony\Repository\DoctrineUserRepository;
use App\Infrastructure\Symfony\Repository\InMemoryUserRepository;
use App\Tests\Functional\FunctionalTestCase;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

final class UserBuilder extends Builder
{
    private ?string $email = null;
    private ?string $password = null;

    private bool $isLogged = true;

    #[\Override]
    public function build(): User
    {
        $user = new User(
            $this->email ?? 'test@test.com',
        );
        /** @var PasswordHasherFactoryInterface $factory */
        $factory = self::$testCase->container()->get(PasswordHasherFactoryInterface::class);
        $hasher = $factory->getPasswordHasher($user);
        $password = $hasher->hash($this->password ?? 'password');
        $user->setPassword($password);

        $this->add($user, InMemoryUserRepository::class, DoctrineUserRepository::class);
        if ($this->isLogged && self::$testCase instanceof FunctionalTestCase && isset(self::$testCase::$client)) {
            self::$testCase::$client->loginUser($user);
        }

        return $user;
    }

    public function withEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function withPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function withLogin(bool $isLogged): self
    {
        $this->isLogged = $isLogged;

        return $this;
    }
}
