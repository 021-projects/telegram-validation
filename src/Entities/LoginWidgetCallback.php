<?php

namespace Telegram\Validation\Entities;

use O21\ApiEntity\BaseEntity;

/**
 * @property-read int $id
 * @property-read string $firstName
 * @property-read string|null $lastName
 * @property-read string|null $username
 * @property-read string|null $photoUrl
 * @property-read \Carbon\CarbonInterface $authDate
 * @property-read string $hash
 */
class LoginWidgetCallback extends BaseEntity
{
   protected array $casts = [
       'authDate' => 'datetime',
   ];
}
