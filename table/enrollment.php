<?php
session_start();
include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM enrollment";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/style.css">
    <title>Enrollment Table</title>
</head>
<body>
<h2>Enrollment Table</h2>
<table>
    <tr>
        <th>Enrollment ID</th>
        <th>Student ID</th>
        <th>Course ID</th>
        <th>Semester</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["enrollment_id"] . "</td><td>" . $row["student_id"] . "</td><td>" . $row["course_id"] . "</td><td>" . $row["semester"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    ?>
</table>
<a href="../dashboard.php">Back to Dashboard</a>
</body>
</html>
