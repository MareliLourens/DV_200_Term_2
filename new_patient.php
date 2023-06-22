<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle patient form submission

    // Get values from the form submission
    $age = isset($_POST['patient_age']) ? $_POST['patient_age'] : '';
    $gender = isset($_POST['patient_gender']) ? $_POST['patient_gender'] : '';
    $email = isset($_POST['patient_email']) ? $_POST['patient_email'] : '';
    $phone_number = isset($_POST['patient_phone_number']) ? $_POST['patient_phone_number'] : '';
    $medical_aid_number = isset($_POST['patient_medical_aid_number']) ? $_POST['patient_medical_aid_number'] : '';

    // Check if any of the required fields are empty
    if ($age === '' || $gender === '' || $email === '' || $phone_number === '' || $medical_aid_number === '') {
        echo "Error: Please fill in all the required fields.";
        exit();
    }

    $profile_image = '';

    // Set the profile image based on the gender
    if ($gender === 'Male') {
        $profile_image = 'assets/default_male.png';
    } elseif ($gender === 'Female') {
        $profile_image = 'assets/default_female.png';
    }

    // Prepare and execute the SQL statement to insert the patient data into the database
    $insertSql = "INSERT INTO patients (age, gender, email, phone_number, medical_aid_number, profile_image) VALUES (?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("isssss", $age, $gender, $email, $phone_number, $medical_aid_number, $profile_image);

    if ($insertStmt->execute()) {
        header("location: patients.php"); // Redirect to patients.php after successful insertion
    } else {
        echo "Error: " . $insertStmt->error;
    }

    $conn->close();
} else {
    header("location: patients.php"); // Redirect to patients.php if accessed directly without form submission
}
?>
