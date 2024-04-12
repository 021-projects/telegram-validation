<?php

namespace Telegram\Validation\Helpers;

use Telegram\Validation\Entities\LoginWidgetCallback;
use Telegram\Validation\Entities\WebAppInitData as WebAppInitDataEntity;
use Telegram\Validation\LoginWidget;
use Telegram\Validation\WebAppInitData;
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

if (! function_exists('validate_login_widget')) {
    function validate_login_widget(string|array|Query $query, string $token): bool
    {
        return (new LoginWidget($token))
            ->validate($query);
    }
}

if (! function_exists('validate_wa_init_data')) {
    function validate_wa_init_data(string|array|Query $query, string $token): bool
    {
        return (new WebAppInitData($token))
            ->validate($query);
    }
}

if (! function_exists('parse_login_widget')) {
    function parse_login_widget(
        string|array|Query $query,
        string $token
    ): LoginWidgetCallback {
        return (new LoginWidget($token))
            ->extract($query);
    }
}

if (! function_exists('parse_wa_init_data')) {
    function parse_wa_init_data(
        string|array|Query $query,
        string $token
    ): WebAppInitDataEntity {
        return (new WebAppInitData($token))
            ->extract($query);
    }
}
