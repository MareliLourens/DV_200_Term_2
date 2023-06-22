<?php
include "db.php";

// Check if the appointment ID is set
if (isset($_POST['appointment_id'])) {
    $id = $_POST['appointment_id'];

    // Prepare the delete statement
    $deleteSql = "DELETE FROM appointments WHERE id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $id);

    // Execute the delete statement
    if ($deleteStmt->execute()) {
        $deleteStmt->close();
        $conn->close();
        echo 'Appointment deleted successfully';
    } else {
        echo 'Error deleting appointment: ' . $deleteStmt->error;
    }
} else {
    echo 'Invalid appointment ID';
}
?>