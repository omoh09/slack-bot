<?php
header("Content-Type: application/json");

// Function to validate UTC offset
function validateUTCOffset($offset) {
    return preg_match('/^(\+|-)(0[0-9]|1[0-4])$/', $offset);
}

// Function to get the GitHub URL of the current file
function getGitHubURL() {
    $repoURL = "https://github.com/YourUsername/YourRepository"; 
    $filePath = $_SERVER["SCRIPT_NAME"];
    return "$repoURL/blob/main$filePath";
}

// Function to get the GitHub URL of the full source code
function getFullSourceCodeURL() {
    $repoURL = "https://github.com/YourUsername/YourRepository";
    return "$repoURL";
}

// Check if 'name' and 'utc_offset' parameters are provided in the GET request
if (isset($_GET['name']) && isset($_GET['utc_offset'])) {
    $name = $_GET['name'];
    $utcOffset = $_GET['utc_offset'];

    // Validate UTC offset
    if (validateUTCOffset($utcOffset)) {
        $dayOfWeek = date("l");
        $currentTime = gmdate("H:i:s");
        $currentUTCOffset = gmdate("O");

        // Calculate the UTC time based on the provided offset
        $offsetSign = substr($utcOffset, 0, 1);
        $offsetHours = substr($utcOffset, 1, 2);
        $offsetMinutes = "00"; // UTC offset is in hours and minutes (e.g., +05:30)
        $offsetSeconds = "00"; // Seconds are set to zero
        $offset = $offsetSign . $offsetHours . $offsetMinutes . $offsetSeconds;
        $utcTime = gmdate("H:i:s", strtotime("$offset hours"));

        // Create the response array
        $response = [
            "name" => $name,
            "day_of_week" => $dayOfWeek,
            "utc_time" => $utcTime,
            "track" => "YourTrack", // Replace with your track information
            "github_url_current_file" => getGitHubURL(),
            "github_url_full_source_code" => getFullSourceCodeURL(),
        ];

        // Return the response as JSON
        echo json_encode($response);
    } else {
        // Invalid UTC offset
        echo json_encode(["error" => "Invalid UTC offset"]);
    }
} else {
    // Missing parameters
    echo json_encode(["error" => "Missing 'name' and/or 'utc_offset' parameters"]);
}
