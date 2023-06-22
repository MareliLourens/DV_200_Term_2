<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM doctors";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  echo "<div class='card_container'>";
  echo "<img src='" . $row['profile_image'] . "' alt='Doctor Picture' class='doctor_image'>";
  echo "<h4><span class='doctor_name'>" . $row['name'] . "</span> <span class='doctor_surname'>" . $row['surname'] . "</span> " . "</h4>";
  echo "<p class='doctor_age'><strong>Age:</strong> " . $row['age'] . "</p>";
  echo "<p class='doctor_gender'><strong>Gender:</strong> " . $row['gender'] . "</p>";
  echo "<p class='doctor_email'><strong>Email:</strong> " . $row['email'] . "</p>";
  echo "<p class='doctor_number'><strong>Phone Number:</strong> " . str_pad($row['phone_number'], 10, '0', STR_PAD_LEFT) . "</p>";
  echo "<p class='doctor_specialisation'><strong>Specialisation:</strong> " . $row['specialisation'] . "</p>";

  // Add hover effect and buttons
  echo "<div class='hover_buttons'>";
  if ($_SESSION['rank'] === 'Head') {
    echo "<button class='card_button edit-doctor' data-id='" . $row['id'] . "'>Edit Doctor</button>";
    echo "<button class='card_button delete-doctor' data-id='" . $row['id'] . "'>Delete Doctor</button>";
  }

  echo "</div>";

  echo "</div>";
}

$conn->close();
?>

<div id="popup">
  <h4>Edit Doctor Details: </h4>
  <br>
  <div class="form_container"></div>
</div>

<script>
  // Add event listener to the "Edit Doctor" button with class 'edit-doctor'
  var editButtons = document.querySelectorAll('.edit-doctor');
  editButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var doctorId = this.getAttribute('data-id');
      var cardContainer = this.parentNode.parentNode;
      var doctorName = cardContainer.querySelector('.doctor_name').textContent.trim();
      var doctorSurname = cardContainer.querySelector('.doctor_surname').textContent.trim();
      var doctorAge = cardContainer.querySelector('.doctor_age').textContent.replace('Age: ', '');
      var doctorGender = cardContainer.querySelector('.doctor_gender').textContent.replace('Gender: ', '');
      var doctorEmail = cardContainer.querySelector('.doctor_email').textContent.replace('Email: ', '');
      var doctorNumber = cardContainer.querySelector('.doctor_number').textContent.replace('Phone Number: ', '');
      var doctorSpecialisation = cardContainer.querySelector('.doctor_specialisation').textContent.replace('Specialisation: ', '');

      var formHtml = "<form class='form-inline m-2' action='update_doctors.php' method='POST'>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='doctor_name'>Name:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='name' value='" + doctorName + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='doctor_surname'>Surname:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='surname' value='" + doctorSurname + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='doctor_age'>Age:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='age' value='" + doctorAge + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='doctor_gender'>Gender:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='gender' value='" + doctorGender + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='doctor_email'>Email:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='email' value='" + doctorEmail + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='doctor_number'>Phone Number:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='phone_number' value='" + doctorNumber + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='doctor_specialisation'>Specialisation:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='specialisation' value='" + doctorSpecialisation + "'>" +
        "</div>" +
        "<button type='submit' class='btn btn-success'>Save</button>" +
        "<input type='hidden' name='id' value='" + doctorId + "'>" +
        "</form>";

      var formContainer = document.querySelector('.form_container');
      formContainer.innerHTML = formHtml;

      var popup = document.getElementById('popup');
      popup.style.display = 'block';
    });
  });

  // Add event listener to the "Delete Doctor" button with class 'delete-doctor'
  var deleteButtons = document.querySelectorAll('.delete-doctor');
  deleteButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var doctorId = this.getAttribute('data-id');
      if (confirm('Are you sure you want to delete this doctor?')) {
        window.location.href = 'delete_doctors.php?id=' + doctorId;
      }
    });
  });

  var popup = document.getElementById('popup');
  popup.addEventListener('click', function (event) {
    if (event.target === popup) {
      popup.style.display = 'none';
    }
  });
</script>