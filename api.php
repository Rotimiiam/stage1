<?php
// Get the slack_name and track parameters from the GET request
$slack_name = $_GET["slack_name"];
$track = $_GET["track"];

// Validate the parameters
if (empty($slack_name) || empty($track)) {
  // Return an error message and status code 400 if any parameter is missing
  echo json_encode(array(
    "error_message" => "Please provide both slack name and track parameters",
    "status_code" => 400
  ));
  exit();
}

// Get the current UTC time in the correct format
$current_utc_time = gmdate("Y-m-d\TH:i:s\Z");

// Calculate UTC time 2 minutes ago and 2 minutes in the future
$valid_utc_time_min = gmdate("Y-m-d\TH:i:s\Z", strtotime("-2 minutes"));
$valid_utc_time_max = gmdate("Y-m-d\TH:i:s\Z", strtotime("+2 minutes"));

// Check if the current UTC time is within the valid range
if ($current_utc_time < $valid_utc_time_min || $current_utc_time > $valid_utc_time_max) {
  // Return an error message and status code 400 if the time is outside the range
  echo json_encode(array(
    "error_message" => "Validation Error: Current time not within +/-2 minutes of UTC.",
    "status_code" => 400
  ));
  exit();
}

// Get the current day of the week
$current_day = date("l");

// Get the GitHub file URL of the current script
$github_file_url = "https://github.com/Rotimiiam/stage1/blob/main/api.php";

// Get the GitHub repo URL of the project
$github_repo_url = "https://github.com/Rotimiiam/stage1";

// Return the JSON response with the required information in the correct format
echo json_encode(array(
  "slack_name" => $slack_name,
  "current_day" => $current_day,
  "utc_time" => $current_utc_time,
  "track" => $track,
  "github_file_url" => $github_file_url,
  "github_repo_url" => $github_repo_url,
  "status_code" => "200" // Status code as a string in the correct format
));
?>
