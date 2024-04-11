<?php

namespace TelegramWebApp\Validation;

class BotConfig
{
    public function __construct(
        public readonly string $name,
        public readonly string $token
    )
    {
    }
}
