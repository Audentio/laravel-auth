<?php

namespace Audentio\LaravelAuth\Models\Interfaces;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

interface AuthenticatableInterface extends AuthenticatableContract, AuthorizableContract
{
    public function isGuest(): bool;

    public function setPasswordAttribute(string $value): void;
    public function setIsGuest(bool $isGuest = true): void;

    public function findForPassport(string $identifier): ?AuthenticatableInterface;
    public function verifyPassword(string $password): bool;
}