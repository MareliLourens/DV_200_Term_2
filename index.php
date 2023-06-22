<?php
session_start();

// Check if session variables are set
if (isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['id'])) {
  ?>
  <!DOCTYPE html>
  <html>

  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <div class="left_container">
      <div class="welcome">
        <h1>Good Morning,
          <?php echo $_SESSION['name']; ?>
        </h1>
        <h3>Hope you have a great day at work today.</h3>
        <img id="doctor" src="assets/doctor.png">
      </div>
      <h4 class="appointments_title">Appointments</h4>
      <div class="table_titles_container">
        <h6 class="table_titles">Name</h6>
        <h6 class="table_titles2">Email</h6>
        <h6 class="table_titles3">Phone Number</h6>
        <h6 class="table_titles4">Time</h6>
        <h6 class="table_titles5">Date</h6>
      </div>
      <div class="appointments">
        <table class="table">
          <tbody>
            <?php include 'read.php'; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="right_container">
      <div class="new_appointment">
        <h4 class="new_title">Create new appointment</h4>
        <div class="new_appointment_patient">
          <button class="accordion">Enter patient details</button>
          <div class="panel">
            <form id="patientForm" action="create_patients.php" method="POST">
              <label class="form_input_type" for="patient_name">Name:</label>
              <input type="text" class="form_input_name" id="patient_name" name="patient_name">
              <label class="form_input_type" for="patient_surname">Surname:</label>
              <input type="text" class="form_input_surname" id="patient_surname" name="patient_surname">
              <label class="form_input_type" for="patient_age">Age:</label>
              <input type="number" min="0" max="100" step="1" value="18" class="form_input_age" id="patient_age"
                name="patient_age">
              <label class="form_input_type" for="patient_gender">Gender:</label>
              <select class="form_input_gender" id="patient_gender" name="patient_gender">
                <option value="Female">Female</option>
                <option value="Male">Male</option>
              </select>
              <label class="form_input_type" for="patient_email">Email:</label>
              <input type="text" class="form_input_email" id="patient_email" name="patient_email">
              <label class="form_input_type" for="patient_phone_number">Phone Number:</label>
              <input type="number" class="form_input_phone" id="patient_phone_number" name="patient_phone_number">
              <label class="form_input_type" for="patient_medical_aid_number">Medical Aid Number:</label>
              <input type="text" class="form_input_medical" id="patient_medical_aid_number"
                name="patient_medical_aid_number">
            </form>
          </div>
          <button class="accordion">Enter doctor details</button>
          <div class="panel">
            <form id="doctorForm" action="create_doctors.php" method="POST">
              <label class="form_input_type" for="doctor_name">Name:</label>
              <input type="text" class="form_input_name" id="doctor_name" name="doctor_name">
              <label class="form_input_type" for="doctor_surname">Surname:</label>
              <input type="text" class="form_input_surname" id="doctor_surname" name="doctor_surname">
              <label class="form_input_type" for="doctor_age">Age:</label>
              <input type="number" min="0" max="100" step="1" value="18" class="form_input_age" id="doctor_age"
                name="doctor_age">
              <label class="form_input_type" for="doctor_gender">Gender:</label>
              <select class="form_input_gender" id="doctor_gender" name="doctor_gender">
                <option value="Female">Female</option>
                <option value="Male">Male</option>
              </select>
              <label class="form_input_type" for="doctor_email">Email:</label>
              <input type="text" class="form_input_email" id="doctor_email" name="doctor_email">
              <label class="form_input_type" for="doctor_phone_number">Phone Number:</label>
              <input type="number" class="form_input_phone" id="doctor_phone_number" name="doctor_phone_number">
            </form>
          </div>
          <button class="accordion">Select date and time</button>
          <div class="panel">
            <form id="appointmentForm" action="create_appointment.php" method="POST">
              <label for="date">Date:</label>
              <input type="text" id="date" name="date">
              <label for="time">Time:</label>
              <input type="text" id="time" name="time">
            </form>
          </div>
          <button id="submitButton" onclick="submitForms()">Submit</button>
        </div>
      </div>
      <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
              panel.style.display = "none";
            } else {
              panel.style.display = "block";
            }
          });
        }

        function toggleAccordion(event) {
          event.target.classList.toggle("active");
          var panel = event.target.nextElementSibling;
          if (panel.style.display === "block") {
            panel.style.display = "none";
          } else {
            panel.style.display = "block";
          }
        }

        function submitForms() {
          var patientForm = document.getElementById("patientForm");
          var doctorForm = document.getElementById("doctorForm");
          var appointmentForm = document.getElementById("appointmentForm");

          // Disable the submit button to prevent multiple clicks
          document.getElementById("submitButton").disabled = true;

          // Gather form data
          var patientFormData = new FormData(patientForm);
          var doctorFormData = new FormData(doctorForm);
          var appointmentFormData = new FormData(appointmentForm);

          // Send both form data simultaneously
          Promise.all([
            fetch(patientForm.action, {
              method: 'POST',
              body: patientFormData
            }),
            fetch(doctorForm.action, {
              method: 'POST',
              body: doctorFormData
            }),
            fetch(appointmentForm.action, {
              method: 'POST',
              body: appointmentFormData
            })
          ])
            .then(function (responses) {
              // Handle the responses from both requests
              if (responses[0].ok && responses[1].ok && responses[2].ok) {
                // Both requests were successful
                console.log("All forms submitted successfully.");

                // Reset the forms
                patientForm.reset();
                doctorForm.reset();
                appointmentForm.reset();

                // Collapse all accordions
                var accordions = document.getElementsByClassName("accordion");
                for (var i = 0; i < accordions.length; i++) {
                  accordions[i].classList.remove("active");
                  accordions[i].nextElementSibling.style.display = "none";
                }
              } else {
                // Handle errors if any of the requests failed
                console.log("Error: Form submission failed.");
              }
            })
            .catch(function (error) {
              // Handle any network or other errors
              console.log("Error: " + error);
            });
        }
      </script>
      <script src="script.js"></script>
  </body>

  </html>
<?php
} else {
  header("Location: login_page.php");
  exit();
}
?>