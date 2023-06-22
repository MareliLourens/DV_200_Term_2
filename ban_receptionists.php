<?php
// Include the database connection file
include "db.php";

// Get the ID parameter from the URL
$id = $_GET['id'];

// Toggle the banned status of the receptionist
$toggleBanSql = "UPDATE receptionists SET banned = IF(banned = 'yes', 'no', 'yes') WHERE id = $id";
$conn->query($toggleBanSql);

// Close the database connection
$conn->close();

// Redirect to the receptionists page
header("location: receptionists.php");
?>