<?php

namespace Telegram\Validation\Entities;

use O21\ApiEntity\BaseEntity;

/**
 * @link https://core.telegram.org/bots/webapps#webappuser
 *
 * @property-read int $id
 * @property-read bool $isBot
 * @property-read string $firstName
 * @property-read string|null $lastName
 * @property-read string|null $username
 * @property-read bool $isPremium
 * @property-read string|null $photoUrl
 */
class WebAppReceiver extends BaseEntity
{
    protected array $casts = [
        'isBot' => 'bool',
        'isPremium' => 'bool',
    ];
}
