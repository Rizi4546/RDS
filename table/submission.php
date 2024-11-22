<?php
session_start();
include('../config.php');
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM submission";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/style.css">
    <title>Submission Table</title>
</head>
<body>
<h2>Submission Table</h2>
<table>
    <tr>
        <th>Submission ID</th>
        <th>Assignment ID</th>
        <th>Student ID</th>
        <th>Submission Date</th>
        <th>Grade</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["submission_id"] . "</td><td>" . $row["assignment_id"] . "</td><td>" . $row["student_id"] . "</td><td>" . $row["submission_date"] . "</td><td>" . $row["grade"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
    }
    ?>
</table>
<a href="../dashboard.php">Back to Dashboard</a>
</body>
</html>
