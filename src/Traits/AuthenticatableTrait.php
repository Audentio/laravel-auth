<?php

namespace Audentio\LaravelAuth\Traits;

use Audentio\LaravelAuth\Interfaces\AuthenticatableInterface;
use Illuminate\Support\Facades\Hash;

trait AuthenticatableTrait
{
    protected $isGuest = false;

    public function isGuest(): bool
    {
        return $this->isGuest;
    }

    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setIsGuest(bool $isGuest = true): void
    {
        $this->isGuest = $isGuest;
    }

    public function findForPassport($identifier): ?AuthenticatableInterface
    {
        foreach ($this->getAuthenticationIdentifierFields() as $key) {
            $this->orWhere($key, $identifier);
        }

        return $this->first();
    }

    public function verifyPassword(string $password)
    {
        return Hash::check($password, $this->getPasswordHashValue());
    }

    protected function getAuthenticationIdentifierFields(): array
    {
        return ['email', 'name'];
    }

    protected function getPasswordHashValue(): string
    {
        return $this->password;
    }
}