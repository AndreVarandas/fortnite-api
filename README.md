# FortniteAPI.com
Fortnite API (get player stats **WITH STATS V2**, leaderboards and more)

Hi,

You can get user wins, kills, the latest news, fortnite server status and many more with this API.

It's easy to install, just put the fortnite-api/Autoloader.php in your directory and define the class. After that visit my documentation (https://fortniteapi.com/docs (only php) or https://goo.gl/XC6u9S (all frameworks)) and follow the steps.

Have fun!

Sam
https://fortniteapi.com/


# Examples

1. Get an user id
```
<?php
require_once 'fortnite-api/Autoloader.php';

$api = new FortniteClient;

$data = $api->user->id('username');

echo $data->uid;
echo $data->username;
?>
```

2. Get user stats **V2**
```
<?php
require_once 'fortnite-api/Autoloader.php';

$api = new FortniteClient;

$api->user->uid = 'user_id';

$data = $api->user->stats('console', 'window');

var_dump($data);
?>
```

3. Get the daily store
```
<?php
require_once 'fortnite-api/Autoloader.php';

$api = new FortniteClient;

$data = $api->items->store();

var_dump($data);
?>

```

4. Fortnite server status
```
<?php
require_once 'fortnite-api/Autoloader.php';

$api = new FortniteClient;

$data = $api->status->fetch();

echo $data->status;
echo $data->message;
echo $data->version;
?>
```
