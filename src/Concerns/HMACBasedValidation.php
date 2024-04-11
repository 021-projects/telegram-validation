<?php

namespace Telegram\Validation\Concerns;

trait HMACBasedValidation
{
    public function __construct(
        protected readonly string $token,
    ) {
    }

    protected function hashEquals(string $hash1, string $hash2): bool
    {
        return strcmp($hash1, $hash2) === 0;
    }
}
