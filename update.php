<?php
include 'db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$date_of_birth = $_POST['date_of_birth'];
$gender = $_POST['gender'];
$race = $_POST['race'];
$picture = $_FILES['picture']['name'];
$role = $_POST['role'];

$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["picture"]["name"]);
move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile);

$pictureName = basename($picture);

$sql = "UPDATE employee SET name='$name', surname='$surname', date_of_birth='$date_of_birth', gender='$gender', race='$race', picture='$pictureName', role='$role' WHERE id=$id";

$result = $conn->query($sql);
$conn->close();
header("location: index.php");
?>