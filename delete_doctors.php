<?php
include "db.php";

// Get the doctor ID from the URL parameter
$id = $_GET['id'];

// Check if any appointments exist for the doctor
$checkAppointmentsSql = "SELECT COUNT(*) as appointment_count FROM appointments WHERE doctor_id = $id";
$result = $conn->query($checkAppointmentsSql);
$row = $result->fetch_assoc();
$appointmentCount = $row['appointment_count'];

if ($appointmentCount > 0) {
    // Delete the appointments associated with the doctor
    $deleteAppointmentsSql = "DELETE FROM appointments WHERE doctor_id = $id";
    $conn->query($deleteAppointmentsSql);
}

// Delete the doctor's record
$deleteDoctorSql = "DELETE FROM doctors WHERE id = $id";
$conn->query($deleteDoctorSql);

$conn->close();

// Redirect to the doctors page
header("location: doctors.php");
?>