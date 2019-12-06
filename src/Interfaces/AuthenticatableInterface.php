<?php

namespace Audentio\LaravelAuth\Interfaces;

interface AuthenticatableInterface
{
    public function isGuest(): bool;

    public function setPasswordAttribute($value): void;
    public function setIsGuest(bool $isGuest = true): void;

    public function findForPassport($identifier): ?AuthenticatableInterface;
    public function verifyPassword($password): bool;
}