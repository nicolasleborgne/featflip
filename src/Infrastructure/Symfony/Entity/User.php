<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Entity;

use App\Domain\User\User as DomainUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User extends DomainUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    /** @var string[] */
    private array $roles;
    private ?string $password;

    private bool $isVerified;

    public function __construct(string $email)
    {
        parent::__construct($email);
        $this->isVerified = false;
        $this->roles = ['ROLE_USER'];
        $this->password = null;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $encodedPassword): void
    {
        $this->password = $encodedPassword;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
