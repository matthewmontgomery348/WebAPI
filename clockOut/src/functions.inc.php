<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
header("Content-type: application/json"); // Specify JSON content type

date_default_timezone_set('Europe/London'); // Example for London

function getFinishTime($userName)
{
    $finishTime = date("Y-m-d H:i:s"); // Get current date and time

    // Database connection
    $conn = new mysqli("host.docker.internal", "admin", "Pappa1801", "system");

    // Check connection
    if ($conn->connect_error) {
        // Return error as JSON
        //echo json_encode(['success' => false, 'error' => "Connection failed: " . $conn->connect_error]);
        exit();
    }

    // Insert clock-in time into database
    $stmt = $conn->prepare("INSERT INTO attendance (userName, clock_out) VALUES (?, ?)");
    $stmt->bind_param("ss", $userName, $finishTime);

    if ($stmt->execute()) {
        // Return success message as JSON
        //echo json_encode(['success' => true, 'message' => "Clock-in recorded for $userName at $finishTime."]);
    } else {
        // Return error as JSON
        //echo json_encode(['success' => false, 'error' => "Error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
    return $finishTime;
}

if (isset($_GET['userName'])) {
    $userName = $_GET['userName'];
    getFinishTime($userName);
} else {
    //echo json_encode(['success' => false, 'error' => 'No userName provided']);
}
?>
