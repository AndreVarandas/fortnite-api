# FortniteAPI.com

This is a wrapper for the https://fortniteapi.com/ API.

Fortnite API (get player stats **WITH STATS V2**, leaderboards and more)

You can get user wins, kills, the latest news, fortnite server status and many more with this API.

<img src="./extra/wallpaper.png" width="450px" alt="logo">

## About

This is an *updated* wrapper of [https://github.com/samhoogantink/Fortnite-API](https://github.com/samhoogantink/Fortnite-API).
The API has changed and now most of the endpoints require an access token, so I've made the required changes and added the new
endpoints.

You can see the available endpoints here [https://docs.fortniteapi.com/?version=latest](https://docs.fortniteapi.com/?version=latest)

## Requirements

1. Composer [https://getcomposer.org/](https://getcomposer.org/)
2. Authorization key. You can get one for free at [https://console.fortniteapi.com/](https://console.fortniteapi.com/).

## Install

Install with composer using: `composer require varandas/fortnite-api:v0.1.1-beta && composer dump-autoload --optimize`

## Usage

```php
<?php

// Require autoload
require __DIR__ . '/vendor/autoload.php';

use Varandas\FortniteApi\FortniteClient;

// Get an instance of FortniteClient
$api = new FortniteClient();
$api->setKey("your api key");

/** ITEMS API **/

// Get the daily store
$data = $api->items->store();

// Get upcoming items
$data = $api->items->upcoming();

// List items
$data = $api->items->list();

// Get a random item
$data = $api->items->random();

// Get a popular item
$data = $api->items->popular();

// Get detailed data for an item
$data = $api->items->data('8403b27-7c9f125-ef5487b-552aeab');

// Search for an item
$data = $api->items->search('item name');

var_dump($data);

/** CHALLENGES **/

// Get season 3 challenges
$data = $api->challenges->get("season 3");

// Get current season challenges
$data = $api->challenges->get();

var_dump($data);

/** USERS **/

// First find a user:
$data = $api->user->id('ninja');

// After that we can query for user stats
$stats = $api->user->stats();

// If you want to query for old v1 stats:
$stats = $api->user->v1Stats();

/** WEAPONS **/

// List all current weapons:
$data = $api->weapons->get();

```

## Disclaimer

Portions of the materials used are trademarks and/or copyrighted works of Epic Games, Inc. All rights reserved by Epic. 
This material is not official and is not endorsed by Epic.
