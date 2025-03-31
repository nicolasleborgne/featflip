<?php

namespace App\Infrastructure\Symfony\Repository;

use App\Domain\Clock;
use App\Infrastructure\Symfony\Entity\ResetPasswordRequest;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface;
use SymfonyCasts\Bundle\ResetPassword\Persistence\ResetPasswordRequestRepositoryInterface;

class InMemoryResetPasswordRequestRepository implements ResetPasswordRequestRepositoryInterface
{
    /** @var ResetPasswordRequestInterface[] */
    private array $resetPasswordRequests = [];

    public function getUserIdentifier(object $user): string
    {
        return $user->id();
    }

    public function persistResetPasswordRequest(ResetPasswordRequestInterface $resetPasswordRequest): void
    {
        $this->resetPasswordRequests[] = $resetPasswordRequest;
    }

    public function findResetPasswordRequest(string $selector): ?ResetPasswordRequestInterface
    {
        foreach ($this->resetPasswordRequests as $request) {
            $property = new \ReflectionProperty($request::class, 'selector');
            if ($property->getValue($request) === $selector) {
                return $request;
            }
        }

        return null;
    }

    public function getMostRecentNonExpiredRequestDate(object $user): ?\DateTimeInterface
    {
        usort($this->resetPasswordRequests, function (ResetPasswordRequestInterface $a, ResetPasswordRequestInterface $b) {
            return $b->getRequestedAt() <=> $a->getRequestedAt();
        });

        $mostRecent = $this->resetPasswordRequests[0] ?? null;

        if ($mostRecent?->isExpired()) {
            return null;
        }

        return $mostRecent?->getRequestedAt();
    }

    public function removeResetPasswordRequest(ResetPasswordRequestInterface $resetPasswordRequest): void
    {
        $key = array_search($resetPasswordRequest, $this->resetPasswordRequests, true);
        // @codeCoverageIgnoreStart
        if (!is_int($key)) {
            return;
        }
        // @codeCoverageIgnoreEnd

        unset($this->resetPasswordRequests[$key]);
    }

    public function removeExpiredResetPasswordRequests(): int
    {
        $time = Clock::now('-1 week');
        $toRemove = array_filter($this->resetPasswordRequests, fn (ResetPasswordRequestInterface $r) => $r->getExpiresAt() <= $time);
        foreach ($toRemove as $request) {
            $this->removeResetPasswordRequest($request);
        }

        return count($toRemove);
    }

    public function createResetPasswordRequest(object $user, \DateTimeInterface $expiresAt, string $selector, string $hashedToken): ResetPasswordRequestInterface
    {
        return new ResetPasswordRequest($user, $expiresAt, $selector, $hashedToken);
    }
}
