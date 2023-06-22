<?php
include 'db.php';

$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$age = $_POST['age'] ?? '';
$gender = $_POST['gender'] ?? '';
$email = $_POST['email'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$rank = $_POST['rank'] ?? '';

$sql = "UPDATE receptionists SET name='$name', surname='$surname', age='$age', gender='$gender', email='$email', phone_number='$phone_number', rank='$rank' WHERE id='$id'";

$result = $conn->query($sql);
$conn->close();
header("location: receptionists.php");
?>