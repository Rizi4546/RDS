<?php
session_start();
include('C:/xampp/htdocs/RDS/config.php');
if (!isset($_SESSION['username'])) {
    header("C:/xampp/htdocs/RDS/login.php");
    exit();
}

$sql = "SELECT * FROM class_schedule";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/style.css">
    <title>Class Schedule Table</title>
</head>
<body>
<h2>Class Schedule Table</h2>
<table>
    <tr>
        <th>Schedule ID</th>
        <th>Course ID</th>
        <th>Classroom ID</th>
        <th>Time</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["schedule_id"] . "</td><td>" . $row["course_id"] . "</td><td>" . $row["classroom_id"] . "</td><td>" . $row["time"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    ?>
</table>
<a href="../dashboard.php">Back to Dashboard</a>
</body>
</html>
