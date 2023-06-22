<?php
include 'db.php';

$sql = "SELECT * FROM patients";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  echo "<div class='card_container'>";
  echo "<img src='" . $row['profile_image'] . "' alt='Patient Picture' class='patient_image'>";
  echo "<h4><span class='patient_name'>" . $row['name'] . "</span> <span class='patient_surname'>" . $row['surname'] . "</span> " . "</h4>";
  echo "<p class='patient_age'><strong>Age:</strong> " . $row['age'] . "</p>";
  echo "<p class='patient_gender'><strong>Gender:</strong> " . $row['gender'] . "</p>";
  echo "<p class='patient_email'><strong>Email:</strong> " . $row['email'] . "</p>";
  echo "<p class='patient_number'><strong>Phone Number:</strong> " . str_pad($row['phone_number'], 10, '0', STR_PAD_LEFT) . "</p>";
  echo "<p class='patient_medical_aid_number'><strong>Medical Aid Number:</strong> " . $row['medical_aid_number'] . "</p>";

  // Add hover effect and buttons
  echo "<div class='hover_buttons'>";
  echo "<button class='card_button edit-patient' data-id='" . $row['id'] . "'>Edit Patient</button>";
  echo "<button class='card_button delete-patient' data-id='" . $row['id'] . "'>Delete Patient</button>";
  echo "</div>";

  echo "</div>";
}

$conn->close();
?>
<div id="popup">
  <h4>Edit Patient Details: </h4>
  <br>
  <div class="form_container"></div>
</div>

<script>
  // Add event listener to the "Edit Patient" button with class 'edit-patient'
  var editButtons = document.querySelectorAll('.edit-patient');
  editButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var patientId = this.getAttribute('data-id');
      var cardContainer = this.parentNode.parentNode;
      var patientName = cardContainer.querySelector('.patient_name').textContent.trim();
      var patientSurname = cardContainer.querySelector('.patient_surname').textContent.trim();
      var patientAge = cardContainer.querySelector('.patient_age').textContent.replace('Age: ', '');
      var patientGender = cardContainer.querySelector('.patient_gender').textContent.replace('Gender: ', '');
      var patientEmail = cardContainer.querySelector('.patient_email').textContent.replace('Email: ', '');
      var patientNumber = cardContainer.querySelector('.patient_number').textContent.replace('Phone Number: ', '');
      var patientMedicalAidNumber = cardContainer.querySelector('.patient_medical_aid_number').textContent.replace('Medical Aid Number: ', '');

      var formHtml = "<form class='form-inline m-2' action='update_patients.php' method='POST'>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='patient_name'>Name:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='name' value='" + patientName + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='patient_surname'>Surname:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='surname' value='" + patientSurname + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='patient_age'>Age:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='age' value='" + patientAge + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='patient_gender'>Gender:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='gender' value='" + patientGender + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='patient_email'>Email:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='email' value='" + patientEmail + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='patient_number'>Phone Number:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='phone_number' value='" + patientNumber + "'>" +
        "</div>" +
        "<div class='block'>" +
        "<label id='popup_label' class='form_input_type' for='patient_medical_aid_number'>Medical Aid Number:</label>" +
        "<input type='text' id='popup_text' class='form-control' name='medical_aid_number' value='" + patientMedicalAidNumber + "'>" +
        "</div>" +
        "<button type='submit' class='btn btn-success'>Save</button>" +
        "<input type='hidden' name='id' value='" + patientId + "'>" +
        "</form>";

      var formContainer = document.querySelector('.form_container');
      formContainer.innerHTML = formHtml;

      var popup = document.getElementById('popup');
      popup.style.display = 'block';
    });
  });

  // Add event listener to the "Delete Patient" button with class 'delete-patient'
  var deleteButtons = document.querySelectorAll('.delete-patient');
  deleteButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var patientId = this.getAttribute('data-id');
      if (confirm('Are you sure you want to delete this patient?')) {
        window.location.href = 'delete_patients.php?id=' + patientId;
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