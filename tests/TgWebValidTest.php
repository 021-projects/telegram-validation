<?php

namespace TelegramWebApp\Validation\Tests;

use PHPUnit\Framework\TestCase;
use TelegramWebApp\Validation\Bot;
use TelegramWebApp\Validation\Exceptions\BotException;
use TelegramWebApp\Validation\TgWebValid;

class TgWebValidTest extends TestCase
{
    protected TgWebValid $manager;

    public function setUp(): void
    {
        $this->manager = new TgWebValid('DEFAULT_BOT_TOKEN');
        $this->manager->addBot('next', 'NEXT_BOT_TOKEN');
        $this->manager->addBot('other', 'OTHER_BOT_TOKEN');
    }

    public function testWithoutName(): void
    {
        $bot = $this->manager->bot();
        $this->assertInstanceOf(Bot::class, $bot);
    }

    public function testWithName(): void
    {
        $bot = $this->manager->bot('next');
        $this->assertInstanceOf(Bot::class, $bot);
    }

    public function testWithNameNotFound(): void
    {
        $this->expectException(BotException::class);
        $this->manager->bot('any');
    }
}
