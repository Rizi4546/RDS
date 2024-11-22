<?php
session_start();
include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM grades";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/style.css">
    <title>Grades Table</title>
</head>
<body>
<h2>Grades Table</h2>
<table>
    <tr>
        <th>Grade ID</th>
        <th>Student ID</th>
        <th>Course ID</th>
        <th>Grade</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["grade_id"] . "</td><td>" . $row["student_id"] . "</td><td>" . $row["course_id"] . "</td><td>" . $row["grade"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
    ?>
</table>
<a href="../dashboard.php">Back to Dashboard</a>
</body>
</html>
