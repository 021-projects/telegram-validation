# telegram/validation
[![Testing Status](https://github.com/021-projects/telegram-validation/workflows/PHP%20CI/badge.svg)](https://github.com/021-projects/telegram-validation/actions)
[![Minimum PHP Version](https://img.shields.io/packagist/dependency-v/telegram/validation/php)](https://packagist.org/packages/telegram/validation)
[![Latest version](https://img.shields.io/packagist/v/telegram/validation)](https://packagist.org/packages/telegram/validation)
[![License](https://img.shields.io/packagist/l/telegram/validation)](https://packagist.org/packages/telegram/validation)

This library helps verify callbacks from Telegram.

## Installation
Install via [Composer](https://getcomposer.org/):
```bash
composer require telegram/validation
```

## Using

### Validation

#### Web App Init Data

Mechanism: [Validating data received via the Mini App](https://core.telegram.org/bots/webapps#validating-data-received-via-the-mini-app)

```php
use Telegram\Validation\WebAppInitData;

$token = 'YOUR_BOT_TOKEN';
$validator = new WebAppInitData($token);

$isValid = $validator->validate('query_id=...');
```

#### Login Widget

Mechanism: [Checking authorization](https://core.telegram.org/widgets/login#checking-authorization)

```php
use Telegram\Validation\LoginWidget;

$token = 'YOUR_BOT_TOKEN';
$validator = new LoginWidget($token);

$isValid = $validator->validate([
    // request input
]);
```

### Extraction
telegram/validation also provides classes to parse the data to objects.

#### Web App Init Data

```php
use Telegram\Validation\WebAppInitData;

$token = 'YOUR_BOT_TOKEN';
$validator = new WebAppInitData($token);

/** 
 * @link https://core.telegram.org/bots/webapps#webappinitdata
 * @var \Telegram\Validation\Entities\WebAppInitData $webAppInitData 
 */
$webAppInitData = $validator->extract('query_id=...');

echo $webAppInitData->queryId; // query_id
echo $webAppInitData->chat->username; // chat.username
echo $webAppInitData->chatType; // chat_type
// ... any other fields
```

#### Login Widget

```php
use Telegram\Validation\LoginWidget;

$token = 'YOUR_BOT_TOKEN';
$validator = new LoginWidget($token);

/** 
 * @link https://core.telegram.org/widgets/login#receiving-authorization-data
 * @var \Telegram\Validation\Entities\LoginWidgetCallback $loginWidget 
 */
$loginWidget = $validator->extract(
    // request input in array or string format
);

echo $loginWidget->firstName; // first_name
echo $loginWidget->lastName; // last_name
/** @var \Carbon\CarbonInterface $carbon */
$carbon = $loginWidget->authDate; // auth_date
```

## Security
If you discover a security vulnerability in telegram/validation, please [create an issue](https://github.com/021-projects/telegram-validation/issues) with a detailed description. All security vulnerabilities will be fixed immediately. [Pull requests](https://github.com/021-projects/telegram-validation/fork) are also welcome.

## Assistance
We will be glad if you join the development and improvement of the project. You can [create an issue](https://github.com/021-projects/telegram-validation/issues) and/or a [pull request](https://github.com/021-projects/telegram-validation/fork)

## License
telegram/validation - is open source software available under the [MIT](LICENSE). See the [license file](LICENSE) for more information.
