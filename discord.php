<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

include ".secret.php";

const API_ENDPOINT = 'https://discord.com/api/v10';
const REDIRECT_URI = 'https://justbetter.fr/discord';

$httpClient = new Client();
function exchange_code($httpClient, $code){
    try {
        $response = $httpClient->request('POST', API_ENDPOINT . '/oauth2/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => REDIRECT_URI
            ],
            'auth' => [DISCORD_CLIENT_ID, DISCORD_CLIENT_SECRET]
        ]);
    } catch (GuzzleException $e) {
        header("Content-Type: application/json");
        echo json_encode(["code" => $e->getCode(), "body" => json_decode($e->getResponse()->getBody()->getContents(), true)]);
        exit(500);
    }
    return json_decode($response->getBody()->getContents(), false)->access_token;
}

function get_user($httpClient, $token)
{
    try {
        $response = $httpClient->request('GET', API_ENDPOINT . '/users/@me', [
            'headers'=> ['Authorization' => "Bearer ". $token]
        ]);
    } catch (GuzzleException $e) {
        header("Content-Type: application/json");
        echo json_encode(["code" => $e->getCode(), "body" => json_decode($e->getResponse()->getBody()->getContents(), true)]);
        exit(500);
    }
    return json_decode($response->getBody()->getContents(), true);
}

$token = exchange_code($httpClient, $_GET['code']);
$user = get_user($httpClient, $token);
?>

<?php if ($user) { ?>
<script>
    const bc = new BroadcastChannel('discord');
    bc.postMessage(<?= json_encode($user) ?>);
    window.close();
</script>
<?php } ?>
