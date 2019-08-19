```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use AuthManager\OpenIDManager;
use GuzzleHttp\Exception\GuzzleException;
use SteamAPI\ISteamUser;

$apiKey = 'our api key';

$am = new OpenIDManager('https://steamcommunity.com/openid/login', 'https://our.domain/this/script');

if (!empty($_GET['openid_mode']) && $_GET['openid_mode'] == 'id_res') {

    try {
        $id = $am->getID($_SERVER['REQUEST_URI']);
        if (!$id) {
            exit('Unauthorized');
        }
        print_r($id . "\n");

        $c = new ISteamUser($apiKey);
        print_r($c->getPlayerSummaries($id));

    } catch (GuzzleException $e) {
        exit($e->getMessage());
    }

} else {
    $am->signin();
}
```