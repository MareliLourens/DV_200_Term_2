<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle doctor form submission
    $name = isset($_POST["doctor_name"]) ? $_POST["doctor_name"] : '';
    $surname = isset($_POST["doctor_surname"]) ? $_POST["doctor_surname"] : '';

    // Check if the doctor already exists
    $existingDoctorSql = "SELECT id FROM doctors WHERE name = ? AND surname = ?";
    $existingDoctorStmt = $conn->prepare($existingDoctorSql);
    $existingDoctorStmt->bind_param("ss", $name, $surname);
    $existingDoctorStmt->execute();
    $existingDoctorResult = $existingDoctorStmt->get_result();

    if ($existingDoctorResult->num_rows > 0) {
        // Doctor already exists, show an error message
        echo "Error: Doctor already exists.";
    } else {
        // Doctor does not exist, insert a new record
        $age = isset($_POST['doctor_age']) ? $_POST['doctor_age'] : '';
        $gender = isset($_POST['doctor_gender']) ? $_POST['doctor_gender'] : '';
        $email = isset($_POST['doctor_email']) ? $_POST['doctor_email'] : '';
        $phone_number = isset($_POST['doctor_phone_number']) ? $_POST['doctor_phone_number'] : '';

        if ($age === '' || $gender === '' || $email === '' || $phone_number === '') {
            echo "Error: Please fill in all the required fields.";
            exit();
        }

        $profile_image = '';

        if ($gender === 'Male') {
            $profile_image = 'assets/default_male.png';
        } elseif ($gender === 'Female') {
            $profile_image = 'assets/default_female.png';
        }

        $insertSql = "INSERT INTO doctors (name, surname, age, gender, email, phone_number, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ssissss", $name, $surname, $age, $gender, $email, $phone_number, $profile_image);

        if ($insertStmt->execute()) {
            header("location: doctors.php"); // Redirect to doctors.php
        } else {
            echo "Error: " . $insertStmt->error;
        }
    }

    $conn->close();
} else {
    header("location: doctors.php");
}
?>
