<?php

namespace Telegram\Validation;

use Telegram\Validation\Contracts\HMACValidator;
use Telegram\Validation\Concerns\HMACBasedValidation;
use Telegram\Validation\Entities\LoginWidgetCallback;

use function Telegram\Validation\Helpers\assert_query;

class LoginWidget implements HMACValidator
{
    use HMACBasedValidation;

    public function extract(string|array|Query $query): LoginWidgetCallback
    {
        $q = assert_query($query);
        return new LoginWidgetCallback($q->data);
    }

    public function validate(string|array|Query $query): bool
    {
        $q = assert_query($query);
        return $this->hashEquals(
            $this->hash($q),
            $q->get('hash', '')
        );
    }

    public function hash(string|array|Query $query): string
    {
        $q = assert_query($query);
        $data = $q->pack(ridHash: true);
        $secretKey = hash('sha256', $this->token, true);
        return hash_hmac('sha256', $data, $secretKey);
    }
}
