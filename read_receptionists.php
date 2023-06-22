<?php

session_start();
include 'db.php';

$sql = "SELECT * FROM receptionists";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div class='card_container'>";
    echo "<img src='" . $row['profile_image'] . "' alt='Receptionist Picture' class='receptionist_image'>";
    echo "<h4><span class='receptionist_name'>" . $row['name'] . "</span> <span class='receptionist_surname'>" . $row['surname'] . "</span> " . "</h4>";
    echo "<p class='receptionist_age'><strong>Age:</strong> " . $row['age'] . "</p>";
    echo "<p class='receptionist_gender'><strong>Gender:</strong> " . $row['gender'] . "</p>";
    echo "<p class='receptionist_email'><strong>Email:</strong> " . $row['email'] . "</p>";
    echo "<p class='receptionist_number'><strong>Phone Number:</strong> " . str_pad($row['phone_number'], 10, '0', STR_PAD_LEFT) . "</p>";
    echo "<p class='receptionist_rank'><strong>Rank:</strong> " . $row['rank'] . "</p>";

    // Add hover effect and buttons
    // Add hover effect and buttons
    echo "<div class='hover_buttons'>";

    // Check if the logged-in user is a head nurse
    if ($_SESSION['rank'] === 'Head') {
        echo "<button class='card_button edit-receptionist' data-id='" . $row['id'] . "'>Edit Receptionist</button>";
        echo "<button class='card_button ban-receptionist' data-id='" . $row['id'] . "'>Ban Receptionist</button>";
    }

    echo "</div>";

    echo "</div>";
}

$conn->close();
?>

<div id="popup">
    <h4>Edit Receptionist Details:</h4>
    <br>
    <div class="form_container"></div>
</div>

<script>
    // Add event listener to the "Edit Receptionist" button with class 'edit-receptionist'
    var editButtons = document.querySelectorAll('.edit-receptionist');
    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var receptionistId = this.getAttribute('data-id');
            var cardContainer = this.parentNode.parentNode;
            var receptionistName = cardContainer.querySelector('.receptionist_name').textContent.trim();
            var receptionistSurname = cardContainer.querySelector('.receptionist_surname').textContent.trim();
            var receptionistAge = cardContainer.querySelector('.receptionist_age').textContent.replace('Age: ', '');
            var receptionistGender = cardContainer.querySelector('.receptionist_gender').textContent.replace('Gender: ', '');
            var receptionistEmail = cardContainer.querySelector('.receptionist_email').textContent.replace('Email: ', '');
            var receptionistNumber = cardContainer.querySelector('.receptionist_number').textContent.replace('Phone Number: ', '');
            var receptionistRank = cardContainer.querySelector('.receptionist_rank').textContent.replace('Rank: ', '');

            var formHtml = "<form class='form-inline m-2' action='update_receptionists.php' method='POST'>" +
                "<div class='block'>" +
                "<label id='popup_label' class='form_input_type' for='receptionist_name'>Name:</label>" +
                "<input type='text' id='popup_text' class='form-control' name='name' value='" + receptionistName + "'>" +
                "</div>" +
                "<div class='block'>" +
                "<label id='popup_label' class='form_input_type' for='receptionist_surname'>Surname:</label>" +
                "<input type='text' id='popup_text' class='form-control' name='surname' value='" + receptionistSurname + "'>" +
                "</div>" +
                "<div class='block'>" +
                "<label id='popup_label' class='form_input_type' for='receptionist_age'>Age:</label>" +
                "<input type='text' id='popup_text' class='form-control' name='age' value='" + receptionistAge + "'>" +
                "</div>" +
                "<div class='block'>" +
                "<label id='popup_label' class='form_input_type' for='receptionist_gender'>Gender:</label>" +
                "<input type='text' id='popup_text' class='form-control' name='gender' value='" + receptionistGender + "'>" +
                "</div>" +
                "<div class='block'>" +
                "<label id='popup_label' class='form_input_type' for='receptionist_email'>Email:</label>" +
                "<input type='text' id='popup_text' class='form-control' name='email' value='" + receptionistEmail + "'>" +
                "</div>" +
                "<div class='block'>" +
                "<label id='popup_label' class='form_input_type' for='receptionist_number'>Phone Number:</label>" +
                "<input type='text' id='popup_text' class='form-control' name='phone_number' value='" + receptionistNumber + "'>" +
                "</div>" +
                "<div class='block'>" +
                "<label id='popup_label' class='form_input_type' for='receptionist_rank'>Rank:</label>" +
                "<input type='text' id='popup_text' class='form-control' name='rank' value='" + receptionistRank + "'>" +
                "</div>" +
                "<button type='submit' class='btn btn-success'>Save</button>" +
                "<input type='hidden' name='id' value='" + receptionistId + "'>" +
                "</form>";

            var formContainer = document.querySelector('.form_container');
            formContainer.innerHTML = formHtml;

            var popup = document.getElementById('popup');
            popup.style.display = 'block';
        });
    });

    // Add event listener to the "Ban Receptionist" button with class 'ban-receptionist'
    var banButtons = document.querySelectorAll('.ban-receptionist');
    banButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var receptionistId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to ban this receptionist?')) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        // Reload the page after the receptionist is banned
                        location.reload();
                    }
                };
                xhttp.open('GET', 'ban_receptionists.php?id=' + receptionistId, true);
                xhttp.send();
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