# FortniteAPI.com

This is a wrapper for the https://fortniteapi.com/ API.
   
<img src="./extra/wallpaper.png" width="450px" alt="logo">

## About

This is an *updated* wrapper of [https://github.com/samhoogantink/Fortnite-API](https://github.com/samhoogantink/Fortnite-API).
The API has changed and now most of the endpoints require an access token, so I've made the required changes and added the new
endpoints.

You can see the available endpoints here [https://docs.fortniteapi.com/?version=latest](https://docs.fortniteapi.com/?version=latest)

## Requirements

1. Authorization key. You can get one for free at [https://console.fortniteapi.com/](https://console.fortniteapi.com/).

## Install

Install with composer using: `composer require varandas/fortnite-api`

## Usage

```php
<?php

use Varandas\FortniteApi\FortniteClient;

// Get an instance of FortniteClient
$api = new FortniteClient();
$api->setKey("your api key");

// Get items currently available in the store
$data = $api->items->store();

var_dump($data);
```

## Original readme

Fortnite API (get player stats **WITH STATS V2**, leaderboards and more)

You can get user wins, kills, the latest news, fortnite server status and many more with this API.

Have fun!

Sam
https://fortniteapi.com/

# Examples

1. Get an user id
```php
<?php
require_once 'fortnite-api/Autoloader.php';

$api = new FortniteClient;

$data = $api->user->id('username');

echo $data->uid;
echo $data->username;
```

2. Get user stats **V2**
```php
<?php
require_once 'fortnite-api/Autoloader.php';

$api = new FortniteClient;

$api->user->uid = 'user_id';

$data = $api->user->stats('console', 'window');

var_dump($data);
```

3. Get the daily store
```php
<?php
require_once 'fortnite-api/Autoloader.php';

$api = new FortniteClient;

$data = $api->items->store();

var_dump($data);
```

4. Fortnite server status
```php
<?php
require_once 'fortnite-api/Autoloader.php';

$api = new FortniteClient;

$data = $api->status->fetch();

echo $data->status;
echo $data->message;
echo $data->version;
```

## Disclaimer

Portions of the materials used are trademarks and/or copyrighted works of Epic Games, Inc. All rights reserved by Epic. 
This material is not official and is not endorsed by Epic.
