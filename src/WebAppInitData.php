<?php

namespace Telegram\Validation;

use Telegram\Validation\Contracts\HMACValidator;
use Telegram\Validation\Concerns\HMACBasedValidation;
use Telegram\Validation\Entities\WebAppInitData as WebAppInitDataEntity;

use function Telegram\Validation\Helpers\assert_query;

class WebAppInitData implements HMACValidator
{
    use HMACBasedValidation;

    public function extract(string|array|Query $query): WebAppInitDataEntity
    {
        $q = assert_query($query);
        return new WebAppInitDataEntity($q->data);
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
        $secretKey = hash_hmac('sha256', $this->token, 'WebAppData', true);
        return bin2hex(hash_hmac('sha256', $data, $secretKey, true));
    }
}
