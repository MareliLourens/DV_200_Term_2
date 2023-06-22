<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle receptionist form submission
    $name = isset($_POST['receptionist_name']) ? $_POST['receptionist_name'] : '';
    $surname = isset($_POST['receptionist_surname']) ? $_POST['receptionist_surname'] : '';
    $age = isset($_POST['receptionist_age']) ? $_POST['receptionist_age'] : '';
    $gender = isset($_POST['receptionist_gender']) ? $_POST['receptionist_gender'] : '';
    $email = isset($_POST['receptionist_email']) ? $_POST['receptionist_email'] : '';
    $phone_number = isset($_POST['receptionist_phone_number']) ? $_POST['receptionist_phone_number'] : '';
    $rank = isset($_POST['receptionist_rank']) ? $_POST['receptionist_rank'] : '';

    if ($name === '' || $surname === '' || $age === '' || $gender === '' || $email === '' || $phone_number === '' || $rank === '') {
        echo "Error: Please fill in all the required fields.";
        exit();
    }

    // Insert receptionist into the database
    $insertSql = "INSERT INTO receptionists (name, surname, age, gender, email, phone_number, rank) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("ssissss", $name, $surname, $age, $gender, $email, $phone_number, $rank);

    if ($insertStmt->execute()) {
        header("location: receptionists.php"); // Redirect to receptionists.php
    } else {
        echo "Error: " . $insertStmt->error;
    }

    $conn->close();
} else {
    header("location: receptionists.php");
}
?>
