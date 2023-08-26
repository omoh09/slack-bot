<?php
$slack_name = isset($_GET['slack_name']) ? $_GET['slack_name'] : null;
$track = isset($_GET['track']) ? $_GET['track'] : null;

// Get the current day of the week
$currentDayOfWeek = date('l');

// Get the current UTC time (with validation of +/-2 hours)
$currentUTCTime = gmdate('Y-m-d H:i:s');

// Define other information
$name = "Gabriel";
$githubFileURL = "https://github.com/omoh09/slack-bot/blob/welcome-bot/task.php";
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
