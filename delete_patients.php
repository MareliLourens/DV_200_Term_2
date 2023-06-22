<?php
include "db.php";

// Get the patient ID from the URL parameter
$id = $_GET['id'];

// Check if any appointments exist for the patient
$checkAppointmentsSql = "SELECT COUNT(*) as appointment_count FROM appointments WHERE patient_id = $id";
$result = $conn->query($checkAppointmentsSql);
$row = $result->fetch_assoc();
$appointmentCount = $row['appointment_count'];

// If appointments exist for the patient, delete them
if ($appointmentCount > 0) {
    $deleteAppointmentsSql = "DELETE FROM appointments WHERE patient_id = $id";
    $conn->query($deleteAppointmentsSql);
}

// Delete the patient record
$deletePatientSql = "DELETE FROM patients WHERE id = $id";
$conn->query($deletePatientSql);

// Close the database connection
$conn->close();

// Redirect to the patients.php page
header("location: patients.php");
?>