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

// Get the current day of the week
$current_day = date("l");

// Get the current UTC time
$utc_time = gmdate("Y-m-d\TH:i:s\Z");

// Get the GitHub file URL of the current script
$github_file_url = "https://github.com/Rotimiiam/stage1/blob/main/index.php";

// Get the GitHub repo URL of the project
$github_repo_url = "https://github.com/Rotimiiam/stage1";

// Return the JSON response with the required information and status code 200
echo json_encode(array(
  "slack_name" => $slack_name,
  "current_day" => $current_day,
  "utc_time" => $utc_time,
  "track" => $track,
  "github_file_url" => $github_file_url,
  "github_repo_url" => $github_repo_url,
  "status_code" => 200
));
?>
