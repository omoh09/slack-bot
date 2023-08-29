<?php
// $slack_name = isset($_GET['slack_name']) ? $_GET['slack_name'] : null;
// $track = isset($_GET['track']) ? $_GET['track'] : null;
$slack_name = $argv[1];
$track = $argv[2];
$currentDayOfWeek = date('l');
$currentUTCTime = gmdate('Y-m-d H:i:s');
$githubFileURL = "https://github.com/omoh09/slack-bot/blob/welcome-bot/api/task.php";
$githubSourceURL = "https://github.com/omoh09/slack-bot";

// Prepare the response array
$response = [
    'slack_name' => '@'.$slack_name,
    'current_day' => $currentDayOfWeek,
    'utc_time' => $currentUTCTime,
    'track' => $track,
    'github_file_url' => $githubFileURL,
    'github_repo_url' => $githubSourceURL,
];

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
