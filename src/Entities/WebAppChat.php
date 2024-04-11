<?php

namespace Telegram\Validation\Entities;

use O21\ApiEntity\BaseEntity;

/**
 * @link https://core.telegram.org/bots/webapps#webappchat
 *
 * @property-read int $id
 * @property-read string $type
 * @property-read string $title
 * @property-read string|null $username
 * @property-read string|null $photoUrl
 */
class WebAppChat extends BaseEntity
{
}
