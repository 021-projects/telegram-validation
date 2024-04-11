<?php

namespace Telegram\Validation\Tests;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;
use Telegram\Validation\LoginWidget;

class LoginWidgetTest extends TestCase
{
    private const BOT_TOKEN = '5854973744:AAFnq4HoybEzqCJ-8HYHY_zlvkc_-H-kXq4';

    private const FALLBACK = [
        'auth_date' => 1685117908,
        'first_name' => 'Сергій',
        'hash' => 'e286fe20edabc0f086ba11bad5eead92a67776d01ac97e814ddfb683974d16e9',
        'id' => 1082294585,
        'last_name' => 'Засадинський',
        'photo_url' => 'https://t.me/i/userpic/320/7gMg9ZfoSzMQcLwYiEj4rLAofXXn0wOBV9HXGb6c1T0.jpg',
        'username' => 'CrazyTapokUA'
    ];

    private LoginWidget $validator;

    protected function setUp(): void
    {
        $this->validator = new LoginWidget(self::BOT_TOKEN);
    }

    public function testExtract(): void
    {
        $loginWidgetCallback = $this->validator->extract(self::FALLBACK);

        $fallbackCamelCased = Arr::mapWithKeys(
            self::FALLBACK,
            static function ($value, $key) {
                return [Str::camel($key) => $value];
            }
        );

        $this->assertEquals($fallbackCamelCased, $loginWidgetCallback->toArray());
    }

    public function testValidated(): void
    {
        $result = $this->validator->validate(self::FALLBACK);

        $this->assertTrue($result);
    }

    public function testFailed(): void
    {
        $result = $this->validator->validate([]);

        $this->assertFalse($result);
    }
}
