<?php
// Start session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Include database connection
include 'partials/_dbconnect.php';

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Check if the user already has a profile
$sql = "SELECT * FROM profiles WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$profile = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $enrollment_no = $_POST['enrollment_no'];
    $batch = $_POST['batch'];
    $father_name = $_POST['father_name'];
    $phone_number = $_POST['phone_number'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];

    if ($profile) {
        // Update existing profile
        $update_sql = "UPDATE profiles SET 
            full_name='$full_name', email='$email', enrollment_no='$enrollment_no', 
            batch='$batch', father_name='$father_name', phone_number='$phone_number', 
            birth_date='$birth_date', gender='$gender', address_line1='$address_line1', 
            address_line2='$address_line2', country='$country', city='$city', 
            state='$state', postal_code='$postal_code' 
            WHERE user_id='$user_id'";
        mysqli_query($conn, $update_sql);
    } else {
        // Insert new profile
        $insert_sql = "INSERT INTO profiles (
            user_id, full_name, email, enrollment_no, batch, father_name, 
            phone_number, birth_date, gender, address_line1, address_line2, 
            country, city, state, postal_code
        ) VALUES (
            '$user_id', '$full_name', '$email', '$enrollment_no', '$batch', '$father_name', 
            '$phone_number', '$birth_date', '$gender', '$address_line1', '$address_line2', 
            '$country', '$city', '$state', '$postal_code'
        )";
        mysqli_query($conn, $insert_sql);
    }

    // Refresh the page to display updated data
    header("location: profile.php");
    exit;
}

// Close database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="Std.css">
    <link rel="stylesheet" href="Prof.css">
</head>

<body>
    <section class="container">
        <?php if ($profile): ?>
            <!-- Display profile details -->
            <header>Student Details</header>
            <div class="details">
                <p><strong>Full Name:</strong> <?= $profile['full_name'] ?></p>
                <p><strong>Email Address:</strong> <?= $profile['email'] ?></p>
                <p><strong>Enrollment No:</strong> <?= $profile['enrollment_no'] ?></p>
                <p><strong>Batch:</strong> <?= $profile['batch'] ?></p>
                <p><strong>Father's Name:</strong> <?= $profile['father_name'] ?></p>
                <p><strong>Phone Number:</strong> <?= $profile['phone_number'] ?></p>
                <p><strong>Birth Date:</strong> <?= $profile['birth_date'] ?></p>
                <p><strong>Gender:</strong> <?= $profile['gender'] ?></p>
                <p><strong>Address:</strong> <?= $profile['address_line1'] ?>, <?= $profile['address_line2'] ?></p>
                <p><strong>Country:</strong> <?= $profile['country'] ?></p>
                <p><strong>City:</strong> <?= $profile['city'] ?></p>
                <p><strong>State:</strong> <?= $profile['state'] ?></p>
                <p><strong>Postal Code:</strong> <?= $profile['postal_code'] ?></p>
            </div>

        <?php else: ?>
            <!-- Display registration form -->
            <header>Registration Form</header>
            <form action="profile.php" method="POST" class="form">
                <div class="input-box">
                    <label>Full Name</label>
                    <input type="text" name="full_name" placeholder="Enter full name" required />
                </div>
                <div class="input-box">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter email address" required />
                </div>
                <div class="input-box">
                    <label>Enrollment No.</label>
                    <input type="text" name="enrollment_no" placeholder="Enter enrollment number" required />
                </div>
                <div class="input-box">
                    <label>Batch</label>
                    <input type="text" name="batch" placeholder="Enter batch" required />
                </div>
                <div class="input-box">
                    <label>Father's Name</label>
                    <input type="text" name="father_name" placeholder="Enter father's name" required />
                </div>
                <div class="column">
                    <div class="input-box">
                        <label>Phone Number</label>
                        <input type="tel" name="phone_number" placeholder="Enter phone number" required />
                    </div>
                    <div class="input-box">
                        <label>Birth Date</label>
                        <input type="date" name="birth_date" required />
                    </div>
                </div>
                <div class="gender-box">
                    <h3>Gender</h3>
                    <div class="gender-option">
                        <div class="gender">
                            <input type="radio" id="check-male" name="gender" value="Male" checked />
                            <label for="check-male">Male</label>
                        </div>
                        <div class="gender">
                            <input type="radio" id="check-female" name="gender" value="Female" />
                            <label for="check-female">Female</label>
                        </div>
                        <div class="gender">
                            <input type="radio" id="check-other" name="gender" value="Other" />
                            <label for="check-other">Prefer not to say</label>
                        </div>
                    </div>
                </div>
                <div class="input-box address">
                    <label>Address</label>
                    <input type="text" name="address_line1" placeholder="Enter street address" required />
                    <input type="text" name="address_line2" placeholder="Enter street address line 2" />
                    <div class="column">
                        <div class="select-box">
                            <select name="country" required>
                                <option hidden>Country</option>

                                <option>India</option>

                            </select>
                        </div>
                        <input type="text" name="city" placeholder="Enter your city" required />
                    </div>
                    <div class="column">
                        <div class="select-box">
                            <select name="state" required>
                                <option hidden>Select your state</option>
                                <option>Andhra Pradesh</option>
                                <option>Arunachal Pradesh</option>
                                <option>Assam</option>
                                <option>Bihar</option>
                                <option>Chhattisgarh</option>
                                <option>Goa</option>
                                <option>Gujarat</option>
                                <option>Haryana</option>
                                <option>Himachal Pradesh</option>
                                <option>Jharkhand </option>
                                <option>Karnataka</option>
                                <option>Kerala</option>
                                <option>Madhya Pradesh</option>
                                <option>Maharashtra</option>
                                <option>Manipur</option>
                                <option>Meghalaya</option>
                                <option>Mizoram</option>
                                <option>Nagaland</option>
                                <option>Odisha</option>
                                <option>Punjab</option>
                                <option>Rajasthan</option>
                                <option>Sikkim</option>
                                <option>Tamil Nadu</option>
                                <option>Telangana</option>
                                <option>Tripura</option>
                                <option>Uttar Pradesh</option>
                                <option>Uttarakhand</option>
                                <option>West Bengal</option>

                            </select>
                        </div>
                        <input type="text" name="postal_code" placeholder="Enter postal code" required />
                    </div>
                </div>
                <button type="submit">Submit</button>
            </form>
        <?php endif; ?>
    </section>
</body>

</html>