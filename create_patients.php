<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle patient form submission
    $name = isset($_POST["patient_name"]) ? $_POST["patient_name"] : '';
    $surname = isset($_POST["patient_surname"]) ? $_POST["patient_surname"] : '';

    if ($name === '' || $surname === '') {
        echo "Error: Please fill in all the required fields.";
        exit();
    }

    // Check if the patient already exists
    $existingPatientSql = "SELECT id FROM patients WHERE name = ? AND surname = ?";
    $existingPatientStmt = $conn->prepare($existingPatientSql);
    $existingPatientStmt->bind_param("ss", $name, $surname);
    $existingPatientStmt->execute();
    $existingPatientResult = $existingPatientStmt->get_result();

    if ($existingPatientResult->num_rows > 0) {
        // Patient already exists, update the existing record
        $existingPatientRow = $existingPatientResult->fetch_assoc();
        $patientId = $existingPatientRow['id'];

        $updateSql = "UPDATE patients SET name = ?, surname = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssi", $name, $surname, $patientId);

        if ($updateStmt->execute()) {
            echo "Patient information updated successfully.";
        } else {
            echo "Error: " . $updateStmt->error;
        }
    } else {
        // Patient does not exist, insert a new record
        $age = isset($_POST['patient_age']) ? $_POST['patient_age'] : '';
        $gender = isset($_POST['patient_gender']) ? $_POST['patient_gender'] : '';
        $email = isset($_POST['patient_email']) ? $_POST['patient_email'] : '';
        $phone_number = isset($_POST['patient_phone_number']) ? $_POST['patient_phone_number'] : '';
        $medical_aid_number = isset($_POST['patient_medical_aid_number']) ? $_POST['patient_medical_aid_number'] : '';

        if ($age === '' || $gender === '' || $email === '' || $phone_number === '' || $medical_aid_number === '') {
            echo "Error: Please fill in all the required fields.";
            exit();
        }

        $profile_image = '';

        if ($gender === 'Male') {
            $profile_image = 'assets/default_male.png';
        } elseif ($gender === 'Female') {
            $profile_image = 'assets/default_female.png';
        }

        // Insert the new patient record
        $insertSql = "INSERT INTO patients (name, surname, age, gender, email, phone_number, medical_aid_number, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ssisssss", $name, $surname, $age, $gender, $email, $phone_number, $medical_aid_number, $profile_image);

        if ($insertStmt->execute()) {
            $newPatientId = $insertStmt->insert_id;

            // Retrieve the latest doctor ID from the doctors table
            $latestDoctorSql = "SELECT id FROM doctors ORDER BY id DESC LIMIT 1";
            $latestDoctorResult = $conn->query($latestDoctorSql);

            if ($latestDoctorResult && $latestDoctorResult->num_rows > 0) {
                $latestDoctorRow = $latestDoctorResult->fetch_assoc();
                $assignedDoctorId = $latestDoctorRow['id'];

                // Update the 'assigned_doctor' column with the assigned doctor ID
                $updateAssignedDoctorSql = "UPDATE patients SET assigned_doctor = ? WHERE id = ?";
                $updateAssignedDoctorStmt = $conn->prepare($updateAssignedDoctorSql);
                $updateAssignedDoctorStmt->bind_param("ii", $assignedDoctorId, $newPatientId);

                if ($updateAssignedDoctorStmt->execute()) {
                    echo "New patient created successfully.";
                } else {
                    echo "Error: " . $updateAssignedDoctorStmt->error;
                }
            } else {
                echo "Error: Failed to retrieve the latest doctor ID.";
            }
        } else {
            echo "Error: " . $insertStmt->error;
        }
    }

    $conn->close();
} else {
    header("location: index.php");
}
?>