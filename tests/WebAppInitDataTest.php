<?php

namespace Telegram\Validation\Tests;

use PHPUnit\Framework\TestCase;
use Telegram\Validation\WebAppInitData;

class WebAppInitDataTest extends TestCase
{
    public const BOT_TOKEN = '5854973744:AAFnq4HoybEzqCJ-8HYHY_zlvkc_-H-kXq4';

    public const FALLBACK = 'query_id=AAE5gYJAAAAAADmBgkD7IagW&user=%7B%22id%22%3A1082294585%2C%22first_name%22%3A%22%D0%A1%D0%B5%D1%80%D0%B3%D1%96%D0%B9%22%2C%22last_name%22%3A%22%D0%97%D0%B0%D1%81%D0%B0%D0%B4%D0%B8%D0%BD%D1%81%D1%8C%D0%BA%D0%B8%D0%B9%22%2C%22username%22%3A%22CrazyTapokUA%22%2C%22language_code%22%3A%22uk%22%7D&auth_date=1684086610&hash=f0f336451c74fc794e2b0b9fcaf3e27e16ca74afbfd0958a8d21efd9e8e2b53c';

    public const FALLBACK_ARR = [
        'queryId'  => 'AAE5gYJAAAAAADmBgkD7IagW',
        'user'     => '{"id":1082294585,"first_name":"Сергій","last_name":"Засадинський","username":"CrazyTapokUA","language_code":"uk"}',
        'authDate' => 1684086610,
        'hash'     => 'f0f336451c74fc794e2b0b9fcaf3e27e16ca74afbfd0958a8d21efd9e8e2b53c'
    ];

    private WebAppInitData $validator;

    protected function setUp(): void
    {
        $this->validator = new WebAppInitData(self::BOT_TOKEN);
    }

    public function testExtract(): void
    {
        $initData = $this->validator->extract(self::FALLBACK);

        $this->assertEquals(self::FALLBACK_ARR, $initData->toArray());
    }

    public function testValidated(): void
    {
        $result = $this->validator->validate(self::FALLBACK);

        $this->assertTrue($result);
    }

    public function testFailed(): void
    {
        $result = $this->validator->validate(self::FALLBACK.'1');

        $this->assertFalse($result);
    }
}
