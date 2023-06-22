<?php
session_start();
include "db.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    // Function to validate user input
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate and sanitize user input
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if (empty($email)) {
        // Redirect to login page with error message if email is empty
        header("Location: login_page.php?error=Email is required");
        exit();
    } else if (empty($password)) {
        // Redirect to login page with error message if password is empty
        header("Location: login_page.php?error=Password is required");
        exit();
    } else {
        // SQL query to check if the email and password exist in the database
        $sql = "SELECT * FROM receptionists WHERE email='$email' AND password='$password'";

        // Execute the SQL query
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            // Fetch the row as an associative array
            $row = mysqli_fetch_assoc($result);

            if ($row['email'] === $email && $row['password'] === $password) {
                // Store user information in session variables
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['rank'] = $row['rank']; // Store the rank of the logged-in receptionist

                // Redirect to the index page after successful login
                header("Location: index.php");
                exit();
            } else {
                // Redirect to login page with error message if email or password is incorrect
                header("Location: login_page.php?error=Incorrect email or password");
                exit();
            }
        } else {
            // Redirect to login page with error message if email or password is incorrect
            header("Location: login_page.php?error=Incorrect email or password");
            exit();
        }
    }
} else {
    // Redirect to login page if email or password is not set
    header("Location: login_page.php");
    exit();
}
?>
