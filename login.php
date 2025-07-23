<?php
// Initialize a flag to track login errors
$loginError = false;
// Start session to manage user data
session_start();

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Include database connection file
    include 'partials/_dbconnect.php';

    // Retrieve the submitted data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Check if username exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn)); 
    }
    // Verify the user exists
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Store user data in session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];

            // Redirect to the welcome page
            header("location: Menu.html");
            exit;
        } else {
            $loginError = "Invalid Credentials.";
        }
    } else {
        $loginError = "Invalid Credentials.";
    }
}
// Display login error if any
if ($loginError) {
    echo "<script>alert('$loginError'); window.history.back();</script>";
}
?>
