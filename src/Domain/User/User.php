<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Common\AbstractEntity;

class User extends AbstractEntity
{
    protected UserId $id;
    protected string $email;

    public function __construct(string $email)
    {
        $this->id = UserId::generate();
        $this->email = $email;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }
}
