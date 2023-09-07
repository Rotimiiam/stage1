<?php
header('Content-Type: application/json');

function get_current_utc_time() {
    $current_time = new DateTime('now', new DateTimeZone('UTC'));
    $target_time = new DateTime('now', new DateTimeZone('UTC'));
    $target_time->modify('-1 minutes');
    
    if ($current_time <= $target_time) {
        return $current_time->format('Y-m-d\TH:i:s\Z');
    } else {
        http_response_code(400);
        return json_encode(array("error" => "Validation Error: Current time not within +/-2 minutes of UTC."));
    }
}

$slack_name = isset($_GET['slack_name']) ? $_GET['slack_name'] : null;
$track = isset($_GET['track']) ? $_GET['track'] : null;

if ($slack_name && $track) {
    $current_day = date('l');
    $utc_time = get_current_utc_time();
    $github_file_url = "https://github.com/username/repo/blob/main/file_name.ext"; // Replace with your GitHub file URL
    $github_repo_url = "https://github.com/username/repo"; // Replace with your GitHub repo URL

    $response_data = array(
        "slack_name" => $slack_name,
        "current_day" => $current_day,
        "utc_time" => $utc_time,
        "track" => $track,
        "github_file_url" => $github_file_url,
        "github_repo_url" => $github_repo_url,
        "status_code" => 200
    );

    echo json_encode($response_data);
} else {
    http_response_code(400);
    echo json_encode(array("error" => "Missing parameters"));
}
?>
