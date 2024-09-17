# 021/telegram-validation
[![Testing Status](https://github.com/021-projects/telegram-validation/workflows/PHP%20CI/badge.svg)](https://github.com/021-projects/telegram-validation/actions)
[![Minimum PHP Version](https://img.shields.io/packagist/dependency-v/021/telegram-validation/php)](https://packagist.org/packages/021/telegram-validation)
[![Latest version](https://img.shields.io/packagist/v/021/telegram-validation)](https://packagist.org/packages/021/telegram-validation)
[![License](https://img.shields.io/packagist/l/021/telegram-validation)](https://packagist.org/packages/021/telegram-validation)

This library helps verify callbacks from Telegram.

## Installation
Install via [Composer](https://getcomposer.org/):
```bash
composer require 021/telegram-validation
```

## Using

### Validation

#### Web App Init Data

Mechanism: [Validating data received via the Mini App](https://core.telegram.org/bots/webapps#validating-data-received-via-the-mini-app)

```php
$token = 7260447433:AAFrm0Fp1KkMJP_0Kfr4sPPYSa7D6yUjLAM
// Short with helper function
use function Telegram\Validation\Helpers\validate_wa_init_data;

$isValid = validate_wa_init_data('query_id=...', $token);

// Expanded with class
use Telegram\Validation\WebAppInitData;

$validator = new WebAppInitData($token);
$isValid = $validator->validate('query_id=...');
```

#### Login Widget

Mechanism: [Checking authorization](https://core.telegram.org/widgets/login#checking-authorization)

```php
$token = 7260447433:AAFrm0Fp1KkMJP_0Kfr4sPPYSa7D6yUjLAM
$input = ['auth_date' => 666, /*...*/]; // request input

// Short with helper function
use function Telegram\Validation\Helpers\validate_login_widget;

$isValid = validate_login_widget($input, $token);

// Expanded with class
use Telegram\Validation\LoginWidget;

$validator = new LoginWidget($token);
$isValid = $validator->validate($input);
```

### Parsing
021/telegram-validation also provides classes to parse the data to objects.

#### Web App Init Data

```php
$token = 7260447433:AAFrm0Fp1KkMJP_0Kfr4sPPYSa7D6yUjLAM
/** 
 * @link https://core.telegram.org/bots/webapps#webappinitdata
 * @var \Telegram\Validation\Entities\WebAppInitData $webAppInitData 
 */
$webAppInitData;

// Short with helper function
use function Telegram\Validation\Helpers\parse_wa_init_data;

$webAppInitData = parse_wa_init_data('query_id=...', $token);

// Expanded with class
use Telegram\Validation\WebAppInitData;

$validator = new WebAppInitData($token);
$webAppInitData = $validator->extract('query_id=...');

// Accessing fields
echo $webAppInitData->queryId; // query_id
echo $webAppInitData->chat->username; // chat.username
echo $webAppInitData->chatType; // chat_type
// ... any other fields
```

#### Login Widget

```php
$token = 'YOUR_BOT_TOKEN';
$input = ['auth_date' => 666, /*...*/]; // request input 
/** 
 * @link https://core.telegram.org/widgets/login#receiving-authorization-data
 * @var \Telegram\Validation\Entities\LoginWidgetCallback $loginWidget 
 */
$loginWidget;

// Short with helper function
use function Telegram\Validation\Helpers\parse_login_widget;
$loginWidget = parse_login_widget($input, $token);

// Expanded with class
use Telegram\Validation\LoginWidget;

$validator = new LoginWidget($token);
$loginWidget = $validator->extract($input);

// Accessing fields
echo $loginWidget->firstName; // first_name
echo $loginWidget->lastName; // last_name
/** @var \Carbon\CarbonInterface $carbon */
$carbon = $loginWidget->authDate; // auth_date
```

## Security
If you discover a security vulnerability in 021/telegram-validation, please [create an issue](https://github.com/021-projects/telegram-validation/issues) with a detailed description. All security vulnerabilities will be fixed immediately. [Pull requests](https://github.com/021-projects/telegram-validation/fork) are also welcome.

## Assistance
We will be glad if you join the development and improvement of the project. You can [create an issue](https://github.com/021-projects/telegram-validation/issues) and/or a [pull request](https://github.com/021-projects/telegram-validation/fork).

## License
021/telegram-validation - is open source software available under the [MIT](LICENSE). See the [license file](LICENSE) for more information.
