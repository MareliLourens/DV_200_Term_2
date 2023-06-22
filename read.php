<?php
include 'db.php';

//patients
$sql = "SELECT * FROM patients";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  echo '<tr onclick="deleteAppointment(' . $row['id'] . ')" class="select-appointment">';

  if (isset($_GET['id']) && $row['id'] == $_GET['id']) {
    echo '<form class="form-inline m-2" action="update.php" method="POST">';
    echo '<td><input type="file" class="form-control" name="profile_image" style="height: 50px;"></td>';
    echo '<td><input type="text" class="form-control" name="name" value="' . $row['name'] . '"></td>';
    echo '<td><input type="text" class="form-control" name="surname" value="' . $row['surname'] . '"></td>';
    echo '<td><input type="text" class="form-control" name="email" value="' . $row['email'] . '"></td>';
    echo '<td><input type="text" class="form-control" name="phone_number" value="' . $row['phone_number'] . '"></td>';
    echo '<td><button type="submit" class="btn btn-success">Save</button></td>';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '</form>';
  } else {
    echo '<td><img src="' . $row['profile_image'] . '" alt="Employee Picture" style="height: 50px; padding-right: 12px;">';
    echo $row['name'] . " " . $row['surname'] . '</td>';
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . str_pad($row['phone_number'], 10, '0', STR_PAD_LEFT) . "</td>";
  }

  $appointmentSql = "SELECT id, date, time FROM appointments WHERE patient_id = " . $row['id'];
  $appointmentResult = $conn->query($appointmentSql);
  if ($appointmentResult->num_rows > 0) {
    $appointmentRow = $appointmentResult->fetch_assoc();
    $appointmentDate = date('j F Y', strtotime($appointmentRow['date']));
    $appointmentTime = date('H:i A', strtotime($appointmentRow['time']));
    echo '<td>' . $appointmentTime . '</td>';
    echo '<td>' . $appointmentDate . '</td>';
  } else {
    echo '<td colspan="2">No appointment</td>';
  }

  echo "</tr>";
}

$conn->close();
?>

<script>
  function deleteAppointment(appointmentId) {
    if (confirm("Are you sure you want to delete this appointment?")) {
      // Send the appointment ID to delete_appointment.php using AJAX or a form submission
      // Example using AJAX with jQuery
      $.ajax({
        url: 'delete_appointment.php',
        type: 'POST',
        data: { appointment_id: appointmentId },
        success: function (response) {
          // Handle the success response
          alert(response);
          // Optionally, reload the page or update the table to reflect the deletion
          location.reload(); // Reload the page
        },
        error: function (xhr, status, error) {
          // Handle the error response
          console.log(xhr.responseText);
          alert("Error deleting appointment. Please try again.");
        }
      });
    }
  }
</script>