<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Security;

use App\Domain\User\User as DomainUser;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Symfony\Entity\User;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * @implements UserProviderInterface<User>
 */
class UserRepositoryBasedUserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    /**
     * @return DomainUser
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->userRepository->fromEmail($user->getUserIdentifier());
    }

    public function supportsClass(string $class)
    {
        return User::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->fromEmail($identifier);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new \Exception('Unable to upgrade password on a non supported user class.');
        }

        $user->setPassword($newHashedPassword);
        $this->userRepository->add($user);
    }
}
