<?php
session_start();
include('C:/xampp/htdocs/RDS/config.php');
if (!isset($_SESSION['username'])) {
    header("C:/xampp/htdocs/RDS/login.php");
    exit();
}

$sql = "SELECT * FROM attendance";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/style.css">
    <title>Attendance Table</title>
</head>
<body>
<h2>Attendance Table</h2>
<table>
    <tr>
        <th>Attendance ID</th>
        <th>Student ID</th>
        <th>Date</th>
        <th>Status</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["attendance_id"] . "</td><td>" . $row["student_id"] . "</td><td>" . $row["date"] . "</td><td>" . $row["status"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    ?>
</table>
<a href="../dashboard.php">Back to Dashboard</a>
</body>
</html>
