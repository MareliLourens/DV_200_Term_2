<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
</head>

<body>
  <div class="navbar">
    <img id="logo" src="assets/logo.svg">
    <ul>
      <li><a class="navtext" href="index.php">Appointment</a></li>
      <li><a class="navtext" href="patients.php">Patients</a></li>
      <li><a class="navtext" href="doctors.php">Doctors</a></li>
      <li><a class="navtext" href="receptionists.php">Receptionists</a></li>
    </ul>
    <a id="logout" href="logout.php"><img id="logout" src="assets/logout.svg"></a>
  </div>

  <div class="appointments_content">
    <?php include 'read_doctors.php'; ?>
  </div>

  <?php if ($_SESSION['rank'] === 'Head'): ?>
    <div class="create_new" onclick="toggleCreateDoctorPopup()">
      <span id="createDoctorText">Create new doctor &#9650;</span>
      <div id="popup_new" style="display: none;">
        <h4>Create New Doctor:</h4>
        <div class="form_container">
          <form class="form-inline m-2" action="new_doctor.php" method="POST">
            <div class="block">
              <label class="form_input_type" for="doctor_name">Name:</label>
              <input type="text" class="form-control" name="doctor_name" required>
            </div>
            <div class="block">
              <label class="form_input_type" for="doctor_surname">Surname:</label>
              <input type="text" class="form-control" name="doctor_surname" required>
            </div>
            <div class="block">
              <label class="form_input_type" for="doctor_age">Age:</label>
              <input type="text" class="form-control" name="doctor_age" required>
            </div>
            <div class="block">
              <label class="form_input_type" for="doctor_gender">Gender:</label>
              <input type="text" class="form-control" name="doctor_gender" required>
            </div>
            <div class="block">
              <label class="form_input_type" for="doctor_email">Email:</label>
              <input type="email" class="form-control" name="doctor_email" required>
            </div>
            <div class="block">
              <label class="form_input_type" for="doctor_phone_number">Phone Number:</label>
              <input type="text" class="form-control" name="doctor_phone_number" required>
            </div>
            <div class="block">
              <button type="submit" class="create_new_button">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <script>
    // Add event listeners to each button with class 'btn'
    var buttons = document.querySelectorAll('.btn');
    buttons.forEach(function (button) {
      button.addEventListener('mouseover', function () {
        // Add hover effect when mouse is over the button
        this.style.backgroundColor = '#ccc';
      });

      button.addEventListener('mouseout', function () {
        // Remove hover effect when mouse leaves the button
        this.style.backgroundColor = '#e6e6e6';
      });
    });

    function toggleCreateDoctorPopup() {
      var popup = document.getElementById("popup_new");
      var createDoctorText = document.getElementById("createDoctorText");

      var popup = document.getElementById('popup_new');
      var createNewDiv = document.querySelector('.create_new');

      if (popup.style.display === 'none') {
        popup.style.display = 'block';
        createNewDiv.classList.add('expanded');
        createDoctorText.style.display = "none";
      } else {
        if (event.target !== submitButton) {
          popup.style.display = 'none';
          createNewDiv.classList.remove('expanded');
          var formContainer = document.querySelector('.form_container');
          formContainer.innerHTML = ''; // Clear the form container
          createDoctorText.style.display = "block";
        }
      }
    }
  </script>
</body>

</html>