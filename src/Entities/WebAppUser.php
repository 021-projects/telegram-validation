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
 * @property-read string|null $languageCode
 * @property-read bool $isPremium
 * @property-read bool $addedToAttachmentMenu
 * @property-read bool $allowsWriteToPm
 * @property-read string|null $photoUrl
 */
class WebAppUser extends BaseEntity
{
    protected array $casts = [
        'addedToAttachmentMenu' => 'bool',
        'allowsWriteToPm' => 'bool',
        'isBot' => 'bool',
        'isPremium' => 'bool',
    ];
}
