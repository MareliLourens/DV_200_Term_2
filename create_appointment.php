<?php
session_start();

include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve receptionist ID from session
    $receptionistId = $_SESSION['id'];

    // Retrieve the latest doctor ID
    $latestDoctorSql = "SELECT id FROM doctors ORDER BY id DESC LIMIT 1";
    $latestDoctorResult = $conn->query($latestDoctorSql);
    $latestDoctorRow = $latestDoctorResult->fetch_assoc();
    $doctorId = $latestDoctorRow['id'];

    echo "New doctor";
    echo "ID" . $doctorId;

    // Retrieve the latest patient ID
    $latestPatientsSql = "SELECT id FROM patients ORDER BY id DESC LIMIT 1";
    $latestPatientsResult = $conn->query($latestPatientsSql);
    $latestPatientsRow = $latestPatientsResult->fetch_assoc();
    $patientId = $latestPatientsRow['id'];

    echo "New Patient";
    echo "ID" . $patientId;

    // Handle appointment form submission
    $appointmentDate = isset($_POST["date"]) ? $_POST["date"] : '';
    $appointmentTime = isset($_POST["time"]) ? $_POST["time"] : '';

    if ($appointmentDate === '' || $appointmentTime === '' || $doctorId === '' || $patientId === '' || $receptionistId === '') {
        echo "Error: Please fill in all the required fields.";
        exit();
    }

    // Insert the new appointment record
    // Perform the necessary database insert operation here with the values from the form
    // Replace the following line with your actual database insert code

    // Example code using mysqli
    $insertSql = "INSERT INTO appointments (date, time, doctor_id, patient_id, receptionist_id) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("ssiii", $appointmentDate, $appointmentTime, $doctorId, $patientId, $receptionistId);

    if ($insertStmt->execute()) {
        echo "New appointment created successfully.";
    } else {
        echo "Error: " . $insertStmt->error;
    }

    $conn->close();

    // Retrieve the latest doctor ID again
    $latestDoctorSql = "SELECT id FROM doctors ORDER BY id DESC LIMIT 1";
    $latestDoctorResult = $conn->query($latestDoctorSql);

    if ($latestDoctorResult && $latestDoctorResult->num_rows > 0) {
        $latestDoctorRow = $latestDoctorResult->fetch_assoc();
        $doctorId = $latestDoctorRow['id'];

        // Update the doctor_id column in the appointments table
        $updateSql = "UPDATE appointments SET doctor_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("i", $doctorId);

        if ($updateStmt->execute()) {
            echo "Doctor ID updated successfully.";
        } else {
            echo "Error: " . $updateStmt->error;
        }
    } else {
        echo "Error: Failed to retrieve the latest doctor ID.";
    }
} else {
    header("location: index.php");
}
?>