<?php
// Include the database connection file
include 'partials/_dbconnect.php';

// Initialize alert variables
$showAlert = false;
$showError = false;

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get form data
    $username =  $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check if the username already exists
    $existSql = "SELECT * FROM users WHERE username = '$username'";
    $resultExist = mysqli_query($conn, $existSql);
    if (!$resultExist) {
        die("Query failed: " . mysqli_error($conn));
    }
    $numExist = mysqli_num_rows($resultExist);
    if ($numExist > 0) {
        $showError = "Username already exists";
    } else {
        // Validate passwords
        if ($password === $cpassword) {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user into the database
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            $showAlert = true;
        } else {
            $showError = "Passwords do not match";
        }
    }
}

// Show alerts or errors
if ($showAlert) {
    echo "<script>alert('Registration successful! You can now log in.'); window.location.href = 'Login Page.html';</script>";
} elseif ($showError) {
    echo "<script>alert('$showError'); window.history.back();</script>";
}
?>
