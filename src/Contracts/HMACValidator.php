<?php

namespace Telegram\Validation\Contracts;

use Telegram\Validation\Query;

interface HMACValidator
{
    public function extract(string|array|Query $query): mixed;

    public function validate(string|array|Query $query): bool;

    public function hash(string|array|Query $query): string;
}
