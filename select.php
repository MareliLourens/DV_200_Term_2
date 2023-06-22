<?php
include 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM employee WHERE id = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['surname'] . "</td>";
    echo "<td>" . $row['date_of_birth'] . "</td>";
    echo "<td>" . $row['gender'] . "</td>";
    echo "<td>" . $row['race'] . "</td>";
    echo '<td><img src="' . $row['picture'] . '" alt="Employee Picture"></td>';
    echo "<td>" . $row['role'] . "</td>";
    echo "</tr>";
} else {
    echo "No entry found with the specified ID.";
}

$conn->close();
?>