<?php

namespace App\Infrastructure\Symfony\Entity;

use App\Domain\Clock;
use Ramsey\Uuid\Uuid;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestTrait;

class ResetPasswordRequest implements ResetPasswordRequestInterface
{
    use ResetPasswordRequestTrait;

    private ?string $id = null;

    private ?User $user = null;

    public function __construct(object $user, \DateTimeInterface $expiresAt, string $selector, string $hashedToken)
    {
        $this->id = Uuid::uuid4();
        $this->user = $user;
        $this->initialize($expiresAt, $selector, $hashedToken);
    }

    //    public function getId(): ?int
    //    {
    //        return $this->id;
    //    }

    public function getUser(): object
    {
        return $this->user;
    }

    protected function initialize(\DateTimeInterface $expiresAt, string $selector, string $hashedToken): void
    {
        $this->requestedAt = Clock::now();
        $this->expiresAt = $expiresAt;
        $this->selector = $selector;
        $this->hashedToken = $hashedToken;
    }

    public function isExpired(): bool
    {
        return $this->expiresAt <= Clock::now();
    }
}
