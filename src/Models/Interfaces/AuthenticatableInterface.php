<?php

namespace Audentio\LaravelAuth\Models\Interfaces;

interface AuthenticatableInterface
{
    public function isGuest(): bool;

    public function setPasswordAttribute(string $value): void;
    public function setIsGuest(bool $isGuest = true): void;

    public function findForPassport(string $identifier): ?AuthenticatableInterface;
    public function verifyPassword(string $password): bool;
}