


<?php
// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Include database connection
include 'partials/_dbconnect.php';

// Get the logged-in user's batch from the profiles table
$user_id = $_SESSION['user_id'];
$sql = "SELECT batch FROM profiles WHERE user_id = $user_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $batch = $row['batch'];
} else {

   
   header("location:Profile.php");

}

// Fetch the timetable for the user's batch
$timetable_sql = "SELECT * FROM timetables WHERE batch = '$batch' ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')";
$timetable_result = $conn->query($timetable_sql);

// Check if a timetable is available
if ($timetable_result->num_rows == 0) {
    die("No timetable found for batch: $batch");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TIME TABLE</title>
    <link rel="stylesheet" href="Table.css">
</head>
<body>
    <div class="container">
        <h1>TIME TABLE for Batch <?= htmlspecialchars($batch) ?></h1>
        <table>
            <tr>
                <th></th>
                <th>9:00-9:50 AM</th>
                <th>10:00-10:50 AM</th>
                <th>11:00-11:50 AM</th>
                <th>12:00-12:50 PM</th>
                <th>1:00-1:50 PM</th>
                <th>2:00-2:50 PM</th>
                <th>3:00-3:50 PM</th>
                <th>4:00-4:50 PM</th>
            </tr>
            <?php while ($row = $timetable_result->fetch_assoc()): ?>
            <tr>
                <th><?= htmlspecialchars($row['day']) ?></th>
                <td><?= $row['period_1'] ?></td>
                <td><?= $row['period_2'] ?></td>
                <td><?= $row['period_3'] ?></td>
                <td><?= $row['period_4'] ?></td>
                <td><?= $row['period_5'] ?></td>
                <td><?= $row['period_6'] ?></td>
                <td><?= $row['period_7'] ?></td>
                <td><?= $row['period_8'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
