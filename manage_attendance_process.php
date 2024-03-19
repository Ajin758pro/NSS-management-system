<?php
// Include database connection code here
require_once "database.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve event ID from the form
    $event_id = $_POST['event_id'];

    // Retrieve volunteer statuses from the form
    $statuses = $_POST['status'];

    // Loop through each volunteer status
    foreach ($statuses as $key => $status) {
        // Retrieve volunteer ID based on the index
        $volunteer_id = $key + 1; // Assuming volunteer IDs start from 1 and are sequential

        // Insert the data into the attendance table
        $sql = "INSERT INTO attendance (event_id, volunteer_id, status) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $event_id, $volunteer_id, $status);
        $stmt->execute();
    }

    // Close prepared statement
    $stmt->close();

    // Redirect to a success page or display a success message
    header("Location:manage_attendance.php");
    exit();
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: manage_attendance.php");
    exit();
}
?>
