<?php

namespace Telegram\Validation\Entities;

use O21\ApiEntity\BaseEntity;

/**
 * @property-read string|null $queryId
 * @property-read \Telegram\Validation\Entities\WebAppUser|null $user
 * @property-read \Telegram\Validation\Entities\WebAppUser|null $receiver
 * @property-read \Telegram\Validation\Entities\WebAppChat|null $chat
 * @property-read string|null $chatType
 * @property-read string|null $chatInstance
 * @property-read string|null $startParam
 * @property-read int|null $canSendAfter
 * @property-read \Carbon\CarbonInterface $authDate
 * @property-read string $hash
 */
class WebAppInitData extends BaseEntity
{
    protected array $casts = [
        'user' => WebAppUser::class,
        'receiver' => WebAppUser::class,
        'chat' => WebAppChat::class,
        'authDate' => 'datetime',
    ];
}
