<?php
include 'db.php';

$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$age = $_POST['age'] ?? '';
$gender = $_POST['gender'] ?? '';
$email = $_POST['email'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$medical_aid_number = $_POST['medical_aid_number'] ?? '';

$sql = "UPDATE patients SET name='$name', surname='$surname', age='$age', gender='$gender', email='$email', phone_number='$phone_number', medical_aid_number='$medical_aid_number' WHERE id='$id'";

$result = $conn->query($sql);
$conn->close();
header("location: patients.php");
?>