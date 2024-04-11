<?php

namespace Telegram\Validation\Tests;

use PHPUnit\Framework\TestCase;

use function Telegram\Validation\Helpers\assert_query;

class HelpersTest extends TestCase
{
    private const QUERY_STR = 'auth_date=1620000000&first_name=John&hash=hash&id=1234567890&last_name=Doe&photo_url=https%3A%2F%2Ft.me%2Fi%2Fuserpic%2F320%2Fhash.jpg&username=johndoe';

    private const QUERY_ARR = [
        'auth_date' => '1620000000',
        'first_name' => 'John',
        'hash' => 'hash',
        'id' => '1234567890',
        'last_name' => 'Doe',
        'photo_url' => 'https://t.me/i/userpic/320/hash.jpg',
        'username' => 'johndoe',
    ];

    public function testAssertQuery(): void
    {
        $this->assertEquals(self::QUERY_ARR, assert_query(self::QUERY_STR)->data);
        $this->assertEquals(self::QUERY_ARR, assert_query(http_build_query(self::QUERY_ARR))->data);
        $this->assertEquals(self::QUERY_ARR, assert_query(self::QUERY_ARR)->data);
    }
}
