<?php

namespace Telegram\Validation\Helpers;

use Telegram\Validation\Query;

if (! function_exists('parse_query')) {
    function assert_query(string|array|Query $query): Query
    {
        if ($query instanceof Query) {
            return $query;
        }

        return new Query($query);
    }
}
