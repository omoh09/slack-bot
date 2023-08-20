<?php

require 'vendor/autoload.php';

use Maknz\Slack\Client;

$token = env('YOUR_OAUTH_TOKEN');

$slack = new Client($token);

// Listen for a user joining the workspace
if ($_POST['type'] == 'url_verification') {

  echo $_POST['challenge'];

} else if ($_POST['event']['type'] == 'team_join') {

  $userId = $_POST['event']['user']['id'];

  $slack->to('@' . $userId)->send('You are welcomesto HNGx, i will be your buddy thriught out the intership ');
}
?>
