<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Common\RepositoryInterface;
use App\Infrastructure\Symfony\Entity\User;

/**
 *  @extends RepositoryInterface<User, UserId>
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    public function fromEmail(string $email): ?User;
}
